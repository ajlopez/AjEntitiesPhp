<?
	$PageTitle = 'Usuarios';
	$PagePrefix = '../';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');

	UserControl();
	AdministratorControl();

	Connect();
	
	$sql = "select Id, UserName, FirstName, LastName from users order by UserName";	 
	$rs = mysql_query($sql);

	$titles = array("Código","Nombre","Apellido");

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="userform.php">Nuevo Usuario...</a>
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

	DatumLinkGenerate($reg["UserName"], "user.php?Id=".$reg["Id"]);
	DatumGenerate($reg["FirstName"]);
	DatumGenerate($reg["LastName"]);

	RowClose();
}

?>

