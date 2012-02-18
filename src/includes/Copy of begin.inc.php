<?
	include_once($PagePrefix.'includes/configuration.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/cache.inc.php');
?>
<html>
<head>

<title><? echo SiteName; ?> - <? echo $PageTitle; ?></title>

<META name="title" content="<? echo $PageTitle ?>">
<META name="description" content="<? echo $SiteDescription ?>">
<META name="keywords" content="ajlopez, Angel Java Lopez, visual basic, .net, xml, programacion, windows, linux, php, asp, jsp, webmasters, internet, cursos">
<META name="language" content="es">
<META name="revisit-after" content="3 days">
<META name="rating" content="General">
<META name="author" content="Angel J Lopez">
<META name="owner" content="Angel J Lopez">
<META name="robot" content="index, follow">

<link rel="stylesheet" href="<? echo $PagePrefix; ?>styles/style.css">
<?
	if ($ArchivoJs)
		echo "<script language='javascript' src='js/$ArchivoJs'></script>\n";
?>
</head>

