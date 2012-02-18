<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');

	if (empty($Title))
		ErrorAdd('Debe ingresar T&iacute;tulo');

	if (empty($Abstract))
		ErrorAdd('Debe ingresar Resumen');

	if (empty($Content))
		ErrorAdd('Debe ingresar Contenido');

	if (ErrorHas()) {
		include('newsform.php');
		exit;
	}

	if ($ImageFile) {
		copy($ImageFile, '../images/'. $_FILES['ImageFile']['name']);
		$Image = $_FILES['ImageFile']['name'];
	}

	Connect();

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " news set Title = '$Title',
			IdCategory = $IdCategory,
			Abstract = '$Abstract',
			Content = '$Content',
			Image = '$Image'";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$NewsLink = SessionGet("NewsLink");
	SessionRemove("NewsLink");

	PageAbsoluteRedirect($NewsLink);
	exit;
?>