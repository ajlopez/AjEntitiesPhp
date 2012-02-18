<?
	if (!$Entity)
		PageRedirect('index.php');

	$PageTitle = $Entity->SetName;
	$PagePrefix = '../';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/pages.inc.php');

	UserControl();
	AdministratorControl();

	Connect();
	
	$sql = "select Id, Description from $Entity->Table order by 2";	 
	$rs = mysql_query($sql);

	$titles = array("Descripci&oacute;n");

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="<?= $Entity->Entity ?>form.php">Nuevo <?= $Entity->Name ?>...</a>
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
	global $Entity;

	RowOpen();
	DatumLinkGenerate($reg["Description"], $Entity->Entity . ".php?Id=".$reg["Id"]);
	RowClose();
}

?>

