<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_org ";
	if(isset($_POST["poid"])){
		$sql .= " where po_id=:poid ";
		$db->param(":poid", $_POST["poid"]);
	}
	else if(isset($_POST["popid"])){
		$sql .= " where po_pid=:popid ";
		$db->param(":popid", $_POST["popid"]);
	}
	$sql .= " order by po_sort asc, po_pid asc";
	
	$set = $db->getlist($sql);
	
	$db->close();
	
	// $log = new Log();
	// $log->write($sql.time());
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>