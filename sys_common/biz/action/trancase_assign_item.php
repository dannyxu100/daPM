<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$tcid = $_POST["tcid"];				//�����Ǩʵ��id
	$newpuid = $_POST["newpuid"];
	$newpuname = $_POST["newpuname"];
	$status = $_POST["status"];
	
	$db = new DB("da_workflow");
	
	/***************** �޸Ĵ�����puid(�ӵ�) *********************************/
	$sql = "update w_trancase 
	set tc_puid=:newpuid, 
	tc_puname=:newpuname, 
	tc_status=:status 
	where tc_id=:tcid";
	
	$db->param(":newpuid", $newpuid);
	$db->param(":newpuname", $newpuname);
	$db->param(":status", $status);
	$db->param(":tcid", $tcid);
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out(fn_getcookie("puid"));
	// Log::out("IP");
	// Log::out($tcid);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>