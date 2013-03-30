<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	//error_reporting(-1);
	
	$db = new DB("da_powersys");
	$sql1 = "select * from p_user2group, p_user, p_group where u2g_puid=pu_id and u2g_pgid=pg_id ";
	$param1 = array();
	
	$sql2 = "select count(u2g_id) as Column1 from p_user2group";
	$param2 = array();
	
	if( isset($_POST["pgid"]) ){					//部门筛选
		$sql1 .= " and u2g_pgid=:pgid";
		$sql2 .= " where u2g_pgid=:pgid";
		
		array_push($param1, array(":pgid", $_POST["pgid"]));
		array_push($param2, array(":pgid", $_POST["pgid"]));
	}
	
	$sql1 .= " order by u2g_id desc ";
	
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