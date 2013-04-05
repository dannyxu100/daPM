<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$cid = $_POST["cid"];
	$puid = fn_getcookie("puid");
	
	$db = new DB("da_crm");
	
	$db->param(":cid", $cid);
	$num = $db->getcount("select c2u_id from crm_cst2user where c2u_cid=:cid");
	if( 0 < $num){			//先判断是否已经被其他人员抓取走了。
		echo "FALSE";
		$db->close();
		return;
	}
	
	$db->param(":puid", $puid);
	$sql = "insert into crm_cst2user(c2u_cid, c2u_puid) values(:cid, :puid)";
	// Log::out($sql);

	$res = $db->insert($sql);
	$db->close();
	
	echo $res?$res:"FALSE";
?>