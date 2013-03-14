﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	<title>添加业务单日志</title>
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
			<a class="item" href="javascript:void(0)" onclick="savelog();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="tablesolid" style="width:100%; height:50px;">
		<tr >
			<td class="header" style="width:50px;">进&nbsp;&nbsp;&nbsp;&nbsp;度:</td>
			<td colspan="3">
				<select id="p_persent" name="p_persent" style="width:80px;">
					<option selected></option>
					<option></option>
				</select> ％
			</td>
		</tr>
		<tr >
			<td class="header" >标&nbsp;&nbsp;&nbsp;&nbsp;签:</td>
			<td colspan="3">
				<span id="tags"></span>
			</td>
		</tr>
		<tr >
			<td colspan="4">
				<textarea id="l_note" name="l_note" style="width:100%;height:350px;"></textarea>
				<input id="p_id" name="p_id" type="hidden" value="<?php echo $pid ?>"/>
			</td>
		</tr>
		<tr >
			<td class="header" >发布人:</td>
			<td><span id="loguser" style="color:#666"></span></td>
			<td class="header" >日&nbsp;&nbsp;&nbsp;&nbsp;期:</td>
			<td >
				<span id="logdate" style="color:#666"></span>
			</td>
		</tr>
		<tr >
			<td colspan="4" style="text-align:center;padding-top:10px;">
				<input id="submit" name="submit" type="submit" style="width:80px; height:25px;" value="提交" onclick=""/>
				<input type="button" style="width:80px; height:25px;color:#999;" value="清空" onclick="document.loginform.reset();" />
			</td>
		</tr>
	</table>
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/log_add_item.js"></script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script>
	var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#l_note', {
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
