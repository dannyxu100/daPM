<?php 
	include_once $_SERVER['DOCUMENT_ROOT']."action/sessioncheck.php";
	include_once $_SERVER['DOCUMENT_ROOT']."action/sys/db.php";
	// include_once $_SERVER['DOCUMENT_ROOT']."action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("da_powersys");
	$sql1 = "select * from p_group2role, p_group, p_role where g2r_pgid=pg_id and g2r_prid=pr_id ";
	$param1 = array();
	
	$sql2 = "select count(g2r_id) as Column1 from p_group2role";
	$param2 = array();
	
	if(isset($_POST["prid"])){						//工作组筛选
		$sql1 .= " and g2r_prid=:prid order by pg_sort asc ";
		$sql2 .= " where g2r_prid=:prid ";
		
		array_push($param1, array(":prid", $_POST["prid"]));
		array_push($param2, array(":prid", $_POST["prid"]));
	}
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
	
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	
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