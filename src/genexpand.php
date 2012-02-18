<?
	include_once($PagePrefix . 'project.class.php');
	include_once($PagePrefix . 'entity.class.php');

function ExpandAt($line)
{
	return ereg_replace('@{([^}]*)}','<?= $\\1 ?>',$line);
}

function Expand($line)
{
	$line = ExpandAt($line);
	
	return $line;
}

	if ($IdEntity)
		$Entity = Entity::LoadById($IdEntity);
	if (!$IdProject)
		$IdProject = $Entity->IdProject;
	if ($IdProject)
		$Project = Project::LoadById($IdProject);

	$fh = fopen($Template,'r');
	$tmpnombre = tempnam('/t','TMP');
	$fh2 = fopen($tmpnombre,'w');
	while ($line=fgets($fh))
		fputs($fh2,Expand($line));
	fclose($fh2);
	fclose($fh);
	ob_start();
	include($tmpnombre);
	$result = ob_get_contents();
	ob_end_clean();
	unlink($tmpnombre);

	$result = str_replace('<%',"<?",str_replace('%>',"?>",$result));

	if ($TargetFile) {
		$fh = fopen($TargetFile,'w');
		fputs($fh,$result);
		fclose($fh);
	}
	else {
?>
<xmp>
<?= $result ?>
</xmp>
<?
	}
?>