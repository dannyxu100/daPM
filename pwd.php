<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>项目进度管理-修改密码</title>
<link rel="stylesheet" href="css/base.css">
</head>

<body style="background:#f9f9f9;">
<form id="pwdform" name="pwdform" method="post" action="/action/updatepwd.php" onsubmit="return chkdata()">
	<div style="padding:20px 80px;">
		<div>旧密码 <input id="old_pwd" name="old_pwd" type="text" style="width:150px;"/></div>
		<br/><br/>
		<div>新密码 <input id="new_pwd" name="new_pwd" type="password" style="width:150px;"/></div>
		<br/>
		<div>再确认 <input id="new_pwd2" name="new_pwd2" type="password" style="width:150px;"/></div>
		<br/><br/>
		<div style="text-align:center;"><input id="submit" name="submit" type="submit" style="width:100px; height:30px;" value="确定" onclick=""/></div>
	</div>
</form>
</body>
<script>
	function chkdata(){
		if(""==document.getElementById("old_pwd").value){
			alert("旧密码不能为空！");
			return false;
		}
		if(""==document.getElementById("new_pwd").value){
			alert("新密码不能为空！");
			return false;
		}
		
		if(""==document.getElementById("new_pwd2").value){
			alert("再确认密码不能为空！");
			return false;
		}
		
		if(document.getElementById("new_pwd").value!=document.getElementById("new_pwd2").value){
			alert("两次输入的新密码不一致！");
			return false;
		}
		return true;
	}
</script>
</html>
