<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	// $puoid = $_POST["pu_oid"];
	// $pageindex = $_POST["pageindex"];
	// $pagesize = $_POST["pagesize"];
	// $qry = $_POST["qry"];
	
	$sql = "select * from p_user,p_org where pu_oid=po_id ";
	$sql2 = "select count(pu_id) as Column1 from p_user ";
	
	if( isset($_POST["pu_oid"]) ){					//部门筛选
		$sql .= " and po_id=".$_POST["pu_oid"];
		$sql2 .= " where pu_oid=".$_POST["pu_oid"];
	}
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql .= " limit ".$start.", ".$end;
	}
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
	$db = new DB(1);
	$set = $db->GetAll($sql);
	$count = $db->GetAll($sql2);
	//echo $db->error_message;
	$db->Destroy();
	//print_r($set);
	
	if(is_array($set)){
		for($i=0; $i<count($set); $i++){
			foreach ( $set[$i] as $key => $value ) {
				$set[$i][$key] = urlencode( $value );   
			}

		}
	}
	
	$res = array(
		//"ds1"=>array(0=>array("Column1"=>1)),			//总记录数
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write($res);
	echo urldecode(json_encode($res));
?>