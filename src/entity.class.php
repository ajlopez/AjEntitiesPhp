<?
	include_once($PagePrefix.'database.class.php');
	include_once($PagePrefix.'project.class.php');

class Entity {
	var $Id;
	var $Code;
	var $IdProject;
	var $Description;
	var $Name;
	var $SetName;
	var $TableName;
	var $Descriptor;
	var $PluralDescriptor;
	var $Genre;
	var $Comments;
	var $DateTimeInsert;
	var $DateTimeUpdate;

	var $Fields;
	var $Project;

	function &LoadById($Id) {
		$ent = new Entity();
		Database::LoadObjectById($ent,'entities',$Id);
		return $ent;
	}

	function &GetFields() {
		if (!$this->Fields) {
			$this->Fields = array();
			$rs = mysql_query("select * from entity_fields where IdEntity = $this->Id order by OrderNo, Id");
			
			while ($fld = mysql_fetch_object($rs))
				$this->Fields[] = $fld;

			mysql_free_result($rs);
		}

		return $this->Fields;
	}

	function GetFieldNames() {
		$flds = $this->GetFields();
		$names = array();

		foreach ($flds as $fld)
			$names[] = $fld->Name;

		return $names;
	}

	function GetFieldList() {
		$names = $this->GetFieldNames();

		return join(',',$names);
	}

	function GetIdField() {
		$flds = $this->GetFields();

		return $flds[0];
	}

	function GetDescriptorField() {
		$flds = $this->GetFields();

		return $flds[1];
	}

	function GetProject() {
		if (!$this->Project) {
			$this->Project = Project::LoadById($this->IdProject);
		}

		return $this->Project;
	}

	function GetGenre() {
		if ($this->Genre=='F' || $this->Genre=='f')
			return 'a';
		return 'o';
	}
}

?>