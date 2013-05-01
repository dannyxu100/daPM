<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$roleid = fn_getcookie("roleid");
	$wfid = $_POST["wfid"];
	$tcid = $_POST["tcid"];
	$tid = $_POST["tid"];
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_workflow2role 
	where wf2r_wfid=:wfid 
	and wf2r_prid in (".$roleid.") 
	order by wf2r_prid asc";				//工作流总参与权限
	
	$param1 = array();
	array_push($param1, array(":wfid", $wfid));
	
	$db->paramlist($param1);
	$set1 = $db->getlist($sql);
	
	$sql = "select w_trancase.* 
	from w_workflow, w_trancase, w_tran2role 
	where tc_wfid=wf_id 
	and wf_id=:wfid 
	and tc_id=:tcid 
	and tc_tid=t2r_tid 
	and t2r_prid in(".$roleid.") 
	order by wf_sort asc, wf_id asc";		//参与事务变迁的角色

	$param2 = array();
	array_push($param2, array(":wfid", $wfid));
	array_push($param2, array(":tcid", $tcid));
	
	$db->paramlist($param2);
	$set2 = $db->getone($sql);
	
	$sql = "select * from w_tran2limitedit 
	where tle_tid=:tle_tid";				//字段编辑权限
	
	$param3 = array();
	array_push($param3, array(":tle_tid", $tid));
	
	$db->paramlist($param3);
	$set3 = $db->getlist($sql);
	
	$db->close();
	
	echo json_encode(array(
			"opt"=>$set1,
			"tran"=>$set2,
			"fld"=>$set3
		));
	
?>