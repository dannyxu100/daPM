<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	// $dbsource = $_POST["dbsource"];
	// $dbfld = $_POST["dbfld"];
	$wfid = $_POST["wfid"];
	
	$db = new DB("da_userform");
	/******************* 查询数据源记录集 ***************************************************/
	$sql1 = "select tc_status, tc_id sum_count ";
	$param1 = array();
	
	$sql2 = "select count(tc_id) as Column1 ";
	$param2 = array();
	
	$sql3 = " from da_workflow.w_trancase where tc_wfid=".$wfid." ";
	
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