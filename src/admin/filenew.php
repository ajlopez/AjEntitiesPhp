<?
	$PageTitle = 'Nuevo Archivo';
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');
?>
<center>
<form action='fileupdate.php' method='post'>
<input type=hidden name='dir' value='<?= $dir ?>'>
Archivo <input type=text name='file' value='<?= $file ?>'>
<br>
<textarea name='content' rows=40 cols=60>
</textarea>
<br>
<input type="submit" value="Grabar">
</form>
</center>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
