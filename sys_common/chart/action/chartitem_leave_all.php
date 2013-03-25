<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$dbsource = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	
	$db = new DB("da_userform");
	/******************* 查询数据源记录集 ***************************************************/
	$sql1 = "select l_puname, count(l_id) sum_count from ".$dbsource." ";
	$param1 = array();
	
	$sql2 = "select count(l_id) as Column1 from ".$dbsource." ";
	$param2 = array();
	
	$sql3 = " group by l_puname ";
	
	$sql1 .= $sql3;
	$sql2 .= $sql3;
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	// Log::out($sql31);
	// Log::out($wfid);
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	// Log::out($db->geterror());
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	// Log::out($db->geterror());
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set							//记录集
	);
	
	// Log::out(json_encode($res));
	echo json_encode($res);
?>