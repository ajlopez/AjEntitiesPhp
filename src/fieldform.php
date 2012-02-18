<?
	if (!isset($IdEntity))
		PageExit();

	$PageTitle = 'Actualiza Campo';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	Connect();

	$EntityName = TranslateDescription('entities',$IdEntity);

	if (ErrorHas()) {
		$reg->Name = $Name;
		$reg->Description = $Description;
		$reg->Title = $Title;
		$reg->Legend = $Legend;
		$reg->Type = $Type;
		$reg->SqlType = $SqlType;
		$reg->SqlLength = $SqlLength;
		$reg->Comments = $Comments;
	}
	
	if (!ErrorHas() && isset($Id)) {
		$sql = "select * from entity_fields where Id = $Id";
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Campo $reg->Name de Entidad $EntityName";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nuevo Campo de Entidad $EntityName";
		$IsNew = 1;
	}

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entidades</a>
&nbsp;
&nbsp;
<a href="entity.php?Id=<?= $IdEntity ?>">Entidad</a>
&nbsp;
&nbsp;
</p>


<?
	ErrorRender();
?>

<p>

<form action="fieldupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Name","Nombre",$reg->Name,40,true);
	FieldTextGenerate("Description","Descripción",$reg->Description,40);
	FieldComboHashGenerate("Type","Tipo",$FieldTypes,$reg->Type,2);
	FieldTextGenerate("SqlType","Tipo SQL",$reg->SqlType,20);
	FieldTextGenerate("SqlLength","Tamaño SQL",$reg->SqlLength,10);
	FieldTextGenerate("Title","Título",$reg->Title,40);
	FieldTextGenerate("Legend","Leyenda",$reg->Legend,40);
	FieldMemoGenerate("Comments","Comentarios",$reg->Comments);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
	FieldHiddenGenerate('IdEntity',$IdEntity);
	if ($OrderNo)
		FieldHiddenGenerate('OrderNo',$OrderNo);
?>

</form>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

