<?
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');
	include_once($PagePrefix.'includes/postparameters.inc.php');

	$IsPostBack = true;

	if (empty($Code))
		ErrorAdd('Code is Required');

	if (empty($Description))
		ErrorAdd('Description is Required');

	if (empty($Name))
		ErrorAdd('Name is Required');

	if (empty($SetName))
		ErrorAdd('Set Name is Required');

	Connect();

	$IdProject += 0;

	if (empty($Id)) {
		$sql = "Select Id from entities where Code = '$Code' and IdProject = $IdProject";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Entidad existente');

		mysql_free_result($res);	
	}
	else {
		$sql = "Select Id from entities where Code = '$Code' and IdProject = $IdProject and Id <> $Id";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Entidad existente');

		mysql_free_result($res);	
	}

	if (ErrorHas()) {
		Disconnect();
		include('entityform.php');
		exit;
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " entities set Code = '$Code',
			IdProject = $IdProject,
			Description = '$Description',
			Name = '$Name',
			SetName = '$SetName',
			TableName = '$TableName',
			Descriptor = '$Descriptor',
			PluralDescriptor = '$PluralDescriptor',
			Genre = '$Genre',
			Comments = '$Comments'";

	if (empty($Id))
		$sql .= ", DateTimeInsert = Now(), DateTimeUpdate = Now()";
	else
		$sql .= ", DateTimeUpdate = Now()";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$EntityLink = SessionGet("EntityLink");
	SessionRemove("EntityLink");

	PageAbsoluteRedirect($EntityLink);
	exit;
?>