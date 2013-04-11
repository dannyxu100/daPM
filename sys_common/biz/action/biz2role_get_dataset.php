<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$roleid = fn_getcookie("roleid");
	$wfid = $_POST["wfid"];
	$tcid = $_POST["tcid"];
	
	$db = new DB("da_workflow");
	
	$sql = "select * from w_workflow2role 
	where wf2r_wfid=:wfid 
	and wf2r_prid in (".$roleid.") 
	order by wf2r_prid asc";
	
	$db->param(":wfid", $wfid);
	$set1 = $db->getlist($sql);
	
	$sql = "select w_trancase.* 
	from w_workflow, w_trancase, w_tran2role 
	where tc_wfid=wf_id 
	and wf_id=:wfid 
	and tc_id=:tcid 
	and tc_tid=t2r_tid 
	and t2r_prid in(".$roleid.") 
	order by wf_sort asc, wf_id asc";		//参与业务流程和 管理业务流程的角色

	$db->param(":wfid", $wfid);
	$db->param(":tcid", $tcid);
	$set2 = $db->getone($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	echo json_encode(array(
			"ds1"=>$set1,
			"ds2"=>$set2
		));
			
	// if(is_array($set1) && is_array($set2)){
		// echo json_encode(array(
				// "ds1"=>$set1,
				// "ds2"=>$set2
			// ));
	// }
	// else{
		// echo "FALSE";
	// }
?>