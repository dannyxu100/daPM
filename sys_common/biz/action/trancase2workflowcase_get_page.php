<?php 
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
	include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
	// include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/log.php";
	
	$wfcid = $_POST["wfcid"];
	
	$db = new DB("da_workflow");
	
	/**************** 根据可参与事务变迁处理中状态的实例 找出下一步直线库所的 可选择向弧（路由） *****************/
	$sql1 = "select * ";
	$param1 = array();
	
	$sql2 = "select count(tc_id) as Column1 ";
	$param2 = array();
	
	$sql3 = "from w_transition, w_arc, w_trancase 
	left join da_powersys.p_user on w_trancase.tc_puid = p_user.pu_id 
	where tc_tid=t_id 
	and tc_tid=a_tid 
	and a_direction='IN' 
	and tc_wfcid=:wfcid order by tc_enabledate asc";
	
	$sql1 .= $sql3;
	$sql2 .= $sql3;
	array_push($param1, array(":wfcid", $wfcid));
	array_push($param2, array(":wfcid", $wfcid));
	
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
	// Log::out($db->geterror());
	
	$db->close();
	
	$res = array(
		"ds1"=>$count,
		"ds11"=>$set							//记录集
	);
	
	// $log->write(json_encode($res));
	echo json_encode($res);
?>