<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_workflow2role, da_powersys.p_role 
	where pr_id=wf2r_prid 
	and wf2r_wfid=:wfid 
	order by wf2r_prid asc";
	
	$db->param(":wfid", $_POST["wfid"]);
	$set = $db->getlist($sql);
	
	$db->close();
	
	// $log = new Log();
	// $log->write(json_encode($set));
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>