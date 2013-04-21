<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$sql = "select distinct(wf_id), w_workflow.* 
	from w_workflow, w_transition, w_tran2role 
	where t_wfid=wf_id 
	and t_id=t2r_tid 
	and wf_isrun=1 
	and (
		t2r_prid in(".$_POST["roleids"].") 
		or exists(select wf2r_id from w_workflow2role where wf2r_wfid=wf_id and wf2r_prid in(".$_POST["roleids"]."))
		) 
	order by wf_sort asc, wf_id asc";		//参与业务流程和 管理业务流程的角色

	$db = new DB("da_workflow");
	$set = $db->getlist($sql);
	// Log::out($sql);
	
	$db->close();
	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>