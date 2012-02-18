<?
	copy($file,$dir . '/' . $_FILES['file']['name']);
	$PagePrefix = '../';
	include('../includes/pages.inc.php');
	PageRedirect('admin/files.php');
?>