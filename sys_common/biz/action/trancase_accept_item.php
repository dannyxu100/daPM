<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$tcid = $_POST["tcid"];		//������id
	
	$db = new DB("da_workflow");
	
	/***************** ��������ʵ��id �޸Ĵ�����puid *********************************/
	$sql = "update w_trancase 
	set tc_puid=:puid, 
	tc_status=:status 
	where tc_id=:tcid";				//�����Ǩ�������״̬��EN�����ã�IP�������У�CA��ȡ���� FI�����
	
	$db->param(":puid", fn_getcookie("puid"));
	$db->param(":status", "IP");
	$db->param(":tcid", $tcid);
	
	$res = $db->update($sql);
	Log::out($db->geterror());
	
	$db->close();
	
	echo $res?$res:"FALSE";
?>