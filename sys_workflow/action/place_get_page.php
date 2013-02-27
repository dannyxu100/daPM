<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$db = new DB("da_workflow");
	$sql = "select * from w_place ";
	$sql2 = "select count(p_id) as Column1 from w_place ";
	
	if( isset($_POST["wfid"]) ){
		$sql .= " where p_wfid=:wfid ";
		$sql2 .= " where p_wfid=:wfid ";
		$db->param(":wfid", $_POST["wfid"]);
	}
	$sql .= " order by p_sort asc, p_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql .= " limit :start, :end";
		$db->param(":start", $start);
		$db->param(":end", $end);
	}
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
	$set = $db->getlist($sql);
	$count = $db->getlist($sql2);
	//echo $db->error_message;
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