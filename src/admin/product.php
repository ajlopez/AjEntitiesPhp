<?
	$PagePrefix = '../';
	$PageTitle = 'Producto';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');

	UserControl();
	AdministratorControl();
	
	Connect();

	SessionPut('ProductLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$sql = "select Code, Description, Price, Details, IdCategory, Image from products where Id = $Id";
	$rs = mysql_query($sql);
	list($Code, $Description, $Price, $Details, $IdCategory, $Image) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="products.php">Productos</a>
&nbsp;
&nbsp;
<a href="../products/product.php?Id=<? echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="productform.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="productdelete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("C&oacute;digo", $Code);
	FieldStaticGenerate("Descripci&oacute;n", $Description);
	FieldStaticGenerate("Detalle", $Details);
	FieldStaticGenerate("Precio", $Price);
	FieldStaticGenerate("Imagen", $Image);
?>
</table>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

