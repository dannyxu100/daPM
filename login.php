﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>项目进度管理-登陆页面</title>
<link rel="stylesheet" href="css/base.css">
</head>
<body>
<form id="loginform" name="loginform" method="post" action="/action/logincheck.php">
	<div style="width:900px; margin:50px auto; position:relative;">
		<div style="width:400px; position:absolute; top:160px; left:450px;">
			<table cellspacing="0" cellpadding="0" style="margin:10px auto; width:60%; height:50px;">
				<tr>
					<td style="width:40px; height:50px;">账号</td>
					<td><input id="u_code" name="u_code" type="text" style="width:150px;"/></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input id="u_pwd" name="u_pwd" type="password" style="width:150px;"/></td>
				</tr>
			</table>
			<div style="margin:20px auto; text-align:center;">
				<input id="submit" name="submit" type="submit" style="width:100px; height:30px;" value="登陆" onclick=""/>
				<input type="button" style="width:50px; height:30px;" value="清空" onclick="document.loginform.reset();" />
			</div>
		</div>
		
		<div style="height:65px; background:url(/images/loginbox/1.jpg);"></div>
		<div style="height:198px; background:url(/images/loginbox/2.jpg);"></div>
		<div style="height:163px; background:url(/images/loginbox/3.jpg);"></div>
		<div style="height:74px; background:url(/images/loginbox/4.jpg);"></div>
	</div>
</form>
</body>
</html>
