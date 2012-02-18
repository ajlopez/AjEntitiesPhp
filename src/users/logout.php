<?
	$PagePrefix = '../';
	include($PagePrefix.'includes/pages.inc.php');
	include($PagePrefix.'includes/users.inc.php');

	UserLogout();

	PageRedirect(PageMain());
?>