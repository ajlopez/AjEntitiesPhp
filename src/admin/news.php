<?
	$PagePrefix = '../';
	$PageTitle = 'Noticia';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');

	UserControl();
	AdministratorControl();
	
	Connect();

	SessionPut('NewsLink',PageCurrent());

	if (!isset($Id))
		PageExit();

	$sql = "select Title, IdCategory, Abstract, Content, Image, Visits, DateTimeCreated, DateTimeModified from news where Id = $Id";
	$rs = mysql_query($sql);
	list($Title, $IdCategory, $Abstract, $Content, $Image, $Visits, $DateTimeCreated, $DateTimeModified) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="newsall.php">Noticias</a>
&nbsp;
&nbsp;
<a href="../news/news.php?Id=<? echo $Id; ?>">Muestra</a>
&nbsp;
&nbsp;
<a href="newsform.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="newsdelete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("T&iacute;tulo", $Title);
	FieldStaticHtmlGenerate("Resumen", $Abstract);
	FieldStaticHtmlGenerate("Contenido", $Content);
	FieldStaticGenerate("Imagen", $Image);
	FieldStaticGenerate("Visitas", $Visits);
	FieldStaticGenerate("Fecha/Hora Alta",$DateTimeCreated);
	FieldStaticGenerate("Fecha/Hora Modificación",$DateTimeModified);
?>
</table>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

