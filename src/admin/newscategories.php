<?
	$PageTitle = 'Categor&iacute;as de Noticias';
	$PagePrefix = '../';

	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/session.inc.php');
	include_once($PagePrefix . 'includes/pages.inc.php');

	UserControl();
	AdministratorControl();

	SessionPut('NewsCategoryLink',PageActual());

	Connect();

	$sql = "select Id, Description from news_categories order by Description";
	$rs = mysql_query($sql);

	$titles = array("Categor&iacute;a");

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="newscategoryform.php">Nueva Categor&iacute;a...</a>
<p>

<?		
	TableOpen($titles,"98%");

	while ($reg=mysql_fetch_array($rs)) 
		ShowRegister($reg);
				
	TableClose();
?>

</center>

<?
	include_once($PagePrefix . 'includes/footer.inc.php');
	Disconnect();

function ShowRegister($reg) {
	RowOpen();

	DatumLinkGenerate($reg["Description"], "newscategory.php?Id=".$reg["Id"]);

	RowClose();
}

?>

