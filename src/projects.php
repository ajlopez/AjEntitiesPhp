<?
	$PageTitle = 'Projects';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');

	Connect();
	
	$sql = "select Id, Code, Description from projects order by Code";	 
	$rs = mysql_query($sql);

	$titles = array('Id', 'Code', 'Description');

	SessionPut('ProjectLink',PageActual());

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="projectform.php">New Project...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
		DatumLinkGenerate($reg["Id"],'project.php?Id='.$reg['Id']);
		DatumGenerate($reg["Code"]);
		DatumGenerate($reg["Description"]);
		RowClose();
	}
				
	TableClose();
?>

</center>

<?
	include_once($PagePrefix . 'includes/footer.inc.php');
	Disconnect();
?>