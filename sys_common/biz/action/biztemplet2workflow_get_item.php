<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/log.php";
	
	$sql = "select b_biztemplet.* from b_biztemplet, da_workflow.w_workflow 
	where bt_id=wf_btid 
	and wf_id=".$_POST["wfid"];

	$db = new DB("da_bizform");
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();
	
	if( is_array($set) && 0<count($set) ){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>