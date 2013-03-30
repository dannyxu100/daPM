<?php
//验证登陆信息
include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/sys/db.php";
session_start();
	
//if($_POST['submit']){
	$code=$_POST['u_code'];
	$pwd=$_POST['u_pwd'];
	//$pwd=md5($pwd);
	
	$db = new DB();
	$row = $db->GetOne("select * from pm_user where u_code='".$code."' and u_pwd='".$pwd."'");
	$db->Destroy();
	//echo $db->error_message;
	//print_r($row);
	
	if ($row['u_code']===$code && $row['u_pwd']===$pwd){
		$_SESSION['u_id']=$row['u_id'];
		$_SESSION['u_code']=$row['u_pwd'];
		$_SESSION['u_name']=$row['u_name'];
		$_SESSION['u_depart']=$row['u_depart'];
		
		echo "<script language='javascript'>location='index.php';</script>";
	}
	else {
		echo "<script language='javascript'>alert('用户名不存在，或者密码错误！');location='login.php';</script>";
	}
//}
?>