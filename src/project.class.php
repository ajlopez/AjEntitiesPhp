<?
	include_once($PagePrefix.'database.class.php');

class Project {
	var $Id;
	var $Code;
	var $Description;
	var $DataBaseName;
	var $FileSystem;
	var $Comments;

	function &LoadById($Id) {
		$proj = new Project();
		Database::LoadObjectById($proj,'projects',$Id);
		return $proj;
	}
}

?>