<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');

	if (empty($UserName))
		ErrorShow('Debe ingresar Código');

	if (empty($Password))
		ErrorShow('Debe ingresar Contraseña');

	Connect();

	$sql = "Select * from users where UserName = '$UserName'";
	$res = mysql_query($sql);

	if (!$res || mysql_num_rows($res)==0) {
		Disconnect();
		ErrorShow('Usuario inexistente');
	}

	$user = mysql_fetch_object($res);
	mysql_free_result($res);

	if ($user->Password != $Password) {
		Disconnect();
		ErrorShow('Contraseña incorrecta');
	}

	UserLogin($user);

	Disconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($UserLink);
	exit;
?>