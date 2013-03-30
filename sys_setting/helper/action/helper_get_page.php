<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	$db = new DB("da_setting");
	$sql1 = "select * from s_helper ";
	$param1 = array();
	
	$sql2 = "select count(h_id) as Column1 from s_helper ";
	$param2 = array();
	
	if( isset($_POST["htid"]) ){
		$sql1 .= " where h_htid=:htid ";
		$sql2 .= " where h_htid=:htid ";
		
		array_push($param1, array(":htid", $_POST["htid"]));
		array_push($param2, array(":htid", $_POST["htid"]));
	}
	$sql1 .= " order by h_sort asc, h_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	// $log = new Log();
	// $log->write($sql1);
	// $log->write($sql2);
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	// $log->write($db->geterror());
	$db->close();
		
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(json_encode($res));
	echo json_encode($res);
?>