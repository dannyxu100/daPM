<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	date_default_timezone_set('ETC/GMT-8');
	
	$puid = fn_getcookie("puid");
	$ntid = $_POST["n_ntid"];
	$abstract = isset($_POST["n_abstract"])?$_POST["n_abstract"]:"122";
	$content = isset($_POST["n_content"])?urldecode($_POST["n_content"]):"122";
	
	$db = new DB("da_common");
	
	if( 0 == $ntid){
		$sql = "insert into comm_notetype(nt_name, nt_puid) values('我的便签', :puid)";
		$db->param(":puid", $puid);
		
		$res = $db->insert($sql);
		$notetype = $db->getone("select @@IDENTITY as nt_id");
		$ntid = $notetype["nt_id"];
	}
	
	$sql = "insert into comm_note(n_ntid, n_title, n_abstract, n_content, n_puid, n_date) 
	values(:n_ntid, :n_title, :n_abstract, :n_content, :puid, :n_date)";
	$db->param(":n_ntid", $ntid);
	$db->param(":n_title", $_POST["n_title"]);
	$db->param(":n_abstract", $abstract);
	$db->param(":n_content", $content);
	$db->param(":puid", $puid);
	$db->param(":n_date", date("Y-m-d H:i:s"));
	
	Log::out($ntid);
	Log::out($_POST["n_title"]);
	Log::out($abstract);
	Log::out($content);
	Log::out($puid);
	Log::out(date("Y-m-d H:i:s"));
	Log::out($sql);
	$res = $db->insert($sql);
	Log::out($db->geterror());
	
	$db->close();
	echo $res?$res:"FALSE";
?>