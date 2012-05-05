<?
	include_once($PagePrefix.'includes/random.inc.php');

function PageCurrent() {
	$link = $_SERVER['SCRIPT_NAME'];

	if ($_SERVER['QUERY_STRING'])
		$link .= '?' . $_SERVER['QUERY_STRING'];

	return $link;
}

function PageMain() {
	return "index.php";
}

function PageUser() {
	return "user/index.php";
}

function PageAdministrator() {
	return "admin/index.php";
}

function PageControl($link = '') {
	if ($link)
		return $link;

	return PageMain();
}

function PageRedirect($link = '', $alternative = '') {
	global $PagePrefix;

	if (!$link && !$alternative)
		header("Location: $PagePrefix" . PageControl());
	elseif (!$link)
		header("Location: $PagePrefix$alternative");
	else
		header("Location: $PagePrefix$link");
	exit;
}

function PageAbsoluteRedirect($link = '', $alternative = '') {
	global $PagePrefix;

	if (!$link && !$alternative)
		header("Location: $PagePrefix" . PageControl());
	elseif (!$link)
		header("Location: $alternative");
	else
		header("Location: $link");
	exit;
}

function PageExit() {
	PageRedirect(PageControl());
}

?>