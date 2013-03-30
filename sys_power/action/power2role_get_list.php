<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from p_power2role ";
	if(isset($_POST["prid"])){
		$sql .= " where p2r_prid = '".$_POST["prid"]."' ";
	}
	else if(isset($_POST["ppid"])){
		$sql .= " where p2r_ppid = '".$_POST["ppid"]."' ";
	}
	$sql .= " order by p2r_ppid asc, p2r_id asc";
	
	$db = new DB("da_powersys");
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