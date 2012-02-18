<?
include_once($PagePrefix.'includes/pages.inc.php');
include_once($PagePrefix.'includes/connection.inc.php');
include_once($PagePrefix.'includes/session.inc.php');
include_once($PagePrefix.'includes/events.inc.php');

function UserControl($link='') {
	global $PHP_SELF;
	global $HTTP_SERVER_VARS;
	global $PagePrefix;

	$User = SessionGet("ActualUser");
	$UserId = $User->Id;

	if (empty($UserId)) {
		if (empty($link)) {
			$enlace = $PHP_SELF;
			if ($HTTP_SERVER_VARS["QUERY_STRING"])
				$enlace .= "?" . $HTTP_SERVER_VARS["QUERY_STRING"];
		}
		SessionPut("UserLink", $link);
		PageRedirect('users/login.php');
		exit;
	}
}

function UserIdentified() {
	$User = SessionGet("ActualUser");
	if (isset($User))
		return(true);
	return(false);	
}	

function UserVerified() {
	if (!UserIdentified())
		return false;
	$User = UserActual();
	if (IsSet($User))
		return true;
	return false;
}

function UserActual() {
	return SessionGet("ActualUser");
}

function UserId() {
	$User = UserActual();
	return($User->Id);
}

function UserName() {
	$User = UserActual();
	return($User->UserName);
}

function UserPassword() {
	$User = UserActual();
	return($User->Password);
}

function UserFirstName() {
	$User = UserActual();
	return($User->FirstName);
}

function UserLastName() {
	$User = UserActual();
	return($User->LastName);
}

function UserGenre() {
	$User = UserActual();
	return($User->Genre);
}

function UserEmail() {
	$User = UserActual();
	return($User->Email);
}

function UserIsAdministrator() {
	$User = UserActual();
	return($User->IsAdministrator);
}

function UserIsUser() {
	if (!UserIsAdministrator())
		return true;
	return false;
}

function UserIsInRole($role) {
}

function UserRole() {
	if (UserIsAdministrator())
		return 'Administrator';
	if (UserIdentified() && UserIsUser())
		return 'User';
}

function AdministratorControl($link='') {
	UserControl($link);

	if (!UserIsAdministrator())
		PageRedirect(PageMain());
}

function UserLogin($user) {
	SessionPut("ActualUser", $user);
	EventLogin();
	Connect();
	mysql_query("update users set DateTimeLastLogin = now(), LoginCount = LoginCount+1 where Id = " . UserId());
	Disconnect();
}

function UserLogout() {
	EventLogout();
	SessionDestroy();
}

function UserTranslate($Id) {
	global $UsersTable;

	if (!$Id)
		return '';

	if ($UsersTabla[$Id])
		return $UsersTabla[$Id];

	Connect();

	$rs = mysql_query("select UserName from users where Id = $Id");

	if ($rs && mysql_num_rows($rs))
		list($Code) = mysql_fetch_row($rs);
	else
		$Code = $Id;

	mysql_free_result($rs);

	$UsersTable[$Id] = $Code;

	Disconnect();

	return $Code;
}
?>