<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$sql = "select * from p_user,p_org where pu_oid=po_id and pu_id=".$_POST["pu_id"];
	// $log = new Log();
	// $log->write($sql);
	
	$db = new DB("da_powersys");
	$set = $db->getone($sql);
	
	$db->close();
	
	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
	
	// $log->write($res);
?>