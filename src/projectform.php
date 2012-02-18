<?
	$PageTitle = 'Actualiza Proyecto';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	Connect();

	if ($IsPostBack) {
		$reg->Code = $Code;
		$reg->Description = $Description;
		$reg->DataBaseName = $DataBaseName;
		$reg->FileSystem = $FileSystem;
		$reg->TablePrefix = $TablePrefix;
	}
	
	if (!ErrorHas() && isset($Id)) {
		$sql = "select * from projects where Id = $Id";
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Proyecto $reg->Code";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nuevo Proyecto";
		$IsNew = 1;
	}

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="projects.php">Proyectos</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="project.php?Id=<? echo $Id; ?>">Proyecto</a>
&nbsp;
&nbsp;
<?
	}
?>
</p>


<?
	ErrorRender();
?>

<p>

<form action="projectupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Code","Código de Proyecto",$reg->Code,16,true);
	FieldTextGenerate("Description","Descripción",$reg->Description,40,true);
	FieldTextGenerate("DataBaseName","Base de Datos",$reg->DataBaseName,40);
	FieldTextGenerate("TablePrefix","Prefijo de Tabla",$reg->TablePrefix,20);
	FieldTextGenerate("FileSystem","Directorio",$reg->FileSystem,40);
	FieldMemoGenerate("Comments","Comentarios",$reg->Comments);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

