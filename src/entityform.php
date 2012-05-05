<?
	$PageTitle = 'Update Entity';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/getparameters.inc.php');
	include_once($PagePrefix.'includes/postparameters.inc.php');

	include_once($PagePrefix.'entities.inc.php');

	Connect();

	if (ErrorHas()) {
		$reg->Code = $Code;
		$reg->IdProject = $IdProject;
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
		$PageTitle = "Update Entity $reg->Code";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "New Entity";
		$IsNew = 1;
		if (!ErrorHas() && $IdProject)
			$reg->IdProject = $IdProject;
	}

	$rsProjects = mysql_query('select Id, Code from projects order by 2');

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entities</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="entity.php?Id=<? echo $Id; ?>">Entity</a>
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

	FieldTextGenerate("Code","Entity Code",$reg->Code,16,true);
	FieldComboRsGenerate("IdProject","Project", $rsProjects, $reg->IdProject, 'Id', 'Code', true);
	FieldTextGenerate("Description","Description",$reg->Description,40,true);
	FieldTextGenerate("Name","Name",$reg->Name,40,true);
	FieldTextGenerate("SetName","Set Name",$reg->SetName,40,true);
	FieldTextGenerate("TableName","Table Name",$reg->TableName,40);
	FieldTextGenerate("Descriptor","Descriptor",$reg->Descriptor,40);
	FieldTextGenerate("PluralDescriptor","Set Descriptor",$reg->PluralDescriptor,40);
	FieldComboHashGenerate("Genre","Genre",$EntityGenres,$reg->Genre);
	FieldMemoGenerate("Comments","Comments",$reg->Comments);

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
