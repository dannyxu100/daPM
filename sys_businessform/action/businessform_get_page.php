<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$db = new DB("da_bizform");
	$sql1 = "select * from b_businessform ";
	$param1 = array();
	
	$sql2 = "select count(bf_id) as Column1 from b_businessform ";
	$param2 = array();
	
	if( isset($_POST["bftid"]) ){					//部门筛选
		$sql1 .= " where bf_bftid=:bftid ";
		$sql2 .= " where bf_bftid=:bftid ";
		
		array_push($param1, array(":bftid", $_POST["bftid"]));
		array_push($param2, array(":bftid", $_POST["bftid"]));
	}
	
	$sql1 .= " order by bf_sort asc, bf_id asc ";
	
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
	
	// $log->write($res);
	echo urldecode(json_encode($res));
?>