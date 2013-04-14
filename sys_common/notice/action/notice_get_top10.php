<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_common");
	$sql = "select comm_notice.*, nt_name, pu_name  
	from comm_notice, comm_noticetype, da_powersys.p_user 
	where n_puid=pu_id 
	and n_ntid=nt_id 
	and n_status='OPEN' 
	and nt_code=:ntcode 
	limit 0,10";
	
	$db->param(":ntcode", $_POST["ntcode"]);
	$set = $db->getlist($sql);

	if( is_array($set) && 0<count($set)){
		echo json_encode($set);
	}
	else{
		echo "FALSE";
	}
?>