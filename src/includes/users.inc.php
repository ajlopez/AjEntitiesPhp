<?
include_once($PagePrefix.'includes/pages.inc.php');
include_once($PagePrefix.'includes/connection.inc.php');
include_once($PagePrefix.'includes/session.inc.php');
include_once($PagePrefix.'includes/events.inc.php');

function UserControl($link='') {
	global $PHP_SELF;
	global $HTTP_SERVER_VARS;
	global $PagePrefix;

	$User = SessionGet("CurrentUser");
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
	$User = SessionGet("CurrentUser");
	if (isset($User))
		return(true);
	return(false);	
}	

function UserVerified() {
	if (!UserIdentified())
		return false;
	$User = UserCurrent();
	if (IsSet($User))
		return true;
	return false;
}

function UserCurrent() {
	return SessionGet("CurrentUser");
}

function UserId() {
	$User = UserCurrent();
	return($User->Id);
}

function UserName() {
	$User = UserCurrent();
	return($User->UserName);
}

function UserPassword() {
	$User = UserCurrent();
	return($User->Password);
}

function UserFirstName() {
	$User = UserCurrent();
	return($User->FirstName);
}

function UserLastName() {
	$User = UserCurrent();
	return($User->LastName);
}

function UserGenre() {
	$User = UserCurrent();
	return($User->Genre);
}

function UserEmail() {
	$User = UserCurrent();
	return($User->Email);
}

function UserIsAdministrator() {
	$User = UserCurrent();
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
	SessionPut("CurrentUser", $user);
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