<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."//action/sys/log.php";

	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	$dbfldid = $_POST["dbfldid"];
	
	$db = new DB("da_userform");
	$sql = "select * from ".$dbsource." where ".$dbfld."=:dbfldid";
	$db->param( ":dbfldid", $dbfldid );
	// $sql .= " order by bt_sort asc, bt_id asc ";
	
	
	$set = $db->getone($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	// $log->write($set);
	if( is_array($set) && 0<count($set) ){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>