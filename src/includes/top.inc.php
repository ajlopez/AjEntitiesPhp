<?
	include_once($PagePrefix.'includes/configuration.inc.php');
	include_once($PagePrefix.'includes/pages.inc.php');
?>
<body bgcolor=#ffffff leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>

<table width="100%" class="top" cellspacing=0 cellpadding=0 border=0>

<tr height=60>
<td class="sitetitle" align="left">
<a href="<? echo PageMain(); ?>" target="_top">
<img src="<? echo $PagePrefix; ?>images/<?= SiteLogo ?>" border=0>
</a>
</td>
<td>
</td>
</tr>
</table>

<table width=100% cellspacing=0 cellpadding=0 border=0>

<tr height=24 bgcolor=black>
<td class="topheader" align=right>
<b><? echo SiteDescription ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
</td>
</tr>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td width=150 height=500 valign="top" class="left">
<? include_once($PagePrefix."includes/menuleft.inc.php"); ?>
</td>			

<td valign="top">

<table width=100% cellspacing=10 border=0 cellpadding=0>
<tr>
<td>

<p>
<h1 align="center"><? echo $PageTitle ?></h1>
