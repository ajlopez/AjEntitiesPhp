<?
	$PageTitle = 'Productos';
	$PagePrefix = '../';

	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/session.inc.php');
	include_once($PagePrefix . 'includes/pages.inc.php');

	UserControl();
	AdministratorControl();

	SessionPut('ProductsLink',PageCurrent());

	Connect();

	$sql = "select Id, Code, Description, Price from products order by Code";
	$rs = mysql_query($sql);

	$titles = array("C&oacute;digo", "Descripci&oacute;n", "Precio");

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="productform.php">Nuevo Producto...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) 
		ShowRegister($reg);
				
	TableClose();
?>

</center>

<?
	include_once($PagePrefix . 'includes/footer.inc.php');
	Disconnect();

function ShowRegister($reg) {
	RowOpen();

	DatumLinkGenerate($reg["Code"], "product.php?Id=".$reg["Id"]);
	DatumGenerate($reg["Description"]);
	DatumNumGenerate($reg["Price"]);

	RowClose();
}

?>

