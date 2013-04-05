<?php
//验证登陆信息
include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/fn.php";
include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
session_start();

	date_default_timezone_set('ETC/GMT-8');
	
//if($_POST['submit']){
	$note=$_POST['l_note'];
	$persent=$_POST['p_persent'];
	$tagid=$_POST['chktag'][0];
	$pid=$_POST['p_id'];
	$uid=fn_getcookie('puid');
	$uname=fn_getcookie('puname');
	$date = date("Y-m-d H:i:s");
	//$pwd=md5($pwd);
	
	$db = new DB("pm");
	//$tag = $db->GetOne("select t_name from pm_tag where t_id='".$tagid."'");
	$param1 = array();
	array_push($param1, array(":note", $note));
	array_push($param1, array(":pid", $pid));
	array_push($param1, array(":date", $date));
	array_push($param1, array(":uid", $uid));
	array_push($param1, array(":uname", $uname));
	array_push($param1, array(":tagid", $tagid));
	$db->paramlist($param1);
	$res = $db->insert("insert into pm_project_log(l_note,l_pid,l_date,l_uid,l_uname,l_tagid) values(:note, :pid, :date, :uid, :uname, :tagid)");
	
	$param2 = array();
	array_push($param2, array(":note", $note));
	array_push($param2, array(":pid", $pid));
	array_push($param2, array(":persent", $persent));
	array_push($param2, array(":tagid", $tagid));
	$db->paramlist($param2);
	$res2 = $db->update("update pm_project_info set p_lastlog=:note, p_lasttagid=:tagid, p_persent=:persent where p_id=:pid ");
	echo $db->geterror();
	$db->close();
	
	if( $res && $res2)
	{
		echo "<script language='javascript'>location='/logmanage.php?pid=".$pid."';</script>";
	}
	
//}
?>