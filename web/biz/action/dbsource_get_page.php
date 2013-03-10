<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."/action/sys/log.php";

	$db = new DB("da_userform");
	$sql1 = "select * from ".$_POST["dbsource"]." ";
	$param1 = array();
	
	$sql2 = "select count(*) as Column1 from ".$_POST["dbsource"]." ";
	$param2 = array();
	
	// $sql1 .= " order by bt_sort asc, bt_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//·ÖÒ³
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
		"ds11"=>$set									//¼ÇÂ¼¼¯
	);
	
	// $log->write($res);
	echo json_encode($res);
?>