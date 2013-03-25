<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$tcid = $_POST["tcid"];				//事务变迁实例id
	$newpuid = $_POST["newpuid"];			//新
	$newpuname = $_POST["newpuname"];		//新
	
	$db = new DB("da_workflow");
	
	/***************** 修改处理人puid(接单) *********************************/
	$sql = "update w_trancase 
	set tc_puid=:newpuid, 
	tc_puname=:newpuname 
	where tc_id=:tcid";
	
	$db->param(":newpuid", $newpuid);
	$db->param(":newpuname", $newpuname);
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