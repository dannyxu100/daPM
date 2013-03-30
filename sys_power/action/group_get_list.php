<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_group ";
	if(isset($_POST["pgid"])){
		$sql .= " where pg_id=:pgid";
		$db->param(":pgid", $_POST["pgid"]);
	}
	else if(isset($_POST["pgpid"])){
		$sql .= " where pg_pid=:pgpid";
		$db->param(":pgpid", $_POST["pgpid"]);
	}
	$sql .= " order by pg_sort asc, pg_pid asc";
	
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