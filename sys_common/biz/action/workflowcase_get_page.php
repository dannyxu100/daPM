<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/fn.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	
	$dbsrc = $_POST["dbsource"];
	$dbfld = $_POST["dbfld"];
	
	$db = new DB("da_userform");
	$sql1 = "select ".$dbsrc.".* from ".$dbsrc.", ";
	$param1 = array();
	
	$sql2 = "select count(*) as Column1 from ".$dbsrc.", ";
	$param2 = array();

	$sql3 = "da_bizform.b_bizcase, da_workflow.w_workflowcase 
	where ".$dbsrc."." .$dbfld."=b_bizcase.bc_dbsourceid 
	and b_bizcase.bc_wfcid=w_workflowcase.wfc_id 
	and w_workflowcase.wfc_wfid=:wfid ";
	
	
	$sql1 .= $sql3;
	array_push($param1, array(":wfid", $_POST["wfid"]));
	// $sql1 .= " order by bt_sort asc, bt_id asc ";
	
	$sql2 .= $sql3;
	array_push($param2, array(":wfid", $_POST["wfid"]));
	
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
		"ds11"=>$set							//记录集
	);
	
	// $log->write(json_encode($res));
	echo json_encode($res);
?>