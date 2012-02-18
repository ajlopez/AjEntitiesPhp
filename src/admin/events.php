<?
	$PagePrefix = '../';
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');
	include_once($PagePrefix.'includes/utilities.inc.php');
	include_once($PagePrefix.'includes/forms.inc.php');

	$PageTitle = "Eventos";

	UserIsAdministrator();

	Connect();

	$sql = "select * from events";

	if ($Type) {
		$where = WhereAdd($where,"Type = '$Type'");
		$Parameters .= "&Type=$Type";
	}
	if ($IdUser)	{
		$where = WhereAdd($where,"IdUser = '$IdUser'");
		$Parameters .= "&IdUser=$IdUser";
	}
	if ($Ip)	{
		$where = WhereAdd($where,"Ip = '$Ip'");
		$Parameters .= "&Ip=$Ip";
	}
	if ($IdParameter)	{
		$where = WhereAdd($where,"IdParameter = $IdParameter");
		$Parameters .= "&IdParameter=$IdParameter";
	}
	if ($Parameter)	{
		$where = WhereAdd($where,"Parameter = '$Parameter'");
		$Parameters .= "&Parameter=$Parameter";
	}
	if ($SubParameter)	{
		$where = WhereAdd($where,"SubParameter = '$SubParameter'");
		$Parameters .= "&SubParameter=$SubParameter";
	}

	$From += 0;
	$Quantity = 50;

	$sqlcuenta = "Select count(*) from events";

	if ($where) {
		$sql .= " where $where";
		$sqlcuenta .= " where $where";
	}

	if ($Orden) {
		$sql .= " order by $Orden";
		$Parameters .= "&Orden=" . urlencode($Orden);
	}
	else
		$sql .= " order by Id desc";

	$sql .= " limit $From, $Quantity";

	$rs = mysql_query($sql);

	$rsCuenta = mysql_query($sqlcuenta);
	list($TotalQuantity) = mysql_fetch_row($rsCuenta);
	mysql_free_result($rsCuenta);

	$titulos = array("Id", "Usuario", "Fecha/Hora", "Tipo", "Par&aacute;metro", "Subpar&aacute;metro", "IdPar&aacute;metro", "IP");

	$Primero = 0;
	$Last = $TotalQuantity - $Quantity;
	$Previous = $Desde-$Quantity;
	$Next = $Desde+$Quantity;

	if ($Previous<0)
		$Previous = 0;
	if ($Next+$Quantity>$TotalQuantity)
		$Next = $TotalQuantity - $Quantity;
	if ($Next<0)
		$Next = 0;
	if ($Last<0)
		$Last = 0;

	include_once($PagePrefix.'includes/header.inc.php');
?>

<center>

<p>
<a href="events.php?From=0<? echo $Parameters; ?>">Inicio</a>
&nbsp;&nbsp;
<a href="events.php?From=<? echo $Previous; ?><? echo $Parameters; ?>">Anterior</a>
&nbsp;&nbsp;
<a href="events.php?From=<? echo $Next; ?><? echo $Parameters; ?>">Siguiente</a>
&nbsp;&nbsp;
<a href="events.php?From=<? echo $Last; ?><? echo $Parameters; ?>">Final</a>
&nbsp;&nbsp;
<br>
<a href="events.php">Todos</a>
&nbsp;&nbsp;
<a href="events.php?Type=PG">P&aacute;ginas</a>
&nbsp;&nbsp;
<a href="events.php?Type=LG">Ingresos</a>
&nbsp;&nbsp;
<a href="events.php?Type=RG">Registraciones</a>
&nbsp;&nbsp;
<a href="events.php?Type=RM">Emails</a>
&nbsp;&nbsp;
<a href="events.php?Type=RR">Referentes</a>
&nbsp;&nbsp;
<a href="events.php?Type=RA">Afiliados</a>
&nbsp;&nbsp;
<p>

<?		
function RegisterShow($reg) {
	RowOpen();
	DatumLinkGenerate($reg["Id"], "event.php?Id=".$reg["Id"]);
	if ($reg["IdUser"])
		DatumLinkGenerate(UserTranslate($reg["IdUser"]), "user.php?Id=".$reg["IdUsuario"]);
	else
		DatumGenerate(UserTranslate($reg["IdUser"]));
	DatumGenerate($reg["DateTime"]);
	DatumGenerate($reg["Type"]);
	if ($reg["Type"]=='PG') {
		$Pagina = $reg["Parameter"];
		if ($reg["SubParameter"])
			$Pagina .= "?" . $reg["SubParameter"];
		DatumLinkGenerate($reg["Parameter"],$Pagina);
	}
	else
		DatumGenerate($reg["Parameter"]);
	DatumGenerate($reg["SubParameter"]);
	DatumGenerate($reg["IdParameter"]);
	DatumLinkGenerate($reg["Ip"], "events.php?Ip=".$reg["Ip"]);
	RowClose();
}
	
	TableOpen($titulos,"98%");

	while ($reg=mysql_fetch_array($rs)) 
		RegisterShow($reg);
				
	TableClose();
	
?>

</center>

<?
	Disconnect();
	include_once($PagePrefix.'includes/footer.inc.php');
?>
