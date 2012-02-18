<?
	$PageTitle = 'Noticias';
	$PagePrefix = '../';

	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/users.inc.php');
	include_once($PagePrefix . 'includes/forms.inc.php');
	include_once($PagePrefix . 'includes/session.inc.php');
	include_once($PagePrefix . 'includes/pages.inc.php');

	UserControl();
	AdministratorControl();

	SessionPut('NewsLink',PageActual());

	Connect();

	$sql = "select Id, Title, Abstract from news order by Title";
	$rs = mysql_query($sql);

	$titles = array("T&iacute;tulo", "Resumen");

	include_once($PagePrefix . 'includes/header.inc.php');
?>

<center>

<p>
<a href="newsform.php">Nueva Noticia...</a>
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

	DatumLinkGenerate($reg["Title"], "news.php?Id=".$reg["Id"]);
	DatumGenerate($reg["Abstract"]);

	RowClose();
}

?>

