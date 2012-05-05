<?
	if ($View)
		$PageTitle = $View->Title;
	else
		$PageTitle = $Entity->Descriptor;

	$FieldList = $Entity->GetFieldList();
	$TableName = $Entity->TableName;
	$IdField = $Entity->GetIdField();
	$DescriptorField = $Entity->GetDescriptorField();
	$Fields = $Entity->GetFields();
	$Columns = $Entity->GetFieldNames();
?>
<%
	$PageTitle = '@{Entity->Descriptor}';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');

	if (!isset($Id))
		PageExit();

	Connect();
	
	SessionPut('@{Entity->Code}Link',PageCurrent());

	$sql = "select * from @{Entity->TableName} where Id = $Id";
	$rs = mysql_query($sql);
	$reg = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$PageTitle = "@{Entity->Descriptor} $reg->@{DescriptorField->Name}";

	include_once($PagePrefix.'includes/header.inc.php');
%>

<center>

<p>
<a href="@{Entity->SetName}.php">@{Entity->PluralDescriptor}</a>
&nbsp;
&nbsp;
<a href="@{Entity->Name}form.php?Id=<% echo $Id; %>">Actualiza</a>
&nbsp;
&nbsp;
<a href="@{Entity->Name}delete.php?Id=<% echo $Id; %>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<%
<?
	foreach ($Fields as $fld) {
?>
	FieldStaticGenerate("<?=$fld->Name?>",$reg-><?=$fld->Name?>);
<?
	}
?>
%>
</table>

</center>

<%
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
%>

