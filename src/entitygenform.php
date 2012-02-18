<?
	$PageTitle = 'Genera Archivo de Entidad';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	if (!isset($IdEntity))
		PageRedirect('entities.php');

	Connect();

	$sql = "select * from entities where Id = $IdEntity";
	$rs = mysql_query($sql);
	$reg = mysql_fetch_object($rs);
	mysql_free_result($rs);

	$PageTitle = "Genera Archivo de Entidad $reg->Code";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="entities.php">Entidades</a>
&nbsp;
&nbsp;
<a href="entity.php?Id=<? echo $IdEntity; ?>">Entidad</a>
&nbsp;
&nbsp;
</p>

<?
	ErrorRender();
?>

<p>

<form action="entitygen.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	FieldTextGenerate("Template","Archivo de Template",$Template,40,true);
	FieldTextGenerate("Target","Archivo Destino",$Target,40);

	FieldOkGenerate();
?>
</table>

<?
	FieldHiddenGenerate('IdEntity',$IdEntity);
?>

</form>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>
