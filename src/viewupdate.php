<?
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');

	$IsPostBack = true;

	if (empty($Code))
		ErrorAdd('Debe ingresar Código');

	if (empty($Description))
		ErrorAdd('Debe ingresar Descripción');

	if (empty($IdEntity))
		ErrorAdd('Debe ingresar Entidad');

	Connect();

	$IdEntity += 0;

	$rsEntity = mysql_query("select * from entities where Id = $IdEntity");
	$Entity = mysql_fetch_object($rsEntity);
	mysql_free_result($rsEntity);

	$IdProject += 0;

	if (empty($Id)) {
		$sql = "Select v.Id from views v left join entities e on v.IdEntity=e.Id where v.Code = '$Code' and e.IdProject = $Entity->IdProject";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Vista existente');

		mysql_free_result($res);	
	}
	else {
		$sql = "Select v.Id from views v left join entities e on v.IdEntity=e.Id where v.Code = '$Code' and e.IdProject = $Entity->IdProject and v.Id <> $Id";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Vista existente');

		mysql_free_result($res);	
	}

	if (ErrorHas()) {
		Disconnect();
		include('viewform.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " views set Code = '$Code',
			IdEntity = $IdEntity,
			Description = '$Description',
			Comments = '$Comments'";

	if (empty($Id))
		$sql .= ", DateTimeInsert = Now(), DateTimeUpdate = Now()";
	else
		$sql .= ", DateTimeUpdate = Now()";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$ViewLink = SessionGet("ViewLink");
	SessionRemove("ViewLink");

	PageAbsoluteRedirect($ViewLink);
	exit;
?>