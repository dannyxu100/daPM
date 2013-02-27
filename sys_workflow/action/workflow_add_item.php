<?php 
	// json_encode($arr);
	include_once "../../action/sessioncheck.php";
	include_once "../../action/fn.php";
	include_once "../../action/sys/db.php";
	// include_once "../../action/sys/log.php";
	// error_reporting(-1);

	date_default_timezone_set("Asia/Hong_Kong");
	$rows = 0;
	
	$db = new DB("da_workflow");
	$sql = "insert into w_workflow(wf_name, wf_wftid, wf_sort, wf_isrun, wf_starttaskid, wf_user, wf_date, wf_edituser, wf_editdate, wf_remark) 
	values(:wf_name, :wf_wftid, :wf_sort, :wf_isrun, :wf_starttaskid, :wf_user, :wf_date, :wf_edituser, :wf_editdate, :wf_remark) ";
	$sql .= "'".$_POST["wf_name"]."',";
	$sql .= "'".$_POST["wf_wftid"]."',";
	$sql .= "'".$_POST["wf_sort"]."',";
	$sql .= "'".$_POST["wf_isrun"]."',";
	$sql .= "'".$_POST["wf_starttaskid"]."',";
	$sql .= "'".$_SESSION["u_name"]."',";
	$sql .= "'".date("Y-m-d H:i:s")."',";
	$sql .= "'".$_POST["wf_edituser"]."',";
	$sql .= "'".$_POST["wf_editdate"]."',";
	$sql .= "'".$_POST["wf_remark"]."')";
	
	// $log = new Log();
	// $log->write($sql.time());
	
	$db->param(":wf_name", $_POST["wf_name"]);
	$db->param(":wf_wftid", $_POST["wf_wftid"]);
	$db->param(":wf_sort", $_POST["wf_sort"]);
	$db->param(":wf_isrun", $_POST["wf_isrun"]);
	$db->param(":wf_starttaskid", $_POST["wf_starttaskid"]);
	$db->param(":wf_user", fn_getcookie("puname"));
	$db->param(":wf_date", date("Y-m-d H:i:s"));
	$db->param(":wf_edituser", $_POST["wf_edituser"]);
	$db->param(":wf_editdate", $_POST["wf_editdate"]);
	$db->param(":wf_remark", $_POST["wf_remark"]);
	
	$res = $db->insert($sql);
	$workflow = $db->getone("select @@IDENTITY as wf_id");
	$rows++;
	
	$sql2 = "insert into w_place(p_name, p_wfid, p_type, p_sort) values(";
	$sql2 .= "'开始',";
	$sql2 .= "'".$workflow["wf_id"]."',";
	$sql2 .= "1,";							//起点库所类型为：1
	$sql2 .= "0)";							//排序
	
	$sql3 = "insert into w_place(p_name, p_wfid, p_type, p_sort) values(";
	$sql3 .= "'结束',";
	$sql3 .= "'".$workflow["wf_id"]."',";
	$sql3 .= "999,";						//终点库所类型为：999
	$sql3 .= "9999)";
	
	// $log->write($sql2.time());
	// $log->write($sql3.time());
	$db->tran();		//启动事务
	
	$res = $db->insert($sql2);
	$res = $db->insert($sql3);
	$rows += 2;
	
	if($db->geterror()){
		$db->back();
		echo 'FALSE';
	}
	else{
		// $rows = $db->GetAffectRows();
		$db->commit();
		echo $rows;
	}
	//echo $db->error_message;
	$db->close();
	//print_r($set);
	echo $res?$res:"FALSE";
?>