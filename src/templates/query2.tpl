<%
	$PageTitle = 'Usuarios';
	$PagePrefix = '../';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');

	UserControl();
	AdministratorControl();

	Connect();
	
	$sql = "select @{Query->FieldList()} from @{Entity->TableName}@{Query->WhereClause()}@{Query->OrderClause()}";	 
	$rs = mysql_query($sql);

	$titles = array(@{Query->TitleList()});

	include_once($PagePrefix . 'includes/header.inc.php');
%>

<center>

<p>
<a href="@{Entity->Name}form.php">Nuev@{Entity->GenreVocal()} @{Entity->Descriptor}...</a>
<p>

<%		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
<?
	$Query->GenerateColumns();
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