﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>添加日志回复</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="title"></span></div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savereply();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="tablesolid" style="width:100%; height:50px;">
		<tr >
			<td colspan="4">
				<textarea id="r_conent" name="r_conent" style="width:100%;height:350px;"></textarea>
			</td>
		</tr>
		<tr >
			<td class="header" >发布人:</td>
			<td><span id="replyuser" style="color:#666"></span></td>
			<td class="header" >日&nbsp;&nbsp;&nbsp;&nbsp;期:</td>
			<td >
				<span id="replydate" style="color:#666"></span>
			</td>
		</tr>
	</table>
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/reply_add_item.js"></script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script>
	var g_editor;
	KindEditor.ready(function(K) {
		g_editor = K.create('#r_conent', {
			resizeType : 1,
			allowPreviewEmoticons : false,
			fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
			allowFileManager : true,
			items : [
				'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
				'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
				'insertunorderedlist', '|', 'emoticons', 'image', 'link']
		});
	});
</script>
</html>
