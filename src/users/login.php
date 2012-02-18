<?
	$PageTitle = "Ingreso de Usuario";
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/header.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
?>

<center>

<p>
Por favor, ingrese su c&oacute;digo de usuario y su contrase&ntilde;a.
</p>

<p>

<form action="loginvalidate.php" method=post>

<table cellspacing=1 cellpadding=2 class="form">
<?
	FieldTextGenerate("UserName","Código de Usuario",$Codigo,16);
	FieldPasswordGenerate("Password","Contraseña",$Contrasenia,16);
?>
</table>
<input type="submit" value="Aceptar">
</form>

</p>

<p>
Si no es usuario, puede <a href="register.php">registrarse</a> gratuitamente en l&iacute;nea.
</p>

</center>

<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>

