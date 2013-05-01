<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$roleid = fn_getcookie("roleid");
	$wfid = $_POST["wfid"];
	
	$db = new DB("da_workflow");
	$sql = "select * from w_workflow2role 
	where wf2r_wfid=:wfid 
	and wf2r_prid in (".$roleid.") 
	order by wf2r_prid asc";
	
	$db->param(":wfid", $wfid);
	$set = $db->getlist($sql);
	
	
	$sql2 = "select t_id from w_tran2role, w_transition 
	where t2r_prid in (".$roleid.") 
	and t2r_tid=t_id 
	and t_wfid=:wfid";
	
	$db->param(":wfid", $wfid);
	$set2 = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"opt"=>$set,
		"tran"=>$set2							//记录集
	);
	
	echo json_encode($res);
?>