<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);

	$db = new DB("da_powersys");
	$sql1 = "select * from p_user2role, p_user, p_role where u2r_puid=pu_id and u2r_prid=pr_id ";
	$param1 = array();
	
	$sql2 = "select count(u2r_id) as Column1 from p_user2role ";
	$param2 = array();
	
	if( isset($_POST["prid"]) ){					//部门筛选
		$sql1 .= " and u2r_prid=:prid";
		$sql2 .= " where u2r_prid=:prid";
		
		array_push($param1, array(":prid", $_POST["prid"]));
		array_push($param2, array(":prid", $_POST["prid"]));
	}
	
	$sql1 .= " order by u2r_id desc ";
	
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