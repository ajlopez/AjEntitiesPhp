<?
	$PageTitle = 'Registrarse';
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/header.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');
?>

<center>

<?
	ErrorRender();
?>

<p>

<form action="registerupdate.php" method=post>
<table cellspacing=1 cellpadding=2 class="form">
<?
	FieldTextGenerate("UserName","C�digo de Usuario",$UserName,16);
	FieldPasswordGenerate("Password","Contrase�a",$Password,16);
	FieldPasswordGenerate("Password2","Reingrese Contrase�a",$Password2,16);
	FieldTextGenerate("FirstName","Nombre",$FirstName,40);
	FieldTextGenerate("LastName","Apellido",$LastName,40);
?>
</table>
<input type="submit" value="Aceptar">
</form>

</center>

<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>

