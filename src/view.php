<?
	$PageTitle = 'View';

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
	
	SessionPut('ViewLink',PageCurrent());
	SessionPut('FieldLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$sql = "select * from views where Id = $Id";
	$rs = mysql_query($sql);
	$reg = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$PageTitle = "View $reg->Code";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="views.php">Views</a>
&nbsp;
&nbsp;
<?
	if ($reg->IdEntity) {
?>
<a href="entity.php?Id=<? echo $reg->IdEntity ?>">Entity</a>
&nbsp;
&nbsp;
<?
	}
?>
<a href="viewform.php?Id=<? echo $Id; ?>">Update</a>
&nbsp;
&nbsp;
<a href="viewgenform.php?IdEntity=<? echo $Id; ?>">Generate File</a>
&nbsp;
&nbsp;
<a href="viewdelete.php?Id=<? echo $Id; ?>">Delete</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("Code", $reg->Code);
	if ($reg->IdEntity)
		FieldStaticGenerate("Entity", TranslateDescription('entities',$reg->IdEntity,'Code'));
	FieldStaticGenerate("Description", $reg->Description);
	FieldStaticMemoGenerate("Comments", $reg->Comments);

	FieldStaticGenerate("Creation Date/Time",$reg->DateTimeInsert);
	FieldStaticGenerate("Update Date/Time",$reg->DateTimeUpdate);
?>
</table>
<a name=fields>
<h2>Fields</h2>
<p>
<a href="fieldform.php?IdView=<?= $Id ?>">Add New Field</a>
</p>
<?
	$rsFields = mysql_query("select * from view_fields where IdView = $Id order by OrderNo");

	TableOpen(array('No','Field','Actions'),'98%');
	if (mysql_num_rows($rsFields)) {
		while ($regfld = mysql_fetch_object($rsFields)) {
			RowOpen();
			DatumLinkGenerate($regfld->OrderNo,"fieldform.php?Id=$regfld->Id&IdEntity=$Id");
			DatumGenerate($regfld->IdField);
			DatumGenerate(
				"<a href='vfieldform.php?IdView=$Id&OrderNo=$regfld->OrderNo'>Insert</a>
				<a href='vfieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=up'>Up</a>
				<a href='vfieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=down'>Down</a>
				<a href='vfieldaction.php?IdField=$regfld->Id&IdEntity=$Id&OrderNo=$regfld->OrderNo&Action=delete'>Delete</a>"	
			);
			RowClose();
		}
	}
	TableClose();
?>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

