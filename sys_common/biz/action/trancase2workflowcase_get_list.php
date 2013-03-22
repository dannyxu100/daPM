<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$wfcid = $_POST["wfcid"];
	
	$db = new DB("da_workflow");
	
	/**************** 根据可参与事务变迁处理中状态的实例 找出下一步直线库所的 可选择向弧（路由） *****************/
	$sql = "select * from w_transition, w_arc, w_trancase 
	left join da_powersys.p_user on w_trancase.tc_puid = p_user.pu_id 
	where tc_tid=t_id 
	and tc_tid=a_tid 
	and a_direction='IN' 
	and tc_wfcid=:wfcid order by tc_enabledate asc";
	
	// $sql = "select * from w_trancase, w_transition, da_powersys.p_user 
	// where tc_tid=t_id 
	// and tc_puid=pu_id 
	// and tc_wfcid=:wfcid order by tc_enabledate asc";
	
	$param = array();
	array_push($param, array(":wfcid", $wfcid));
	
	$db->paramlist($param);
	$set = $db->getlist($sql);
	
	// $log = new Log();
	// $log->write($sql1);
	// $log->write($sql2);
	// $log->write($db->geterror());
	
	$db->close();

	
	if(is_array($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>