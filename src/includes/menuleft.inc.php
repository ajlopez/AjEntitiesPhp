<?
	include_once($PagePrefix.'includes/users.inc.php');
?>
<br>

<center>

<?
function MenuLeftOpen($title)
{
?>
<p>
<table class="menu" cellspacing=1 cellpadding=2 width="95%">
<tr>
<td align=center class="menutitle">
<? echo $title; ?>
</td>
</tr>
</tr>
<td valign="top" class="menuoption">
<?
}

function MenuLeftOption($text,$link)
{
	global $PagePrefix;

	echo "&nbsp;&nbsp;<strong>·</strong>&nbsp;&nbsp;";
	echo "<a target='_top' href='$PagePrefix$link' class='menuoption'>$text</a>";
	echo "<br>\n";
}

function MenuLeftClose()
{
?>
</td>
</tr>
</table>

<br>
<br>

</p>

<?
}
?>

<?

	MenuLeftOpen(SiteName);
	MenuLeftOption('Home','index.php');
	MenuLeftOption('Projects','projects.php');
	MenuLeftOption('Entities','entities.php');
	MenuLeftOption('Views','views.php');
	MenuLeftClose();

	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('Your Profile', 'users/user.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administrator','admin/index.php');
		}
		MenuLeftOption('Logout','users/logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('User');
		MenuLeftOption('Login','users/login.php');
		MenuLeftOption('Register','users/register.php');
		MenuLeftClose();
	}
?>
