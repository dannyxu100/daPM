﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>日志管理页面</title>
	<link rel="stylesheet" href="/css/base.css" />

</head>
<body>
	<div class="list_top_bar">
		<div class="list_top_title"><span id="log_title">日志管理</span></div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="addlog();" ><img src="/images/sys_icon/add.png" /> 添加日志</a>
			<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
		</div>
	</div>
	
	<div id="insertPad" style="display:none;">
		<div class="list_top_bar">
			<div class="list_top_title"><span id="log_title">日志管理</span></div>
			<div class="list_top_tools" style="float:left;">
				<a class="item" href="javascript:void(0)" onclick="showList();" ><img src="/images/sys_icon/arrow_back.png" /> 返回日志列表</a>
			</div>
		</div>
		<div style="padding:5px;color:#ccc;">项目负责人:&nbsp;&nbsp;</div>
		<form id="logform" name="logform" method="post" action="action/addlog.php" onsubmit="return chkdata()">
			<table style="width:800px; height:50px;">
				<tr >
					<td colspan="3">
						<textarea id="l_note" name="l_note" style="width:800px;height:250px;"></textarea>
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
					<td colspan="3" style="text-align:center;padding-top:10px;">
						<input id="submit" name="submit" type="submit" style="width:80px; height:25px;" value="提交" onclick=""/>
						<input type="button" style="width:80px; height:25px;color:#999;" value="清空" onclick="document.loginform.reset();" />
					</td>
				</tr>
			</table>
		</form>
	</div>
	
	<div id="listPad" style="padding:5px;"></div>
	
	<div id="logtemplet" style="display:none;">
		<ul id="log_{l_id}" class="logitem" >
			<div class="line">
				<div class="dot">{dot}</div>
				<div class="txt">{l_date}</div>
			</div>
			
			<div class="ico" >
				<img src="{userico}"/>
				<div class="txt">{puname}</div>
			</div>
			<div class="pl" >
				<div class="pl_img"></div>
			</div>
			<div class="content" >
				{l_content}
			</div>
			<div style="clear:both;"></div>
			<div class="logtoolbar" >
				<a href="javascript:void(0)" onclick="addreply({l_id})">回复</a>
			</div>
			<div id="reply_{l_id}" class="logreply" ></div>
		</ul>
	</div>
	<div id="replytemplet" style="display:none;">
		<ul class="item" >
			<div class="ico" >
				<img src="{userico}"/>
				<div class="txt">{puname}</div>
			</div>
			<div class="pr">
				<div class="pr_img"></div>
			</div>
			<div class="content" >
				<div class="rdate">{r_date}</div>
				{r_content}
			</div>
			<div style="clear:both;"></div>
		</ul>
	</div>
	
	
	
</body>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/log_manage.js"></script>

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
