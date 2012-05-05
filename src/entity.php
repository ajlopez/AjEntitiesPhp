<?
	$PageTitle = 'Entity';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/getparameters.inc.php');
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

	$PageTitle = "Entity $reg->Code";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entities</a>
&nbsp;
&nbsp;
<?
	if ($reg->IdProject) {
?>
<a href="project.php?Id=<? echo $reg->IdProject ?>">Project</a>
&nbsp;
&nbsp;
<?
	}
?>
<a href="entityform.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="entitygenform.php?IdEntity=<? echo $Id; ?>">Generate File</a>
&nbsp;
&nbsp;
<a href="entitydelete.php?Id=<? echo $Id; ?>">Delete</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Code", $reg->Code);
	if ($reg->IdProject)
		FieldStaticGenerate("Project", TranslateDescription('projects',$reg->IdProject,'Code'));
	FieldStaticGenerate("Description", $reg->Description);
	FieldStaticGenerate("Name", $reg->Name);
	FieldStaticGenerate("Set Name", $reg->SetName);
	FieldStaticGenerate("Table Name", $reg->TableName);
	FieldStaticGenerate("Descriptor", $reg->Descriptor);
	FieldStaticGenerate("Set Descriptor", $reg->PluralDescriptor);
	FieldStaticGenerate("Genre", $EntityGenres[$reg->Genre]);
	FieldStaticMemoGenerate("Comments", $reg->Comments);

	FieldStaticGenerate("Creation Date/Time",$reg->DateTimeInsert);
	FieldStaticGenerate("Update Date/Time",$reg->DateTimeUpdate);
?>
</table>
<a name=fields>
<h2>Fields</h2>
<p>
<a href="fieldform.php?IdEntity=<?= $Id ?>">Add New Field</a>
</p>
<?
	$rsFields = mysql_query("select * from entity_fields where IdEntity = $Id order by OrderNo");

	TableOpen(array('No','Name','Type','SQL Type','Actions'),'98%');
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
				"<a href='fieldform.php?IdEntity=$Id&OrderNo=$regfld->OrderNo'>Insert</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=up'>Up</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=down'>Down</a>
				<a href='fieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=delete'>Delete</a>"	
			);
			RowClose();
		}
	}
	TableClose();
	mysql_free_result($rsFields);
?>

<a name=views>
<h2>Views</h2>
<p>
<a href="viewform.php?IdEntity=<?= $Id ?>">Add New View</a>
</p>
<?
	$rsViews = mysql_query("select * from views where IdEntity = $Id order by Code");

	TableOpen(array('Id','Code','Description'),'98%');
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

