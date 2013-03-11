<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";

	$db = new DB("da_workflow");
	$sql1 = "select * from w_transition ";
	$param1 = array();
	
	$sql2 = "select count(t_id) as Column1 from w_transition ";
	$param2 = array();
	
	if( isset($_POST["wfid"]) ){
		$sql1 .= " where t_wfid=:wfid ";
		$sql2 .= " where t_wfid=:wfid ";
		
		array_push($param1, array(":wfid", $_POST["wfid"]));
		array_push($param2, array(":wfid", $_POST["wfid"]));
	}
	$sql1 .= " order by t_sort asc, t_id asc ";
	
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
	
	// $log->write(var_export($res,true));
	echo urldecode(json_encode($res));
?>