<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$tcid = $_POST["tcid"];		//������id
	
	$db = new DB("da_workflow");
	
	/***************** ��������ʵ��id ���ж��Ƿ��Ѿ����ӵ� *********************************/
	$db->param(":tcid", $tcid);
	$res = $db->getcount("select tc_id from w_trancase 
	where (tc_puid <> 0 and tc_puid is not null) 
	and tc_id=:tcid");
	
	if(0<$res){
		echo "FALSE";
		return;
	}
	
	/***************** �޸Ĵ�����puid(�ӵ�) *********************************/
	$sql = "update w_trancase 
	set tc_puid=:puid, 
	tc_puname=:puname, 
	tc_status=:status 
	where tc_id=:tcid";				//�����Ǩ�������״̬��EN�����ã�IP�������У�CA��ȡ���� FI�����
	
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