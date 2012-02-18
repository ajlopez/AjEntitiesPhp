<?
function ExpandAt($line)
{
	return ereg_replace('@{([^}]*)}','<?= $\\1 ?>',$line);
}

function Expand($line)
{
	$line = ExpandAt($line);
	
	return $line;
}

	$fh = fopen($archivo,'r');
?>
<xmp>
<?
	while ($line=fgets($fh))
		echo Expand($line);
?>
</xmp>