<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$sql = "update b_biztemplet set ";
	$sql .= " bt_dbsource='".$_POST["dbsource"]."' ";
	$sql .= " ,bt_dbfld='".$_POST["dbfld"]."' ";
	$sql .= " where bt_id='".$_POST["bt_id"]."' ";
	
	$db = new DB("da_bizform");
	$res = $db->update($sql);
	// $log = new Log();
	// $log->write($db->geterror());

	$db->close();
	
	echo $res?$res:"FALSE";
?>