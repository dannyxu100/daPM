<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$bcid = $_POST["bcid"];
	
	$db = new DB("da_bizform");
	$sql = "select * from b_bizreply, da_powersys.p_user 
	where r_puid=pu_id 
	and r_bcid=:bcid 
	order by r_date desc, r_id desc ";
	$db->param(":bcid", $bcid);
	
	$set = $db->getlist($sql);
	// $log = new Log();
	// $log->write($db->geterror());
	
	$db->close();

	if(is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>