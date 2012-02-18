<?
	$PageTitle = 'Actualiza Vista';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'entities.inc.php');

	Connect();

	if ($IsPostBack) {
		$reg->Code = $Code;
		$reg->IdEntity = $IdEntity;
		$reg->Description = $Description;
		$reg->Comments = $Comments;
	}
	
	if (!$IsPostBack && isset($Id)) {
		$sql = "select * from views where Id = $Id";
		$rs = mysql_query($sql);
		$reg = mysql_fetch_object($rs);
		mysql_free_result($rs);
		$PageTitle = "Actualiza Vista $reg->Code";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nueva Vista";
		$IsNew = 1;
		if (!$IsPostBack && $IdEntity)
			$reg->IdEntity = $IdEntity;
	}

	if ($IdProject)
		$rsEntities = mysql_query("select Id, Code from entities where IdProject = $IdProject order by 2");
	else
		$rsEntities = mysql_query("select e.Id, Concat(p.Code, ' - ', e.Code) as Code from entities e left join projects p on e.IdProject = p.Id order by 2");

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="views.php">Vistas</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="view.php?Id=<? echo $Id; ?>">Vista</a>
&nbsp;
&nbsp;
<?
	}
?>
</p>


<?
	ErrorRender();
?>

<p>

<form action="viewupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("Code","C�digo de Vista",$reg->Code,16,true);
	FieldComboRsGenerate("IdEntity","Entidad", $rsEntities, $reg->IdEntity, 'Id', 'Code', true);
	FieldTextGenerate("Description","Descripci�n",$reg->Description,40,true);
	FieldMemoGenerate("Comments","Comentarios",$reg->Comments);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
	FieldHiddenGenerate('IdProject',$IdProject);
?>

</form>

</center>

<?
	mysql_free_result($rsProjects);
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

