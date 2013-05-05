<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	
	$cid = $_POST["c_id"];
	$title = $_POST["c_title"];
	$type = $_POST["c_type"];
	$sort = $_POST["c_sort"];
	$img = $_POST["c_img"];
	$abstract = isset($_POST["c_abstract"])?$_POST["c_abstract"]:"";
	$content = isset($_POST["c_content"])?urldecode($_POST["c_content"]):"";
	$remark = isset($_POST["c_remark"])?urldecode($_POST["c_remark"]):"";
	
	$db = new DB("da_common");
	
	$sql = "update comm_case 
	set c_type=:c_type,
	c_title=:c_title,
	c_abstract=:c_abstract,
	c_img=:c_img,
	c_content=:c_content,
	c_sort=:c_sort,
	c_date=:c_date,
	c_remark=:c_remark 
	where c_id=:c_id";
	
	$db->param(":c_id", $cid);
	$db->param(":c_title", $title);
	$db->param(":c_type", $type);
	$db->param(":c_sort", $sort);
	$db->param(":c_abstract", $abstract);
	$db->param(":c_img", $img);
	$db->param(":c_content", $content);
	$db->param(":c_remark", $remark);
	$db->param(":c_date", date("Y-m-d H:i:s"));
	
	$res = $db->update($sql);
	// Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>