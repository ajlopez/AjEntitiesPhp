<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');

	if (empty($Description))
		ErrorAdd('Debe ingresar Descripci&oacute;n');

	if (ErrorHas()) {
		include('newscategoryform.php');
		exit;
	}

	Connect();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " news_categories set Description = '$Description'";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$NewsCategoryLink = SessionGet("NewsCategoryLink");
	SessionRemove("NewsCategoryLink");

	PageAbsoluteRedirect($NewsCategoryLink);
	exit;
?>