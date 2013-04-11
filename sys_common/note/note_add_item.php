<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>添加我的便签</title>
	<link rel="stylesheet" href="/css/base.css" />
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="title">我的笔记</span></div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savenote();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="tablesolid" style="width:100%; height:50px;">
		<tr >
			<td class="header" >标 题</td>
			<td colspan="3">
				<input id="n_title" type="text" style="width:600px;"/>
			</td>
		</tr>
		<tr >
			<td class="header" style="width:80px;">便签本</td>
			<td colspan="3">
				<select id="n_tid">
					<option value="0">我的笔记</option>
				</select>
				<a href="javascript:void(0)">添加便签本</a>
			</td>
		</tr>
		<tr >
			<td class="header" >摘 要</td>
			<td colspan="3">
				<textarea id="n_sss" name="l_conent" style="width:600px;height:100px;"></textarea>
			</td>
		</tr>
		<tr >
			<td class="header" >详细内容</td>
			<td colspan="3">
				<textarea id="n_conent" name="l_conent" style="width:600px;height:400px;"></textarea>
			</td>
		</tr>
	</table>
</body>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/note_add_item.js"></script>

<script>
	var g_editor;
	KindEditor.ready(function(K) {
		g_editor = K.create('#n_conent', {
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
