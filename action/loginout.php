<?php
//注销登录
	session_start();
	$_SESSION['u_id']="";
	$_SESSION['u_code']="";
	$_SESSION['u_name']="";
	$_SESSION['u_depart']="";
	
	echo "<script language='javascript'>location='/login.php';</script>";
?>