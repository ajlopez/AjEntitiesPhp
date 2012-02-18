<%
	$PageTitle = 'Usuarios';
	$PagePrefix = '../';
	
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');

	UserControl();
	AdministratorControl();

	Connect();
	
	$sql = "select @{FieldList} from @{TableName} order by @{OrderBy}";	 
	$rs = mysql_query($sql);

	$titles = array(@{TitleList});

	include_once($PagePrefix . 'includes/header.inc.php');
%>

<center>

<p>
<a href="@{entity}form.php">Nuev@{genre} @{Entity}...</a>
<p>

<%		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) {
		RowOpen();
<?
	GenerateColumns();
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