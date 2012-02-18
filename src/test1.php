<?
	$nombre = tempnam('/t','TMP');
	echo $nombre;
	$fh = fopen($nombre,'w');
	fputs($fh,"<h1>Prueba</h1>");
	fputs($fh,"<? echo '<h2>Prueba</h2>'; ?>");
	fclose($fh);
	include($nombre);
	unlink($nombre);
?>