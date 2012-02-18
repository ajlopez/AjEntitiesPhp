<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');

	if (empty($Description))
		ErrorAdd('Debe ingresar Descripci&oacute;n');

	if (ErrorHas()) {
		include('productcategoryform.php');
		exit;
	}

	Connect();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " products_categories set Description = '$Description'";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$NewsCategoryLink = SessionGet("ProductsCategoryLink");
	SessionRemove("ProductsCategoryLink");

	PageAbsoluteRedirect($ProductsCategoryLink);
	exit;
?>