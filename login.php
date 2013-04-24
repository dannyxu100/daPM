<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>项目进度管理-登陆页面</title>
	<link rel="stylesheet" href="css/base.css">
	<link rel="icon" href="/images/pm_ico.gif" type="image/x-icon" />
</head>
<body>
	<div style="width:900px; margin:50px auto; position:relative;">
		<div style="width:400px; position:absolute; top:180px; left:420px;">
			<table cellspacing="0" cellpadding="0" style="margin:10px auto; width:60%; height:50px;">
				<tr>
					<td style="width:40px; height:50px;">账号</td>
					<td><input id="u_code" type="text" style="width:150px;"/></td>
				</tr>
				<tr>
					<td>密码</td>
					<td><input id="u_pwd" type="password" style="width:150px;"/></td>
				</tr>
			</table>
			<div style="margin:20px auto; text-align:center;">
				<input type="button" style="width:100px; height:30px;" value="登陆" onclick="login()"/>
				<input type="button" style="width:50px; height:30px;" value="清空" onclick="clearinput()" />
			</div>
			<div style="margin-top:80px;">版权所有 danny.xu &nbsp;&nbsp;(推荐使用:<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html?hl=zh_cn&brand=CHMA&utm_campaign=zh_cn&utm_source=zh_cn-ha-apac-zh_cn-bk&utm_medium=ha" target="_blank" style="color:#0042d1">chrome浏览器</a>)&nbsp;&nbsp;2013 beta 1.0</div>
		</div>
		
		<div style="height:65px; background:url(/images/loginbox/1.jpg);"></div>
		<div style="height:198px; background:url(/images/loginbox/2.jpg);"></div>
		<div style="height:163px; background:url(/images/loginbox/3.jpg);"></div>
		<div style="height:74px; background:url(/images/loginbox/4.jpg);"></div>
	</div>
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script>
	function clearinput(){
		da("#u_code").val("");
		da("#u_pwd").val("");
	}
	
	function chkdata(){
		if(""==da("#u_code").val()){
			alert("账号不能为空！");
			return false;
		}
		if(""==da("#u_pwd").val()){
			alert("密码不能为空！");
			return false;
		}
		return true;
	}
	
	function login(){
		if( !chkdata() ){
			return;
		}
		loading(true);
		da.runDB("/action/login.php",{
			u_code: da("#u_code").val(),
			u_pwd: da("#u_pwd").val()
			
		},function(res){
			loading(false);
			if("1"==res){
				location.href = "/index.php";
			}
			else{
				alert("登陆失败。");
			}
		});
	}
	
	var g_focuscode="";
	function inputfocus(){
		if(""==g_focuscode || "pwd"==g_focuscode){
			da("#u_code").select();
			g_focuscode = "code";
		}
		else{
			da("#u_pwd").select();
			g_focuscode = "pwd";
		}
	}
	
	daLoader("daMsg,daKey,daLoading",function(){
		inputfocus();
		
		daKey({
			keyup: function(key, isctrl, isalt, isshift){
				if("Enter"==key){
					if("code"==g_focuscode){
						inputfocus();
					}
					else{
						login();
					}
				}
				if("Tab"==key){
					inputfocus();
				}
			}
		});
	});
</script>