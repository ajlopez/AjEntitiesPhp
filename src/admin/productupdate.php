<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');

	if (empty($Code))
		ErrorAdd('Debe ingresar C&oacute;digo');

	if (empty($Description))
		ErrorAdd('Debe ingresar Descripci&oacute;n');

	if (empty($Price))
		ErrorAdd('Debe ingresar Precio');

	if (ErrorHas()) {
		include('productform.php');
		exit;
	}

	$Price += 0;

   if ($ImageFile) {
		copy($ImageFile, '../images/'. $_FILES['ImageFile']['name']);
		$Image = $_FILES['ImageFile']['name'];
	}

	Connect();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " products set Code = '$Code',
			Description = '$Description',
			IdCategory = $IdCategory,
			Details = '$Details',
			Price = $Price,
			Image = '$Image'";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	if (mysql_errno())
		echo mysql_error();

	Disconnect();

	$NewsLink = SessionGet("ProductLink");
	SessionRemove("ProductLink");

	PageAbsoluteRedirect($ProductLink);
	exit;
?>