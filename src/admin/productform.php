<?
	$PagePrefix = '../';
	$PageTitle = 'Actualiza Producto';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	Connect();
	
	if (isset($Id)) {
		$sql = "select Code, Description, Details, IdCategory, Price, Image from products where Id = $Id";
		$rs = mysql_query($sql);
		list($Code, $Description, $Details, $IdCategory, $Price, $Image) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Producto";
		$IsNew = 0;
	}	
	else {
		$PageTitle = "Nuevo Producto";
		$IsNew = 1;
	}

	$rsCategories = mysql_query("select Id, Description from products_categories order by Description");

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="products.php">Productos</a>
<?
	if (!$IsNew) {
?>
&nbsp;
&nbsp;
<a href="product.php?Id=<? echo $Id; ?>">Producto</a>
&nbsp;
&nbsp;
<a href="productdelete.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>

<?
	ErrorRender();
?>

</p>

<p>

<form enctype="multipart/form-data" action="productupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Code","C&oacute;digo",$Code,16);
	FieldTextGenerate("Description","Descripci&oacute;n",$Description,40);
	FieldComboRsGenerate("IdCategory","Categor&iacute;a",$rsCategories,$IdCategory);
	FieldMemoGenerate("Details","Detalle",$Details,5,20);
	FieldTextGenerate("Price","Precio",$Price,10);
	FieldTextGenerate("Image","Imagen",$Image,30);
	FieldFileGenerate("ImageFile","Imagen Local", $ImageFile, 40);
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
	mysql_free_result($rsCategories);
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

