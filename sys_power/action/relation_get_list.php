<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_relation ";
	if(isset($_POST["poid"])){
		$sql .= " where pr_poid=:poid";
		$db->param(":poid", $_POST["poid"]);
	}
	else if(isset($_POST["leaderid"])){
		$sql .= " where pr_leaderid=:leaderid";
		$db->param(":leaderid", $_POST["leaderid"]);
	}
	$sql .= " order by pr_leaderid asc, pr_puid asc";
	
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