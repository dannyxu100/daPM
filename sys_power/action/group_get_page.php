<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	//include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$db = new DB("da_powersys");
	$sql1 = "select * from p_group ";
	$param1 = array();
	
	$sql2 = "select count(pg_id) as Column1 from p_group ";
	$param2 = array();
	
	if(isset($_POST["pgid"])){
		$sql1 .= " where pg_id=:pgid ";
		$sql2 .= " where pg_id=:pgid ";
		
		array_push($param1, array(":pgid", $_POST["pgid"]));
		array_push($param2, array(":pgid", $_POST["pgid"]));
	}
	else if(isset($_POST["pgpid"])){
		$sql1 .= " where pg_pid=:pgpid ";
		$sql2 .= " where pg_pid=:pgpid ";
		
		array_push($param1, array(":pgpid", $_POST["pgpid"]));
		array_push($param2, array(":pgpid", $_POST["pgpid"]));
	}
	$sql1 .= " order by pg_sort asc, pg_pid asc";
	
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