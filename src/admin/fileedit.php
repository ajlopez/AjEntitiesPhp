<?
	$PageTitle = 'Archivo ' . $file;
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');
?>
<center>
<form action='fileupdate.php' method='post'>
<input type=hidden name='file' value='<?= $file ?>'>
<textarea name='content' rows=40 cols=60>
<?
	$f = fopen($file,'r');

	fpassthru($f);
?>
</textarea>
<br>
<input type="submit" value="Grabar">
</form>
</center>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
