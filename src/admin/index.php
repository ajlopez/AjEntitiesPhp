<?
	$PageTitle = 'Administraci&oacute;n';
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');
?>
<p align='center'>
<a href='users.php'>Usuarios</a>
<br>
<a href='courses.php'>Cursos</a>
<br>
<a href='coursecategories.php'>Categorías de Cursos</a>
<br>
<a href='countries.php'>Paises</a>
<br>
<a href='events.php'>Eventos</a>
<br>
<a href='files.php'>Archivos</a>
</p>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
