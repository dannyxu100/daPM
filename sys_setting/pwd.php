<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>项目进度管理-修改密码</title>
<link rel="stylesheet" href="/css/base.css">
<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
</head>

<body style="background:#f9f9f9;">
	<div style="padding:20px 80px;">
		<div>旧密码 <input id="old_pwd" type="text" style="width:150px;"/></div>
		<br/>
		<div>新密码 <input id="new_pwd" type="password" style="width:150px;"/></div>
		<br/>
		<div>再确认 <input id="new_pwd2" type="password" style="width:150px;"/></div>
		<br/><br/>
		<div style="text-align:center;">
			<input type="button" style="width:100px; height:30px;" value="确定" onclick="savepwd()"/>
		</div>
	</div>
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
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
	
	function savepwd(){
		if( !chkdata() ){
			return;
		}
	
		da.runDB("/action/updatepwd.php",{
			old_pwd: da("#old_pwd").val(),
			new_pwd: da("#new_pwd").val()
			
		},function(res){debugger;
			if("1"==res){
				alert("修改成功。");
			}
			else{
				alert(res);
			}
		});
	}
	
	daLoader("daMsg",function(){
		
	});
</script>
