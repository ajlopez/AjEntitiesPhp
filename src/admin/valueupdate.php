<?
	if (!$Entity)
		PageRedirect('index.php');

	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');

	if (empty($Description))
		ErrorAdd('Debe ingresar Descripci&oacute;n');

	if (ErrorHas()) {
		include($Entity->Entity . 'form.php');
		exit;
	}

	Connect();

	$IdGenre += 0;
	$IdCountry += 0;

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " $Entity->Table set Description = '$Description'";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$EntityLink = SessionGet($Entity->Entity. "Link");
	SessionRemove($Entity->Entity . "Link");

	PageAbsoluteRedirect($EntityLink);
	exit;
?>