<?php
//验证登陆信息
include_once 'sys/db.php';
session_start();

$uid = $_SESSION['u_id'];
$oldpwd=$_POST['old_pwd'];
$newpwd=$_POST['new_pwd'];
//$pwd=md5($pwd);

if($oldpwd!==$_SESSION['u_pwd'])
{
	echo "<script language='javascript'>alert('旧密码不正确！');location='/pwd.php';</script>";
}

$db = new DB();
//echo $db->error_message;

if ($db->Query("update pm_user set u_pwd='".$newpwd."' where u_id='".$uid."'")){
	$_SESSION['u_pwd']=$newpwd;
	$db->Destroy();
	
	echo "<script language='javascript'>alert('密码修改成功！');location='/pwd.php';</script>";
}
else {
	$db->Destroy();
	echo "<script language='javascript'>alert('操作失败！');location='/pwd.php';</script>";
}

?>