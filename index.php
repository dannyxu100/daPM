<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	<?include_once("action/fn.php");?>
	<?include_once("action/sys/db.php");?>

	<link rel="icon" href="/image/pm_ico.jpg" type="image/x-icon" />
	<link rel="stylesheet" href="/css/base.css"/>

	<title>项目进度管理-桌面</title>

	<style>
	#title_bar{border-bottom:solid 1px #666; height:35px; background:#ddd url(/images/bar_bg.jpg) repeat-x;}
	
	#menubar{height:30px; position:absolute;left:250px;top:0px;}
	</style>

	</head>

<body>
<div id="title_bar">
	<img src="images/logo.jpg"/>
	<!--<span style="font-size:20px; font-weight:bold;margin-left:10px;">项目进度管理</span> <span style="font-size:10px;">版本1.0</span>-->
	<div id="menubar"></div>
</div>
<div class="info_bar">
	<img class="userico" src="<?php echo fn_getcookie('puicon')?fn_getcookie('puicon'):'/images/userico/default.png' ?>" onmouseover="showuserinfo()" />
	<div class="userinfo_list" title="点击关闭" onclick="hideuserinfo()">
		<ul><span>姓 名:&nbsp;&nbsp;</span><?php echo fn_getcookie("puname") ?> </ul>
		<ul><span>所属部门:&nbsp;&nbsp;</span><?php echo fn_getcookie("poname") ?> </ul>
		<ul><span>角 色:&nbsp;&nbsp;</span><?php echo fn_getcookie("rolename") ?> </ul>
		<ul><span>工作组:&nbsp;&nbsp;</span><?php echo fn_getcookie("groupname") ?> </ul>
		<ul><a href="javascript:void(0)" onclick="uploadico()">更新头像</a></ul>
	</div> 
	<a href="javascript:void(0)" onclick="updatepwd(<?php echo fn_getcookie("puid") ?>)">修改密码</a> | 
	<a href="/action/loginout.php">退出</a>
</div>

<iframe id="mainframe" src="" frameborder="0" style="width:100%;height:500px;" defaultHeight="600"></iframe>

</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>
