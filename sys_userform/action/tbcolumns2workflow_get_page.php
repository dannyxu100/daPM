<?php
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$wfid = $_POST["wfid"];
	
	$db = new DB("da_userform");
	$sql1 = "select COLUMNS.* from ";
	$param1 = array();
	
	$sql2 = "select count(COLUMN_NAME) as Column1 from ";
	$param2 = array();
	
	$sql3 = "information_schema.COLUMNS, da_bizform.b_biztemplet, da_workflow.w_workflow 
	where TABLE_NAME=bt_dbsource 
	and bt_id=wf_btid 
	and wf_id=:wfid ";
	
	$sql1 .= $sql3;
	$sql2 .= $sql3;
	
	array_push($param1, array(":wfid", $wfid));
	array_push($param2, array(":wfid", $wfid));
		
	$sql1 .= " order by ORDINAL_POSITION asc, COLUMN_NAME asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	Log::out($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write($res);
	echo urldecode(json_encode($res));
?>