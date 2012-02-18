<?
$Errors = Array();

function ErrorAdd($message) {
	global $Errors;

	$Errors[] = $message;
}

function ErrorHas() {
	global $Errors;

	return count($Errors)>0;
}

function ErrorRender() {
	global $Errors;

	foreach ($Errors as $err)
		echo $err . '<br>';
}

function ErrorShow($message,$enlace='') {
	global $PagePrefix;

	header("Location: ".$PagePrefix."errors.php?Message=".urlencode($message)."&Link=".urlencode($link));
	exit();
}

function ErrorSql() {
	if (!mysql_errno())
		return;
	$msg = mysql_error() . ' (' . mysql_errno() . ')';
	ErrorShow($msg);
}
?>