<?
	if ($View)
		$PageTitle = $View->Title;
	else
		$PageTitle = $Entity->PluralDescriptor;

	$FieldList = $Entity->GetFieldList();
	$TableName = $Entity->TableName;
	$IdField = $Entity->GetIdField();
	$Fields = $Entity->GetFields();
	$Columns = $Entity->GetFieldNames();
	$Titles = "'" . join("','",$Columns) . "'";
?>
<%
	$PageTitle = '@{PageTitle}';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/translations.inc.php');

	Connect();
	
	$sql = "select @{FieldList} from @{TableName} order by @{IdField->Name}";	 
	$rs = mysql_query($sql);

	$titles = array(@{Titles});

	SessionPut('@{Entity->Code}Link',PageCurrent());

	include_once($PagePrefix . 'includes/header.inc.php');
%>

<center>

<p>
<a href="@{Entity->Name}form.php">Nuev@{Entity->GetGenre()} @{Entity->Descriptor}...</a>
<p>

<%
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
<?
	foreach ($Fields as $fld) {
		if ($fld->Name == $IdField->Name) {
?>
		DatumLinkGenerate($reg['@{fld->Name}'],'@{Entity->Name}.php?Id='.$reg['@{fld->Name}']);
<?
		}
		else	{
?>
		DatumGenerate($reg['@{fld->Name}']);
<?
		}
	}
?>
		RowClose();
	}
				
	TableClose();
%>

</center>

<%
	include_once($PagePrefix . 'includes/footer.inc.php');
	Disconnect();
%>