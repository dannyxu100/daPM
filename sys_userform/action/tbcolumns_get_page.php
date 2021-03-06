<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_userform");
	$sql1 = "select * from information_schema.COLUMNS ";
	$param1 = array();
	
	$sql2 = "select count(TABLE_NAME) as Column1 from information_schema.COLUMNS ";
	$param2 = array();
	
	if(isset($_POST["tbname"])){
		$sql1 .= " where TABLE_NAME=:tbname ";
		$sql2 .= " where TABLE_NAME=:tbname ";
		
		array_push($param1, array(":tbname", $_POST["tbname"]));
		array_push($param2, array(":tbname", $_POST["tbname"]));
	}
	$sql1 .= " order by ORDINAL_POSITION asc, COLUMN_NAME asc";
	
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
	echo urldecode(json_encode($res));
?>