<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	date_default_timezone_set('ETC/GMT-8');
	
	$puid = fn_getcookie("puid");
	$subhead = isset($_POST["n_subhead"])?$_POST["n_subhead"]:"";
	$abstract = isset($_POST["n_abstract"])?$_POST["n_abstract"]:"";
	$content = isset($_POST["n_content"])?urldecode($_POST["n_content"]):"";
	
	$db = new DB("da_common");
	$db->param(":n_ntid", $_POST["ntid"]);
	$db->param(":n_title", $_POST["n_title"]);
	$db->param(":n_sort", $_POST["n_sort"]);
	$db->param(":n_subhead", $subhead);
	$db->param(":n_abstract", $abstract);
	$db->param(":n_content", $content);
	$db->param(":n_status", "OPEN");
	$db->param(":n_puid", $puid);
	$db->param(":n_date", date("Y-m-d H:i:s"));
	
	$res = $db->insert("insert into comm_notice(n_ntid, n_title, n_sort, n_subhead, 
	n_abstract, n_content, n_status, n_puid, n_date) 
	values(:n_ntid, :n_title, :n_sort, :n_subhead, 
	:n_abstract, :n_content, :n_status, :n_puid, :n_date)");
	
	
	/************* 为发送邮件提醒做准备 *****************/
	$sql_email = "select pu_email from da_powersys.p_user";
	$set_email = $db->getlist($sql_email);

	$emails = array();
	for( $i=0; $i<count($set_email); $i++){
		array_push( $emails, $set_email[$i]["pu_email"] );
	}
	$emails = implode(',', $emails);
	
	$db->close();
	// Log::out($db->geterror());

	echo $res?$emails:"FALSE";
?>