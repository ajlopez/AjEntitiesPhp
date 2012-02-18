<?
	include_once($PagePrefix . 'includes/connection.inc.php');
	include_once($PagePrefix . 'includes/pages.inc.php');

function FieldDelete($IdField,$IdEntity,$OrderNo)
{
	mysql_query("delete from entity_fields where Id=$IdField");
	mysql_query("update entity_fields set OrderNo = OrderNo - 1 where IdEntity=$IdEntity and OrderNo>$OrderNo");
}

function FieldUp($IdField,$IdEntity,$OrderNo)
{
	mysql_query("update entity_fields set OrderNo = OrderNo - 1 where Id=$IdField");
	mysql_query("update entity_fields set OrderNo = OrderNo + 1 where IdEntity=$IdEntity and Id <> $IdField and OrderNo=$OrderNo-1");
}

function FieldDown($IdField,$IdEntity,$OrderNo)
{
	mysql_query("update entity_fields set OrderNo = OrderNo + 1 where Id=$IdField");
	mysql_query("update entity_fields set OrderNo = OrderNo - 1 where IdEntity=$IdEntity and Id <> $IdField and OrderNo=$OrderNo+1");
}

	if (!isset($IdEntity)) {
		echo 'entities.php';
		PageRedirect('entities.php');
		exit;
	}

	if (!isset($OrderNo) || !isset($IdField) || !isset($Action)) {
		echo "entity.php?Id=$IdEntity";
		PageRedirect("entity.php?Id=$IdEntity");
		exit;
	}

	Connect();

	switch ($Action) {
		case 'delete':
			FieldDelete($IdField,$IdEntity,$OrderNo);
			break;
		case 'up':
			FieldUp($IdField,$IdEntity,$OrderNo);
			break;
		case 'down';
			FieldDown($IdField,$IdEntity,$OrderNo);
			break;
	}

	PageRedirect("entity.php?Id=$IdEntity");
	Disconnect();
?>