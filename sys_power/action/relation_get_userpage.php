<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	
	$sql1 = "select * from p_relation, p_user where pu_id=pr_puid ";
	$param1 = array();
	
	$sql2 = "select count(pr_id) as Column1 from p_relation, p_user where pu_id=pr_puid ";
	$param2 = array();
	
	if(isset($_POST["poid"])){
		$sql1 .= " and pr_poid=:poid ";
		$sql2 .= " and pr_poid=:poid ";
		
		array_push($param1, array(":poid", $_POST["poid"]));
		array_push($param2, array(":poid", $_POST["poid"]));
	}
	
	if(isset($_POST["leaderid"])){
		$sql1 .= " and pr_leaderid=:leaderid ";
		$sql2 .= " and pr_leaderid=:leaderid ";
		
		array_push($param1, array(":leaderid", $_POST["leaderid"]));
		array_push($param2, array(":leaderid", $_POST["leaderid"]));
	}
	$sql1 .= " order by pr_puid asc";
		
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