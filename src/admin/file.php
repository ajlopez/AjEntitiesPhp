<?
	$PageTitle = 'Archivo ' . $file;
	$PagePrefix = '../';

	include_once($PagePrefix.'includes/users.inc.php');

	AdministratorControl();

	include_once($PagePrefix.'includes/header.inc.php');
?>
<xmp>
<?
	$f = fopen($file,'r');

	fpassthru($f);
?>
</xmp>
<?
	include_once($PagePrefix.'includes/footer.inc.php');
?>
