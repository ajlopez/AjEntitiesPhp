<?
	$PageTitle = 'Vistas';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/translations.inc.php');

	Connect();
	
	$sql = "select v.Id, v.Code, v.IdEntity, v.Description, e.IdProject from (views v left join entities e on v.IdEntity = e.Id) left join projects p on e.IdProject = p.Id";
	$sql .= " order by p.Code, e.Code, v.Code";	 
	$rs = mysql_query($sql);

	$titles = array('Id', 'Proyecto', 'Entidad', 'Código', 'Descripción');

	SessionPut('ViewLink',PageCurrent());

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="viewform.php">Nueva Vista...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
		DatumLinkGenerate($reg["Id"],'view.php?Id='.$reg['Id']);
		DatumLinkGenerate(TranslateDescription('projects',$reg["IdProject"],'Code'),'project.php?Id='.$reg['IdProject']);
		DatumLinkGenerate(TranslateDescription('entities',$reg["IdEntity"],'Code'),'entity.php?Id='.$reg['IdEntity']);
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