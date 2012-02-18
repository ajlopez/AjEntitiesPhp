<?
	if (!$Entity)
		PageRedirect('index.php');

	$PagePrefix = '../';
	$PageTitle = $Entity->Name;

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');

	Connect();
	
	SessionPut($Entity->Entity . 'Link',PageActual());

	if (!isset($Id))
		PageExit();

	$sql = "select Description from $Entity->Table where Id = $Id";
	$rs = mysql_query($sql);
	list($Description) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="<?= $Entity->Entities ?>.php"><?= $Entity->SetName ?></a>
&nbsp;
&nbsp;
<a href="<?= $Entity->Entity ?>form.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="<?= $Entity->Entity ?>delete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Descripci&oacute;n", $Description);
?>
</table>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

