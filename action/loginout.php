<?php
//注销登录
	session_start();
	setcookie('COOKIE_FROM_DASYS', "", time()-86400, "/");		//设置cookie 失效
	
	echo "<script language='javascript'>location='/login.php';</script>";
?>