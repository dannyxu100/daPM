<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_powersys");
	
	$sql = "select * from p_role ";
	if(isset($_POST["prid"])){
		$sql .= " where pr_id=:prid ";
		$db->param(":prid", $_POST["prid"] );
	}
	else if(isset($_POST["prpid"])){
		$sql .= " where pr_pid =:prpid ";
		$db->param(":prpid", $_POST["prpid"] );
	}
	$sql .= " order by pr_sort asc, pr_pid asc";
	
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