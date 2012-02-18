<?
	$PageTitle = 'Actualiza Entidad';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	Connect();

	if (ErrorHas()) {
		$reg->Code = $Code;
		$reg->Description = $Description;
		$reg->Name = $Name;
		$reg->SetName = $SetName;
		$reg->Descriptor = $Descriptor;
		$reg->PluralDescriptor = $PluralDescriptor;
		$reg->Genre = $Genre;
		$reg->Comments = $Comments;
	}
	
	if (!ErrorHas() && isset($Id)) {
		$sql = "select * from entities where Id = $Id";
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Entidad $reg->Code";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nueva Entidad";
		$IsNew = 1;
		if (!ErrorHas() && $IdProject)
			$reg->IdProject = $IdProject;
	}

	$rsProjects = mysql_query('select Id, Code from projects order by 2');

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entidades</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="entity.php?Id=<? echo $Id; ?>">Entidad</a>
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

<form action="entityupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Code","Código de Entidad",$reg->Code,16,true);
	FieldComboRsGenerate("IdProject","Proyecto", $rsProjects, $reg->IdProject, 'Id', 'Code', true);
	FieldTextGenerate("Description","Descripción",$reg->Description,40,true);
	FieldTextGenerate("Name","Nombre",$reg->Name,40,true);
	FieldTextGenerate("SetName","Nombre de Conjunto",$reg->SetName,40,true);
	FieldTextGenerate("TableName","Nombre de Tabla",$reg->TableName,40);
	FieldTextGenerate("Descriptor","Descriptor",$reg->Descriptor,40);
	FieldTextGenerate("PluralDescriptor","Descriptor Plural",$reg->PluralDescriptor,40);
	FieldComboHashGenerate("Genre","Género",$EntityGenres,$reg->Genre);
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
	mysql_free_result($rsProjects);
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

