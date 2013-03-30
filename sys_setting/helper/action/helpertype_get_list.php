<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_setting");
	$sql = "select * from s_helpertype ";
	
	if(isset($_POST["htid"])){
		$sql .= " where ht_id=:htid ";
		$db->param(":htid", $_POST["htid"]);
	}
	else if(isset($_POST["htpid"])){
		$sql .= " where ht_pid=:htpid ";
		$db->param(":htpid", $_POST["htpid"]);
	}
	$sql .= " order by ht_sort asc, ht_pid asc";
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>