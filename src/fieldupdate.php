<?
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');

	if (empty($Name))
		ErrorAdd('Debe ingresar Nombre de Campo');

	if (empty($IdEntity))
		PageRedirect('entities.php');

	Connect();

	if (empty($Id)) {
		$sql = "Select Id from entity_fields where Name = '$Name' and IdEntity = $IdEntity";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Campo existente');

		mysql_free_result($res);
	}
	else {
		$sql = "Select Id from entity_fields where Name = '$Name' and IdEntity = $IdEntity and Id <> $Id";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Campo existente');

		mysql_free_result($res);
	}

	if (ErrorHas()) {
		Disconnect();
		include('fieldform.php');
		exit;
	}

	$Type += 0;

	if (empty($Id)) {
		if (empty($OrderNo)) {
			$rsMaxOrder = mysql_query("select max(OrderNo) from entity_fields where IdEntity = $IdEntity");
			list($MaxId) = mysql_fetch_row($rsMaxOrder);
			mysql_free_result($rsMaxOrder);
			$OrderNo = $MaxId+1;
		}
		else {
			mysql_query("update entity_fields set OrderNo = OrderNo + 1 where IdEntity=$IdEntity and OrderNo>=$OrderNo");			
		}
	}

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " entity_fields set Name = '$Name',
			IdEntity = $IdEntity,
			Description = '$Description',
			Type = $Type,
			SqlType = '$SqlType',
			SqlLength = '$SqlLength',
			Title = '$Title',
			Legend = '$Legend',
			Comments = '$Comments'";

	if (empty($Id))
		$sql .= ", OrderNo = $OrderNo, DateTimeInsert = Now(), DateTimeUpdate = Now()";
	else
		$sql .= ", DateTimeUpdate = Now()";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	if (mysql_errno()) {
		ErrorAdd(mysql_error());
		Disconnect();
		include('fieldform.php');
		exit();
	}

	Disconnect();

	$FieldLink = SessionGet("FieldLink");
	SessionRemove("FieldLink");

	PageAbsoluteRedirect($FieldLink);
	exit;
?>