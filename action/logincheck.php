<?php
//在需要验证管理员身份的地方引用
//在引用本文件之前不能有任何形式的输出，建议在文档最开始出引用
// session_start();

if (!isset($_COOKIE['COOKIE_FROM_DASYS'])){
	echo "<script language='javascript'>top.location.href='/login.php';</script>";
}
?>