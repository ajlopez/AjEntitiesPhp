<?
include_once($PagePrefix.'includes/connection.inc.php');

function TranslateDescription($table,$id,$description='Description')
{
	Connect();

 	$rsData = mysql_query("Select $description from $table where Id = $id");

	if ($rsData && mysql_num_rows($rsData))
		list($IdDescription) = mysql_fetch_row($rsData);
	else
		$IdDescription = "$table $id";

	mysql_free_result($rsData);

	Disconnect();

	return $IdDescription;
}

function TranslateQuery($table,$description='Description')
{
	Connect();
	$rs = mysql_query("select Id, $description from $table order by 2");
	Disconnect();
	return $rs;
}

?>