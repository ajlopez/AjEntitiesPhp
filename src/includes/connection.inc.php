<?
	include_once($PagePrefix.'includes/configuration.inc.php');

	$Connected = 0;

function Connect() {
	global $Connected;
	global $MySqlHost;
	global $MySqlUser;
	global $MySqlPwd;
	global $MySqlBase;

	if (!$Connected) {
		mysql_connect($MySqlHost, $MySqlUser, $MySqlPwd);
		if (mysql_errno())
			echo mysql_error();
	}
		
	mysql_select_db($MySqlBase);
	$Connected++;
}

function Disconnect() {
	global $Connected;

	if ($Connected>1)
		$Connected--;
	else if ($Connected) {
		mysql_close();
		$Connected=0;
	}
}
?>