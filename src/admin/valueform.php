<?
	if (!$Entity)
		PageRedirect('index.php');
	
	$PagePrefix = '../';
	$PageTitle = 'Actualiza ' . $Entity->Name;

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	Connect();
	
	if (!ErrorHas() && isset($Id)) {
		$sql = "select Description from $Entity->Table where Id = $Id";
		$rs = mysql_query($sql);
		list($Description) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza $Entity->Name $Description";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nuevo " . $Entity->Name;
		$IsNew = 1;
	}

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="<?= $Entity->Entities ?>.php"><?= $Entity->SetName ?></a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="<?= $Entity->Entity ?>.php?Id=<? echo $Id; ?>"><?= $Entity->Name ?></a>
&nbsp;
&nbsp;
<a href="<?= $Entity->Entity ?>delete.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<?
	}
?>
</p>


<?
	ErrorRender();
?>

<p>

<form action="<?= $Entity->Entity ?>update.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Description","Descripción",$Description,40,true);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

