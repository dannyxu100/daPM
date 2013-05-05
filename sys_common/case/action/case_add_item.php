<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	
	$title = $_POST["c_title"];
	$type = $_POST["c_type"];
	$sort = $_POST["c_sort"];
	$img = $_POST["c_img"];
	$abstract = isset($_POST["c_abstract"])?$_POST["c_abstract"]:"";
	$content = isset($_POST["c_content"])?urldecode($_POST["c_content"]):"";
	$remark = isset($_POST["c_remark"])?urldecode($_POST["c_remark"]):"";
	
	$db = new DB("da_common");
	
	$sql = "insert into comm_case(c_type, c_title, c_abstract, c_img, c_content, c_sort, c_date, c_remark, c_status) 
	values(:c_type, :c_title, :c_abstract, :c_img, :c_content, :c_sort, :c_date, :c_remark, :c_status)";
	$db->param(":c_title", $title);
	$db->param(":c_type", $type);
	$db->param(":c_sort", $sort);
	$db->param(":c_abstract", $abstract);
	$db->param(":c_img", $img);
	$db->param(":c_content", $content);
	$db->param(":c_remark", $remark);
	$db->param(":c_date", date("Y-m-d H:i:s"));
	$db->param(":c_status", "OPEN");
	
	$res = $db->insert($sql);
	// Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>