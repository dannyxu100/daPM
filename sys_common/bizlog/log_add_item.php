﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	<title>添加业务单日志</title>
	<link rel="stylesheet" href="/css/base.css" />

</head>
<body>
	<span id="log_title">日志管理</span>
	<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;</div>
	<table style="width:100%; height:50px;">
		<tr >
			<td colspan="3" style="padding:3px">
				标签:&nbsp;&nbsp;
			</td>
		</tr>
		<tr >
			<td>完成进度:&nbsp;&nbsp;
				<select id="p_persent" name="p_persent" style="width:80px;">
					<option selected></option>
					<option></option>
				</select> ％
			</td>
			<td>记录人员: <span style="color:#ccc"></span></td>
			<td>日期: <span style="color:#ccc"></span></td>
		</tr>
		<tr >
			<td colspan="3">
				<textarea id="l_note" name="l_note" style="width:100%;height:350px;"></textarea>
				<input id="p_id" name="p_id" type="hidden" value="<?php echo $pid ?>"/>
			</td>
		</tr>
		<tr >
			<td colspan="3" style="text-align:center;padding-top:10px;">
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
