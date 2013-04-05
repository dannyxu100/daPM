<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";

	// $qry = $_POST["qry"];
	
	$puid = $_POST["puid"];		//客户所属人的id
	
	$db = new DB("da_crm");
	$sql1 = "select * from crm_customer ";
	$param1 = array();
	
	$sql2 = "select count(c_id) as Column1 from crm_customer ";
	$param2 = array();
	
	$sql3 = "where exists( select * from crm_cst2user where c2u_cid=crm_customer.c_id and c2u_puid=:puid )";
	
	$sql1 .= $sql3;
	$sql2 .= $sql3;
	array_push($param1, array(":puid", $puid));
	array_push($param2, array(":puid", $puid));
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(var_export($res,true));
	echo json_encode($res);
?>