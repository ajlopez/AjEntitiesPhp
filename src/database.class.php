<?

class Database {
	function LoadObjectById(&$obj,$table,$id,$name='Id') {
		$rs = mysql_query("select * from $table where $name = $id");
		$reg = mysql_fetch_assoc($rs);
		mysql_free_result($rs);
		foreach ($reg as $nombre => $valor)
			$obj->$nombre = $valor;
	}
}

?>