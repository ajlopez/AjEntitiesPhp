<?
	$PageTitle = 'Entities';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/translations.inc.php');

	Connect();
	
	$sql = "select e.Id, e.Code, e.IdProject, e.Description from entities e left join projects p on e.IdProject = p.Id order by p.Code, e.Code";	 
	$rs = mysql_query($sql);

	$titles = array('Id', 'Project', 'Code', 'Description');

	SessionPut('EntityLink',PageCurrent());

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="entityform.php">New Entity...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
		DatumLinkGenerate($reg["Id"],'entity.php?Id='.$reg['Id']);
		if ($reg["IdProject"])
			DatumLinkGenerate(TranslateDescription('projects',$reg["IdProject"],'Code'),'project.php?Id='.$reg['IdProject']);
		else
			DatumGenerate('');
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