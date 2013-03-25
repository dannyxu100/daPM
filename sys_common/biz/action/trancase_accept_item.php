<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$tcid = $_POST["tcid"];		//工作流id
	
	$db = new DB("da_workflow");
	
	/***************** 根据事务实力id 先判断是否已经被接单 *********************************/
	$db->param(":tcid", $tcid);
	$res = $db->getcount("select tc_id from w_trancase 
	where (tc_puid <> 0 and tc_puid is not null) 
	and tc_id=:tcid");
	
	if(0<$res){
		echo "FALSE";
		return;
	}
	
	/***************** 修改处理人puid(接单) *********************************/
	$sql = "update w_trancase 
	set tc_puid=:puid, 
	tc_puname=:puname, 
	tc_status=:status 
	where tc_id=:tcid";				//事务变迁（工作项）状态；EN：启用；IP：处理中；CA：取消； FI：完成
	
	$db->param(":puid", fn_getcookie("puid"));
	$db->param(":puname", fn_getcookie("puname"));
	$db->param(":status", "IP");
	
	$res = $db->update($sql);
	// Log::out($sql);
	// Log::out(fn_getcookie("puid"));
	// Log::out("IP");
	// Log::out($tcid);
	// Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>