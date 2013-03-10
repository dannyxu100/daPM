<?php 
	// error_reporting(-1);
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_bizform");
	$sql1 = "select * from b_biztemplet ";
	$param1 = array();
	
	$sql2 = "select count(bt_id) as Column1 from b_biztemplet ";
	$param2 = array();
	
	if( isset($_POST["bttid"]) ){					//部门筛选
		$sql1 .= " where bt_bttid=:bttid ";
		$sql2 .= " where bt_bttid=:bttid ";
		
		array_push($param1, array(":bttid", $_POST["bttid"]));
		array_push($param2, array(":bttid", $_POST["bttid"]));
	}
	
	$sql1 .= " order by bt_sort asc, bt_id asc ";
	
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
	
	// $log->write($res);
	echo json_encode($res);
?>