<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	<title>日志管理页面</title>
	<link rel="stylesheet" href="css/base.css">

</head>
<script>
	function showInsert(){
		document.getElementById("insertPad").style.display = "";
		document.getElementById("listPad").style.display = "none";
	}
	
	function showList(){
		document.getElementById("insertPad").style.display = "none";
		document.getElementById("listPad").style.display = "";
	}
</script>
<body>
	<div id="listPad">
	<div style="padding:5px;"><span style="font-family:'黑体';font-size:22px;"></span><input type="button" style="margin-left:20px;padding:5px;" onclick="showInsert();" value="新增日志"/></div>
	<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;</div>
	<table style="margin:10px auto; width:100%; height:50px;border-top:1px solid #999">
		<tr style="color:#444; background:#f9f9f9;">
			<td class="no_multiple" style="width:20px; height:30px;border-bottom:1px solid #ccc;">序</td>
			<td class="no_multiple" style="width:80px; height:30px;border-bottom:1px solid #ccc;">日期</td>
			<td class="no_multiple" style="width:60px; height:30px;border-bottom:1px solid #ccc;">人员</td>
			<td class="no_multiple" style="width:60px; height:30px;border-bottom:1px solid #ccc;">标签</td>
			<td style="border-bottom:1px solid #ccc;">日志内容</td>
		</tr>
	</table>
	</div>
	<div id="insertPad" style="display:none;">
		<div style="padding:5px;"><span style="font-family:'黑体';font-size:22px;"></span><input type="button" style="margin-left:20px;padding:5px;" onclick="showList();" value="返回"/></div>
		<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;</div>
		<form id="logform" name="logform" method="post" action="action/addlog.php" onsubmit="return chkdata()">
			<table style="margin:10px auto; width:100%; height:50px;">
				<tr >
					<td colspan="3">
						<textarea id="l_note" name="l_note" style="width:100%;height:250px;"></textarea>
						<input id="p_id" name="p_id" type="hidden" value="<?php echo $pid ?>"/>
					</td>
				</tr>
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
					<td colspan="3" style="text-align:center;padding-top:50px;">
						<input id="submit" name="submit" type="submit" style="width:100px; height:30px;" value="提交" onclick=""/>
						<input type="button" style="width:100px; height:30px;color:#999;" value="清空" onclick="document.loginform.reset();" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>

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
