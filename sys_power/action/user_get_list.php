<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	// $qry = $_POST["qry"];
	
	
	$db = new DB("da_powersys");
	$sql1 = "select * from p_user,p_org where pu_oid=po_id ";
	$param1 = array();
	
	$sql2 = "select count(pu_id) as Column1 from p_user ";
	$param2 = array();
	
	if( isset($_POST["pu_oid"]) ){					//部门筛选
		$sql1 .= " and po_id=:pu_oid";
		$sql2 .= " where pu_oid=:pu_oid";
		
		array_push($param1, array(":pu_oid", $_POST["pu_oid"]));
		array_push($param2, array(":pu_oid", $_POST["pu_oid"]));
	}
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		array_push($param1, array(":start", $start));
		array_push($param1, array(":end", $end));
	}
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
	$db->paramlist($param1);
	$set = $db->getlist($sql1);
	
	$db->paramlist($param2);
	$count = $db->getlist($sql2);
	
	$db->close();
	
	if(is_array($set)){
		for($i=0; $i<count($set); $i++){
			foreach ( $set[$i] as $key => $value ) {
				$set[$i][$key] = urlencode( $value );   
			}

		}
	}
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set									//记录集
	);
	
	// $log->write(var_export($res,true));
	echo urldecode(json_encode($res));
?>