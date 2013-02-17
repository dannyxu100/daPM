<?php
//验证登陆信息
include_once 'sys/db.php';
session_start();

	date_default_timezone_set("Asia/Hong_Kong");
	
//if($_POST['submit']){
	$note=$_POST['l_note'];
	$persent=$_POST['p_persent'];
	$tagid=$_POST['chktag'][0];
	$pid=$_POST['p_id'];
	$uid=$_SESSION['u_id'];
	$uname=$_SESSION['u_name'];
	$date = date("Y-m-d H:i:s");
	//$pwd=md5($pwd);
	
	$db = new DB();
	//$tag = $db->GetOne("select t_name from pm_tag where t_id='".$tagid."'");
	
	$res = $db->Query("insert into pm_project_log(l_note,l_pid,l_date,l_uid,l_uname,l_tagid) values('".$note."','".$pid."','".$date."','".$uid."','".$uname."','".$tagid."')");
	$res2 = $db->Query("update pm_project_info set p_lastlog='".$note."', p_lasttagid='".$tagid."', p_persent='".$persent."' where p_id='".$pid."'");
	$db->Destroy();
	// echo $db->error_message;
	if( $res && $res2)
	{
		echo "<script language='javascript'>location='/logmanage.php?pid=".$pid."';</script>";
	}
	
//}
?>