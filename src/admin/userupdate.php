<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');

	if (empty($UserName))
		ErrorAdd('Debe ingresar Código');

	if (empty($Password))
		ErrorAdd('Debe ingresar Contraseña');

	if ($Password2 != $Password)
		ErrorAdd('No coinciden las contraseñas ingresadas');

	if (!DateValidate($DateBornYear,$DateBornMonth,$DateBornDay))
		$mensaje .= "Fecha de Nacimiento inválida<br>";
	else
		$DateBorn = DateMakeSql($DateBornYear,$DateBornMonth,$DateBornDay);

	if (!SexValidate($IdGenre))
		ErrorAdd('Debe ingresar Sexo');

	if (!$Email)
		ErrorAdd('Debe ingresar Email');

	if (!$IdCountry)
		ErrorAdd('Debe ingresar Pais');

	Connect();

	if (empty($Id)) {
		$sql = "Select Id from users where UserName = '$UserName'";
		$res = mysql_query($sql);

		if ($res && mysql_num_rows($res)>0)
			ErrorAdd('Usuario existente');

		mysql_free_result($res);	
	}

	if (ErrorHas()) {
		Disconnect();
		include('userform.php');
		exit;
	}

	$IdGenre += 0;
	$IdCountry += 0;

	if (empty($Id))
		$sql = "Insert";
	else
		$sql = "Update";

	$sql .= " users set UserName = '$UserName',
			Password = '$Password',
			FirstName = '$FirstName',
			LastName = '$LastName',
			Email = '$Email',
			IdCountry = $IdCountry,
			State = '$State',
			City = '$City',
			ZipCode = '$ZipCode',
			DateBorn = '$DateBorn',
			IdGenre = $IdGenre,
			Reference = '$Reference',
			Comments = '$Comments'
			";

	if (!empty($Id))
		$sql .= " where Id=$Id";

	mysql_query($sql);

	Disconnect();

	$UserLink = SessionGet("UserLink");
	SessionRemove("UserLink");

	PageAbsoluteRedirect($UserLink);
	exit;
?>