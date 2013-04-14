<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_common");
	$sql = "select * from comm_noticetype ";
	
	if(isset($_POST["ntid"])){
		$sql .= " where nt_id=:ntid ";
		$db->param(":ntid", $_POST["ntid"]);
	}
	else if(isset($_POST["ntpid"])){
		$sql .= " where nt_pid=:ntpid ";
		$db->param(":ntpid", $_POST["ntpid"]);
	}
	$sql .= " order by nt_sort asc, nt_pid asc";
	
	$set = $db->getlist($sql);
	// Log::out($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>