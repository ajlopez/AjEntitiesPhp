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
	MenuLeftOption('Principal','index.php');
	MenuLeftOption('Proyectos','projects.php');
	MenuLeftOption('Entidades','entities.php');
	MenuLeftOption('Vistas','views.php');
	MenuLeftClose();

	if (UserIdentified()) {
		MenuLeftOpen(UserName());
		MenuLeftOption('Su P&aacute;gina', 'users/user.php');
		If (UserIsAdministrator()) {
			MenuLeftOption('Administrador','admin/index.php');
		}
		MenuLeftOption('Salir','users/logout.php');
		MenuLeftClose();
	}
	else {
		MenuLeftOpen('Usuario');
		MenuLeftOption('Ingrese','users/login.php');
		MenuLeftOption('Registrarse','users/register.php');
		MenuLeftClose();
	}
?>
