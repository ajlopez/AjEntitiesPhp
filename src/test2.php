<?
	include_once($PagePrefix.'includes/connection.inc.php');
	include_once($PagePrefix.'project.class.php');
	include_once($PagePrefix.'entity.class.php');

	Connect();

	$ent = Entity::LoadById(1);
	echo "<h1>$ent->Code</h1>";

	$vars = get_object_vars($ent);

	foreach ($vars as $nombre => $value)
		echo "<h2>$nombre = $value</h2>";

	$flds = $ent->GetFields();

	foreach ($flds as $fld)
		echo "<h2>$fld->Name</h2>";

	echo "<h2>" . $ent->GetFieldList() . "</h2>";

	$fld = $ent->GetIdField();
	echo "<h2>" . $fld->Name . "</h2>";
	$fld = $ent->GetDescriptorField();
	echo "<h2>" . $fld->Name . "</h2>";

	$proj = Project::LoadById(1);

	print_r($proj);
	print_r($ent);

	$proj2 = $ent->GetProject();
	print_r($proj2);

	Disconnect();
?>