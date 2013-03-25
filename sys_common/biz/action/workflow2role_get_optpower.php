<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$roleid = fn_getcookie("roleid");
	$wfid = $_POST["wfid"];
	
	$db = new DB("da_workflow");
	$sql = "select * from w_workflow2role 
	where wf2r_wfid=:wfid 
	and wf2r_prid in (".$roleid.") 
	order by wf2r_prid asc";
	
	$db->param(":wfid", $wfid);
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>