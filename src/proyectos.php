<?
	$PageTitle = 'Proyectos';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/translations.inc.php');

	Connect();
	
	$sql = "select Id,Code,Description from projects order by Id";	 
	$rs = mysql_query($sql);

	$titles = array('Id','Code','Description');

	SessionPut('ProyectoLink',PageCurrent());

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="proyectoform.php">Nuevo Proyecto...</a>
<p>

<?
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
		DatumLinkGenerate($reg['Id'],'proyecto.php?Id='.$reg['Id']);
		DatumGenerate($reg['Code']);
		DatumGenerate($reg['Description']);
		RowClose();
	}
				
	TableClose();
?>

</center>

<?
	include_once($PagePrefix . 'includes/footer.inc.php');
	Disconnect();
?>