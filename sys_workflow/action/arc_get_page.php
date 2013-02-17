<?php 
	// error_reporting(-1);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";

	$sql = "select w_arc.*, p_name, t_name from w_arc, w_place, w_transition where a_pid=p_id and a_tid=t_id ";
	$sql2 = "select count(a_id) as Column1 from w_arc ";
	
	if( isset($_POST["wfid"]) ){
		$sql .= " and a_wfid=".$_POST["wfid"]." ";
		$sql2 .= " where a_wfid=".$_POST["wfid"]." ";
	}
	$sql .= " order by a_sort asc, a_id asc ";
	
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql .= " limit ".$start.", ".$end;
	}
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
	$db = new DB(2);
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