<?php
//验证登陆信息
include_once 'sys/db.php';
session_start();

//if($_POST['submit']){
	$code=$_POST['u_code'];
	$pwd=$_POST['u_pwd'];
	//$pwd=md5($pwd);
	
	$db = new DB(1);
	$row = $db->GetOne("select * from p_user where pu_code='".$code."' and pu_pwd='".$pwd."'");
	//echo $db->error_message;
	//print_r($row);
	
	if ($row['pu_code']===$code && $row['pu_pwd']===$pwd){
		$_SESSION['u_id']=$row['pu_id'];
		$_SESSION['u_code']=$row['pu_code'];
		$_SESSION['u_pwd']=$row['pu_pwd'];
		$_SESSION['u_name']=$row['pu_name'];
		$_SESSION['u_oid']=$row['pu_oid'];
		
		$db->GetOne("update p_user set pu_lastlogin='".time()."' where pu_id='".$row['pu_id']."'");
		
		echo "<script language='javascript'>location='/index.php';</script>";
	}
	else {
		echo "<script language='javascript'>alert('用户名不存在，或者密码错误！');location='/login.php';</script>";
	}
	$db->Destroy();
//}
?>