<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<link rel="icon" href="/images/pm_ico.gif" type="image/x-icon" />
	<link rel="stylesheet" href="/css/base.css"/>

	<title>项目进度管理</title>

	</head>
<body>
<div id="title_bar">
	<img src="images/logo.jpg"/>
	<!--<span style="font-size:20px; font-weight:bold;margin-left:10px;">项目进度管理</span> <span style="font-size:10px;">版本1.0</span>-->
	<div id="menubar">
		<div id="menus"></div>
		
		<div id="menu_cur"></div>
		<div id="menumorebox">
			<a id="bt_more" href="javascript:void(0)"></a>
			<div id="list_menumore" class="shandowbox"></div>
		</div>
		
	</div>
</div>
<div class="info_bar">
	<div id="userico">
		<img id="puicon" src="/uploads/userico/default.png" />
		<div class="userinfo_list shandowbox" title="点击关闭">
			<ul><a href="javascript:void(0)" onclick="uploadico()">更新头像</a></ul>
			<ul>姓&nbsp;&nbsp;&nbsp;&nbsp;名:&nbsp;&nbsp;<span id="puname"></span> </ul>
			<ul>部&nbsp;&nbsp;&nbsp;&nbsp;门:&nbsp;&nbsp;<span id="poname"></span> </ul>
			<ul>角&nbsp;&nbsp;&nbsp;&nbsp;色:&nbsp;&nbsp;<span id="rolename"></span> </ul>
			<ul>工作组:&nbsp;&nbsp;<span id="groupname"></span> </ul>
		</div> 
	</div>
	<a href="javascript:void(0)" onclick="updatepwd()">修改密码</a> | 
	<a href="/action/loginout.php">退出</a>
</div>

<iframe id="mainframe" src="" frameborder="0" style="width:100%; height:500px;" defaultHeight="600"></iframe>

<div id="scrolltop"></div>
<!--
<div id="gamebg" style="position:absolute; z-index:999; top:0px; left:0px; background:#f0f0f0;"></div>
<div id="gamefly" style="position:absolute; z-index:1000; top:300px; left:200px; width:50px; height:50px; background:#fff;" ></div>
<div id="gamepointer" style="position:absolute; z-index:1000; top:300px; left:200px; width:50px; height:50px; background:#f00;" ></div>
-->
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/fn.js"></script>
<script type="text/javascript" src="js/index.js"></script>
