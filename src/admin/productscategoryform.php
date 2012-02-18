<?
	$PagePrefix = '../';
	$PageTitle = 'Actualiza Categor&iacute;a de Producto';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	Connect();
	
	if (isset($Id)) {
		$sql = "select Description from news_categories where Id = $Id";
		$rs = mysql_query($sql);
		list($Description) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Categor&iacute;a $Description";
		$IsNew = 0;
	}	
	else {
		$PageTitle = "Nueva Categor&iacute;a";
		$IsNew = 1;
	}

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<?
	if (!$IsNew) {
?>
&nbsp;
&nbsp;
<a href="productscategory.php?Id=<? echo $Id; ?>">Categor&iacute;a</a>
&nbsp;
&nbsp;
<a href="productscategorydelete.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>

<?
	ErrorRender();
?>

</p>

<p>

<form action="productscategoryupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Description","Descripci&oacute;n",$Description,40);

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

