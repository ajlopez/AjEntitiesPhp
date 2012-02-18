<?
	$PagePrefix = '../';
	$PageTitle = 'Actualiza Usuario';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	Connect();
	
	if (!ErrorHas() && isset($Id)) {
		$sql = "select UserName, Password, FirstName, LastName, Email, Reference, Comments, IdGenre, IdCountry, State, City, ZipCode, DateBorn, IsAdministrator, IsTeacher, LoginCount, Verified, DateTimeInsert, DateTimeUpdate, DateTimeLastLogin from users where Id = $Id";
		$rs = mysql_query($sql);
		list($UserName, $Password, $FirstName, $LastName, $Email, $Reference, $Comments, $IdGenre, $IdCountry, $State, $City, $ZipCode, $DateBorn, $IsAdministrator, $IsTeacher, $LoginCount, $Verified, $DateTimeInsert, $DateTimeUpdate, $DateTimeLastLogin) = mysql_fetch_row($rs);
		mysql_free_result($rs);
		$Password2 = $Password;
		$PageTitle = "Actualiza Usuario $UserName";
		$IsNew = 0;
	}	
	else if (isset($Id))
		$IsNew = 0;
	else {
		$PageTitle = "Nuevo Usuario";
		$IsNew = 1;
	}

	$rsCountries = TranslateQuery('countries');

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="users.php">Usuarios</a>
&nbsp;
&nbsp;
<?
	if (!$IsNew) {
?>
<a href="user.php?Id=<? echo $Id; ?>">Usuario</a>
&nbsp;
&nbsp;
<a href="userdelete.php?Id=<? echo $Id; ?>">Elimina</a>
&nbsp;
&nbsp;
<?
	}
?>
</p>


<?
	ErrorRender();
?>

<p>

<form action="userupdate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form" width='98%'>
<?
	if (!$IsNew)
		FieldStaticGenerate("Id",$Id);

	FieldTextGenerate("UserName","Código de Usuario",$UserName,16,true);
	FieldTextGenerate("Password","Contraseña",$Password,16,true);
	FieldTextGenerate("Password2","Contraseña",$Password2,16,true);
	FieldTextGenerate("FirstName","Nombre",$FirstName,40);
	FieldTextGenerate("LastName","Apellido",$LastName,40);
	FieldTextGenerate("Email","Email",$Email,50,true);
	FieldComboRsGenerate("IdCountry", "Pais", $rsCountries, $IdCountry, 'Id', 'Description',true,true);
	FieldTextGenerate("State","Provincia/Estado",$State,30);
	FieldTextGenerate("City","Ciudad",$City,40);
	FieldTextGenerate("ZipCode","Código Postal",$ZipCode,10);
	FieldDateGenerate("DateBorn","Fecha de Nacimiento",$DateBorn);
	FieldGenreGenerate("IdGenre","Sexo", $IdSexo, true);
		$ArregloNosConoce = array('' => '', 'MA' => 'Por un correo electr&oacute;nico',
			'RE' => 'Recomendaci&oacute;n de un amigo',
			'PU' => 'Publicidad en Internet',
			'NO' => 'Nota de Prensa en Medios',
			'EN' => 'Enlace en Otro Sitio',
			'OT' => 'Otros');
	FieldComboHashGenerate("Reference","¿C&oacute;mo conoci&oacute; ajlopez.com y sus cursos?", $ArregloNosConoce, $Reference);
	FieldMemoGenerate("Comments","Comentarios<br>por favor, ingrese lo que espera del sitio,<br>sugerencias, cr&iacute;ticas, todo nos ayuda<br>a mejorar el servicio", $Comentarios);

	FieldOkGenerate();
?>
</table>

<?
	if (!$IsNew)
		FieldIdGenerate($Id);
?>

</form>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

