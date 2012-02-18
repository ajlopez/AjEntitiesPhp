<?
	$PagePrefix = '../';
	include('../includes/pages.inc.php');
	$f = fopen($file,'w');
	fwrite($f, stripSlashes($content));
	PageRedirect('admin/files.php');
?>