<?
	$PagePrefix = '../';
	$PageTitle = 'Actualiza Noticia';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	Connect();
	
	if (isset($Id)) {

		if (!ErrorHas()) {
			$sql = "select Title, IdCategory, Abstract, Content, Image, DateTimeCreated, DateTimeModified from news where Id = $Id";
			$rs = mysql_query($sql);
			list($Title, $IdCategory, $Abstract, $Content, $Image, $DateTimeCreated, $DateTimeModified) = mysql_fetch_row($rs);
			mysql_free_result($rs);
		}

		$PageTitle = "Actualiza Noticia";
		$IsNew = 0;
	}	
	else {
		$PageTitle = "Nueva Noticia";
		$IsNew = 1;
	}

	$rsCategories = mysql_query("select Id, Description from news_categories order by Description");

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="newsall.php">Noticias</a>
<?
	if (!$IsNew) {
?>
&nbsp;
&nbsp;
<a href="news.php?Id=<? echo $Id; ?>">Noticia</a>
&nbsp;
&nbsp;
<a href="newsdelete.php?Id=<? echo $Id; ?>">Elimina</a>
<?
	}
?>

<?
	ErrorRender();
?>

</p>

<p>

<form enctype="multipart/form-data" action="newsupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form">
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Title","T&iacute;tulo",$Title,40);
	FieldComboRsGenerate("IdCategory","Categor&iacute;a",$rsCategories,$IdCategory);
	FieldMemoGenerate("Abstract","Resumen",$Abstract,5,60);
	FieldMemoGenerate("Content","Contenido",$Content,30,60);
	FieldTextGenerate("Image", "Imagen", $Image, 40);
	FieldFileGenerate("ImageFile","Imagen Local", $ImageFile, 40);
	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

</center>

<?
	mysql_free_result($rsCategories);
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

