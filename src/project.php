<?
	$PageTitle = 'Proyecto';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'entities.inc.php');
	include_once($PagePrefix.'includes/getparameters.inc.php');

	Connect();
	
	SessionPut('ProjectLink',PageActual());
	SessionPut('EntityLink',PageActual());

	if (!isset($Id))
		PageExit();

	$sql = "select * from projects where Id = $Id";
	$rs = mysql_query($sql);
	$reg = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$PageTitle = "Proyecto $reg->Code";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="projects.php">Proyectos</a>
&nbsp;
&nbsp;
<a href="projectform.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="projectdelete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("C&oacute;digo", $reg->Code);
	FieldStaticGenerate("Descripción", $reg->Description);
	FieldStaticGenerate("Base de Datos", $reg->DataBaseName);
	FieldStaticGenerate("Prefijo de Tabla", $reg->TablePrefix);
	FieldStaticGenerate("Directorio", $reg->FileSystem);
	FieldStaticMemoGenerate("Comentarios", $reg->Comments);

	FieldStaticGenerate("Fecha/Hora Alta",$reg->DateTimeInsert);
	FieldStaticGenerate("Fecha/Hora Modificación",$reg->DateTimeUpdate);
?>
</table>
<a name=entities>
<h2>Entidades</h2>
<p>
<a href="entityform.php?IdProject=<?= $Id ?>">Agrega Entidad</a>
</p>
<?
	$rsFields = mysql_query("select * from entities where IdProject = $Id order by Code");

	TableOpen(array('Id','Código','Descripción'),'98%');
	if (mysql_num_rows($rsFields)) {
		while ($regfld = mysql_fetch_object($rsFields)) {
			RowOpen();
			DatumLinkGenerate($regfld->Id,"entity.php?Id=$regfld->Id");
			DatumGenerate($regfld->Code);
			DatumGenerate($regfld->Description);
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

