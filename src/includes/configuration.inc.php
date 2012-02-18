<?

define('SiteName', 'ajentities');
define('SiteLogo', 'ajentities.gif');
define('SiteDescription', 'ajentities - Sistema de Entidades');


$MySqlHost = 'localhost';
$MySqlBase = 'ajentities';
$MySqlUser = 'root';
$MySqlPwd = '';

$Host = $HTTP_SERVER_VARS["HTTP_HOST"];

switch ($Host)
{

}

function IsLocalhost() {
	global $Host;

	if (strstr($Host,"127.0.0.1") || strstr($Host,"localhost"))
		return true;

	return false;
}

function IsRemote() {
	global $Host;

	if (strstr($Host,"ajlopez"))
		return true;

	return false;
}


if (IsLocalhost()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'ajentities';
	$MySqlUser = 'root';
	$MySqlPwd = '';
}

if (IsRemote()) {
	$MySqlHost = 'localhost';
	$MySqlBase = 'ajentities';
	$MySqlUser = 'root';
	$MySqlPwd = '';
}

?>