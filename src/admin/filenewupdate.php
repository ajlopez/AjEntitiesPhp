<?
	$PagePrefix = '../';
	include('../includes/pages.inc.php');
	if ($dir)
		$file = $dir . '/' . $file;
	$f = fopen($file,'w');
	fwrite($f, stripSlashes($content));
	PageRedirect('admin/files.php');
?>