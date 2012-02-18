<?
	$PagePrefix = '../';
	$PageTitle = 'Usuario';

	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/translations.inc.php');

	Connect();
	
	SessionPut('UserLink',PageActual());

	if (!isset($Id))
		PageExit();

	$sql = "select UserName, Password, FirstName, LastName, Email, Reference, Comments, IdGenre, IdCountry, State, City, ZipCode, DateBorn, IsAdministrator, IsTeacher, LoginCount, Verified, DateTimeInsert, DateTimeUpdate, DateTimeLastLogin from users where Id = $Id";
	$rs = mysql_query($sql);
	list($UserName, $Password, $FirstName, $LastName, $Email, $Reference, $Comments, $IdGenre, $IdCountry, $State, $City, $ZipCode, $DateBorn, $IsAdministrator, $IsTeacher, $LoginCount, $Verified, $DateTimeInsert, $DateTimeUpdate, $DateTimeLastLogin) = mysql_fetch_row($rs);
	mysql_free_result($rs);

	$PageTitle = "Usuario: $UserName";

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="users.php">Usuarios</a>
&nbsp;
&nbsp;
<a href="userform.php?Id=<? echo $Id; ?>">Actualiza</a>
&nbsp;
&nbsp;
<a href="userdelete.php?Id=<? echo $Id; ?>">Elimina</a>
</p>
<p>

<table cellspacing=1 cellpadding=2 class="form" width='90%'>
<?
	FieldStaticGenerate("Id",$Id);
	FieldStaticGenerate("C&oacute;digo", $UserName);
	FieldStaticGenerate("Nombre", $FirstName);
	FieldStaticGenerate("Apellido", $LastName);
	FieldStaticGenerate("Email", $Email);
	FieldStaticGenerate("Pais", TranslateDescription('countries',$IdCountry));
	FieldStaticGenerate("Estado/Provincia", $State);
	FieldStaticGenerate("Ciudad", $City);
	FieldStaticGenerate("Código Postal", $ZipCode);
	FieldStaticGenerate("Nos Conoce", $Reference);
	FieldStaticGenerate("Comentarios", $Comments);
	FieldStaticGenerate("Fecha de Nacimiento", $DateBorn);
	FieldStaticGenerate("Sexo",TextGenre($IdGenre));
	FieldStaticGenerate("Es Administrador?", TextYesNo($IsAdministrator));
	FieldStaticGenerate("Es Instructor?", TextYesNo($IsTeacher));
	FieldStaticGenerate("Cantidad de Ingresos",$LoginCount);
	FieldStaticGenerate("Verificado",TextYesNo($Verified));
	FieldStaticGenerate("Fecha/Hora Alta",$DateTimeInsert);
	FieldStaticGenerate("Fecha/Hora Modificación",$DateTimeUpdate);
	FieldStaticGenerate("Fecha/Hora Ultimo Ingreso",$DateTimeLastLogin);
?>
</table>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>

