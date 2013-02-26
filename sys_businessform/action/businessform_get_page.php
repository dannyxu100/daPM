<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db3.php";
	// include_once "../../action/sys/log.php";

	$sql1 = "select * from b_businessform ";
	$sql2 = "select count(bf_id) as Column1 from b_businessform ";
	$param1 = array();
	$param2 = array();
	
	if( isset($_POST["bftid"]) ){					//部门筛选
		$sql1 .= " where bf_bftid=:bftid ";
		$sql2 .= " where bf_bftid=:bftid ";
		
		$param1 = array_merge($param1, array(":bftid"=>$_POST["bftid"]));
		$param2 = array_merge($param2, array(":bftid"=>$_POST["bftid"]));
	}
	
	$sql1 .= " order by bf_sort asc, bf_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql1 .= " limit :start, :end";
		
		$param1 = array_merge($param1, array(":start"=>$start, ":end"=>$end));
	}
	// $log = new Log();
	// $log->write($sql1);
	// $log->write($sql2);
	
	$db = new DB("da_bizform");
	$set = $db->getlist($sql1, $param1);
	$count = $db->getlist($sql2, $param2);
	//echo $db->error_message;
	// $log->write($db->geterror());
	$db->close();
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