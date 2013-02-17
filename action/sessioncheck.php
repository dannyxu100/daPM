<?php
//在需要验证管理员身份的地方引用
//在引用本文件之前不能有任何形式的输出，建议在文档最开始出引用
session_start();
if ($_SESSION['u_id']==""){
	echo "<script language='javascript'>alert('非法操作！');location='/login.php';</script>";
}
?>