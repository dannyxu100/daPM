<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="/image/pm_ico.jpg" type="image/x-icon" />
<link rel="stylesheet" href="/css/base.css"/>

<title>项目进度管理-桌面</title>
<div style="display:none;">
<?include_once("action/sessioncheck.php");?>
<?include_once("action/sys/db.php");?>
</div>

<style>
#title_bar{border-bottom:solid 1px #666; height:35px; background:#f7f7f7;}
#info_bar{position:absolute;top:0px;right:15px;border:solid 0px #f0f0f0;}

#user_list{color:#555; border-bottom:solid 0px #f0f0f0; padding:5px 15px; margin-bottom:10px;}

#menubar{height:30px; position:absolute;left:250px;top:0px;}
</style>

</head>

<body>
<div id="title_bar">
	<!--<img src="image/logo.jpg"/>-->
	<span style="font-size:20px; font-weight:bold;margin-left:10px;">项目进度管理</span> <span style="font-size:10px;">版本1.0</span>
	<div id="menubar"></div>
</div>
<div id="info_bar">
	<span><?php echo $_SESSION["u_name"] ?> | <?php echo $_SESSION["u_depart"] ?></span> - 
	<a href="javascript:void(0)" onclick="updatepwd()">修改密码</a> | 
	<a href="/action/loginout.php" style="color:#f00">退出</a>
</div>

<iframe id="mainframe" src="" frameborder="0" style="width:100%;height:500px;" defaultHeight="600"></iframe>

</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/index.js"></script>
