<?
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'includes/users.inc.php');
	include_once($PagePrefix.'includes/session.inc.php');
	include_once($PagePrefix.'includes/errors.inc.php');
	include_once($PagePrefix.'includes/validations.inc.php');

	if (empty($IdEntity))
		ErrorAdd('Debe especificar Entidad');

	if (empty($Template))
		ErrorAdd('Debe ingresar Archivo de Plantilla');

	if (ErrorHas()) {
		include('entitygenform.php');
		exit;
	}

	if ($Target)  {
		if ($Project)
			$TargetFile = $Project->FileSystem . $Target;
		else
			$TargetFile = $Target;
	}

	Connect();

	include($PagePrefix . 'genexpand.php');

	Disconnect();

	if ($TargetFile) {
		$EntityLink = SessionGet("EntityLink");
		SessionRemove("EntityLink");

		PageAbsoluteRedirect($EntityLink);
		exit;
	}
?>