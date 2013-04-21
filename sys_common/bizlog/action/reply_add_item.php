<?php
	//验证登陆信息
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	date_default_timezone_set('ETC/GMT-8');
	
	$bcid=$_POST['bcid'];
	$lid=$_POST['lid'];
	$content=urldecode($_POST['content']);
	$puid=fn_getcookie('puid');
	$puname=fn_getcookie('puname');
	$nowdate = date("Y-m-d H:i:s");
	//$pwd=md5($pwd);
	
	$db = new DB("da_bizform");
	
	$db->tran();
	$sql1 = "insert into b_bizreply(r_bcid, r_lid, r_content, r_date, r_puid, r_puname) 
	values(:bcid, :lid, :content, :date, :puid, :puname)";
	
	$param1 = array();
	array_push($param1, array(":bcid", $bcid));
	array_push($param1, array(":lid", $lid));
	array_push($param1, array(":content", $content));
	array_push($param1, array(":date", $nowdate));
	array_push($param1, array(":puid", $puid));
	array_push($param1, array(":puname", $puname));
	$db->paramlist($param1);
	$res = $db->insert($sql1);
	
	$sql2 = "update b_bizcase set bc_lastlog=:content where bc_id=:bcid ";
	
	$param2 = array();
	array_push($param2, array(":bcid", $bcid));
	array_push($param2, array(":content", $content));
	$db->paramlist($param2);
	$res = $db->update($sql2);
	
	/************* 为发送邮件提醒做准备 *****************/
	$sql_email = "select pu_email 
	from da_powersys.p_user, da_workflow.w_trancase, da_bizform.b_bizcase
	where pu_id=tc_puid 
	and tc_wfcid=bc_wfcid 
	and bc_id=:bcid";
	$param_email = array();
	array_push($param_email, array(":bcid", $bcid));
	
	$db->paramlist($param_email);
	$set_email = $db->getlist($sql_email);
	
	$emails = array();
	for( $i=0; $i<count($set_email); $i++){
		array_push( $emails, $set_email[$i]["pu_email"] );
	}
	$emails = implode(',', $emails);
	// $log = new Log();
	// $log->write($db->geterror());
	
	if($db->geterror()){
		$db->back();
		$db->close();
		echo 'FALSE';
	}
	else{
		$db->commit();
		$db->close();
		echo $emails;
	}

?>