<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from p_user2role, p_user, p_role where u2r_puid=pu_id and u2r_prid=pr_id ";
	$sql2 = "select count(u2r_id) as Column1 from p_user2role";
	
	if(isset($_POST["prid"])){						//工作组筛选
		$sql .= " and u2r_prid = '".$_POST["prid"]."' order by u2r_id desc ";
		$sql2 .= " where u2r_prid = '".$_POST["prid"]."' ";
	}
	if( isset($_POST["pageindex"]) ){				//分页
		$start = ($_POST["pageindex"]-1)*$_POST["pagesize"];
		$end = $start + $_POST["pagesize"];
		$sql .= " limit ".$start.", ".$end;
	}
	
	$db = new DB(1);
	$set = $db->GetAll($sql);
	$count = $db->GetAll($sql2);
	//echo $db->error_message;
	$db->Destroy();
	
	// $log = new Log();
	// $log->write($sql);
	// $log->write($sql2);
	// $log->write($db->error_message);
	
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