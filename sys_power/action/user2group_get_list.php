<?php 
	include_once "../../action/sessioncheck.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	//error_reporting(-1);
	
	$sql = "select * from p_user2group, p_user, p_group where u2g_puid=pu_id and u2g_pgid=pg_id ";
	$sql2 = "select count(u2g_id) as Column1 from p_user2group";
	
	if(isset($_POST["pgid"])){						//工作组筛选
		$sql .= " and u2g_pgid = '".$_POST["pgid"]."' order by u2g_id desc ";
		$sql2 .= " where u2g_pgid = '".$_POST["pgid"]."' ";
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