<?

class Entity {
	var $Name;
	var $SetName;
	var $Descriptor;
	var $PluralDescriptor;
	var $Genre;
	var $TableName;

	function GenreVocal() {
		if ($this->Genre=='F')
			return 'a';
		return 'o';
	}
}

class Query {
	var $Title;
	var $Fields;
	var $Titles;
	var $OrderBy;
	var $Columns;

	function FieldList() {
		$r = '';

		foreach ($this->Fields as $fld)
			if ($r)
				$r .= ", $fld";
			else
				$r = $fld;

		return $r;
	}

	function TitleList() {
		$r = '';

		foreach ($this->Titles as $title)
			if ($r)
				$r .= ", '$title'";
			else
				$r = "'$title'";

		return $r;
	}

	function GenerateColumns() {
		foreach ($this->Fields as $fld) {
?>
		DatumGenerate($reg["<?= $fld ?>"]);
<?
}
	}

	function WhereClause() {
		return '';
	}

	function OrderClause() {
		if ($this->OrderBy)
			return " order by $this->OrderBy";
		return '';
	}
}

function ExpandAt($line)
{
	return ereg_replace('@{([^}]*)}','<?= $\\1 ?>',$line);
}

function Expand($line)
{
	$line = ExpandAt($line);
	
	return $line;
}

	$Entity = new Entity();
	$Entity->TableName = 'users';
	$Entity->Name = 'user';
	$Entity->SetName = 'users';
	$Entity->Genre = 'M';
	$Entity->Descriptor = 'Usuario';
	$Entity->PluralDescriptor = 'Usuarios';

	$Query = new Query();
	$Query->Title = $Entity->PluralDescriptor;
	$Query->Fields = array('Id', 'UserName', 'FirstName', 'LastName');
	$Query->Titles = array('Id',"Código","Nombre","Apellido");
	$Query->OrderBy = 'UserName';
	
	$fh = fopen($Template,'r');
	$tmpnombre = tempnam('/t','TMP');
	$fh2 = fopen($tmpnombre,'w');
	while ($line=fgets($fh))
		fputs($fh2,Expand($line));
	fclose($fh2);
	fclose($fh);
	ob_start();
	include($tmpnombre);
	$result = ob_get_contents();
	ob_end_clean();
	unlink($tmpnombre);

	$result = str_replace('<%',"<?",str_replace('%>',"?>",$result));

	if ($Destino) {
		$fh = fopen($Destino,'w');
		fputs($fh,$result);
		fclose($fh);
	}
	else {
?>
<xmp>
<?= $result ?>
</xmp>
<?
	}
?>
