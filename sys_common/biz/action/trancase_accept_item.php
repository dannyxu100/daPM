<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$tcid = $_POST["tcid"];		//工作流id
	
	$db = new DB("da_workflow");
	
	/***************** 根据事务实力id 修改处理人puid *********************************/
	$sql = "update w_trancase 
	set tc_puid=:puid, 
	tc_status=:status 
	where tc_id=:tcid";				//事务变迁（工作项）状态；EN：启用；IP：处理中；CA：取消； FI：完成
	
	$db->param(":puid", fn_getcookie("puid"));
	$db->param(":status", "IP");
	$db->param(":tcid", $tcid);
	
	$res = $db->update($sql);
	Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>