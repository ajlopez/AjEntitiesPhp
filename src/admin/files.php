<?
	$PageTitle = 'Archivos';
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');

	if (!$dir)
		$dir = '..';

	$directorio = opendir($dir);

?>
<center>
<p>
<a href='filenew.php?dir=<?= $dir ?>'>Nuevo Archivo</a>
&nbsp;&nbsp;
<a href='fileupload.php?dir=<?= $dir ?>'>Subir Archivo</a>
<p>
<?

	TableOpen(array("Archivo", "Tipo", "Acciones"), 300);	
	while ($archivo = readdir($directorio)) {
		RowOpen();

		$nombrearchivo = $dir . "/" . $archivo;

		if (is_dir($nombrearchivo)) {
			DatumLinkGenerate($archivo, "files.php?dir=$nombrearchivo");
			DatumGenerate("Directorio");
			DatumGenerate("");
		}
		else {
			DatumLinkGenerate($archivo, $nombrearchivo);
			DatumGenerate("Archivo");
			$accion = "<a href='file.php?file=$nombrearchivo'>Ver</a>";
			$accion .= "&nbsp;&nbsp;";
			$accion .= "<a href='fileedit.php?file=$nombrearchivo'>Editar</a>";
			DatumGenerate($accion);
		}
		RowClose();
	}
	TableClose();
?>
</center>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
