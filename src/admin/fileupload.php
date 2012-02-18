<?
	$PageTitle = 'Nuevo Archivo';
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');
?>
<center>
<form enctype="multipart/form-data" action='fileuploadupdate.php' method='post'>
<input type=hidden name='dir' value='<?= $dir ?>'>
Archivo <input type=file name='file' value='<?= $file ?>'>
<br>
<input type="submit" value="Subir">
</form>
</center>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
