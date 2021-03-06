<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$puid = fn_getcookie("puid");
	
	$db = new DB("da_common");
	$sql1 = "select * from comm_note, comm_notetype ";
	$param1 = array();
	
	$sql2 = "select count(n_id) as Column1 from comm_note, comm_notetype ";
	$param2 = array();
	
	$sql1 .= "where n_ntid=nt_id and n_puid=:puid ";
	$sql2 .= "where n_ntid=nt_id and n_puid=:puid ";
	array_push($param1, array(":puid", $puid));
	array_push($param2, array(":puid", $puid));
	
	if( isset($_POST["ntid"])){
		$sql1 .= "and n_ntid=:ntid ";
		$sql2 .= "and n_ntid=:ntid ";
		
		array_push($param1, array(":ntid", $_POST["ntid"]));
		array_push($param2, array(":ntid", $_POST["ntid"]));
	}
	
	$sql1 .= "order by n_date desc";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);

	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	// Log::out($db->geterror());
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(var_export($res,true));
	echo json_encode($res);
?>