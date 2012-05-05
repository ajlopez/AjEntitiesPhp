<?
	$PageTitle = 'Entidad';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	Connect();
	
	SessionPut('EntityLink',PageCurrent());
	SessionPut('FieldLink',PageCurrent());
	SessionPut('ViewLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$sql = "select * from entities where Id = $Id";
	$rs = mysql_query($sql);
	$reg = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$PageTitle = "Entidad $reg->Code";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entidades</a>
&nbsp;
&nbsp;
<?
	if ($reg->IdProject) {
?>
<a href="project.php?Id=<? echo $reg->IdProject ?>">Proyecto</a>
&nbsp;
&nbsp;
<?
	}
?>
<a href="entityform.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="entitygenform.php?IdEntity=<? echo $Id; ?>">Genera Archivo</a>
&nbsp;
&nbsp;
<a href="entitydelete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("C&oacute;digo", $reg->Code);
	if ($reg->IdProject)
		FieldStaticGenerate("Proyecto", TranslateDescription('projects',$reg->IdProject,'Code'));
	FieldStaticGenerate("Descripción", $reg->Description);
	FieldStaticGenerate("Nombre", $reg->Name);
	FieldStaticGenerate("Nombre de Conjunto", $reg->SetName);
	FieldStaticGenerate("Nombre de Tabla", $reg->TableName);
	FieldStaticGenerate("Descriptor", $reg->Descriptor);
	FieldStaticGenerate("Descriptor Plural", $reg->PluralDescriptor);
	FieldStaticGenerate("Género", $EntityGenres[$reg->Genre]);
	FieldStaticMemoGenerate("Comentarios", $reg->Comments);

	FieldStaticGenerate("Fecha/Hora Alta",$reg->DateTimeInsert);
	FieldStaticGenerate("Fecha/Hora Modificación",$reg->DateTimeUpdate);
?>
</table>
<a name=fields>
<h2>Campos</h2>
<p>
<a href="fieldform.php?IdEntity=<?= $Id ?>">Agrega Campo</a>
</p>
<?
	$rsFields = mysql_query("select * from entity_fields where IdEntity = $Id order by OrderNo");

	TableOpen(array('No','Nombre','Tipo','Tipo SQL','Acciones'),'98%');
	if (mysql_num_rows($rsFields)) {
		while ($regfld = mysql_fetch_object($rsFields)) {
			RowOpen();
			DatumLinkGenerate($regfld->OrderNo,"fieldform.php?Id=$regfld->Id&IdEntity=$Id");
			DatumGenerate($regfld->Name);
			DatumGenerate($FieldTypes[$regfld->Type]);
			if ($regfld->SqlLength)
				DatumGenerate("$regfld->SqlType($regfld->SqlLength)");
			else
				DatumGenerate($regfld->SqlType);
			DatumGenerate(
				"<a href='fieldform.php?IdEntity=$Id&OrderNo=$regfld->OrderNo'>Insertar</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=up'>Subir</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=down'>Bajar</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=delete'>Eliminar</a>"	
			);
			RowClose();
		}
	}
	TableClose();
	mysql_free_result($rsFields);
?>

<a name=views>
<h2>Vistas</h2>
<p>
<a href="viewform.php?IdEntity=<?= $Id ?>">Agrega Vista</a>
</p>
<?
	$rsViews = mysql_query("select * from views where IdEntity = $Id order by Code");

	TableOpen(array('Id','Código','Descripción'),'98%');
	if (mysql_num_rows($rsViews)) {
		while ($regview = mysql_fetch_object($rsViews)) {
			RowOpen();
			DatumLinkGenerate($regview->Id,"view.php?Id=$regview->Id");
			DatumGenerate($regview->Code);
			DatumGenerate($regview->Description);
			RowClose();
		}
	}
	TableClose();
	mysql_free_result($rsViews);
?>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

