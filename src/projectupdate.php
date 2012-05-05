<?
	$IsPostBack = true;

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');
	include_once($PagePrefix.'includes/postparameters.inc.php');

	if (empty($Code))
		ErrorAdd('Code is Required');

	if (empty($Description))
		ErrorAdd('Description is Required');

	Connect();

	if (empty($Id)) {
		$sql = "Select Id from projects where Code = '$Code'";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Proyecto existente');

		mysql_free_result($res);	
	}
	else {
		$sql = "Select Id from projects where Code = '$Code' and Id <> $Id";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Proyecto existente');

		mysql_free_result($res);	
	}

	if (ErrorHas()) {
		Disconnect();
		include('projectform.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " projects set Code = '$Code',
			Description = '$Description',
			DataBaseName = '$DataBaseName',
			TablePrefix = '$TablePrefix',
			FileSystem = '$FileSystem',
			Comments = '$Comments'";

	if (empty($Id))
		$sql .= ", DateTimeInsert = Now(), DateTimeUpdate = Now()";
	else
		$sql .= ", DateTimeUpdate = Now()";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	if (mysql_errno()) {
		ErrorAdd(mysql_error());
		Disconnect();
		include('projectform.php');
		exit();
	}

	Disconnect();

	$ProjectLink = SessionGet("ProjectLink");
	SessionRemove("ProjectLink");

	PageAbsoluteRedirect($ProjectLink);
	exit;
?>