<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加帮助文档</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
 
	<style type="text/css">
		.ztree li span.button.add {
			margin-left:2px;
			margin-right: -1px;
			background-position:-144px 0;
			vertical-align:top;
			*vertical-align:middle
		}
		
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#tabbar{padding-top:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">基本信息</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="updatehelper();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table class="tablesolid" style="width:100%;">
		<tr>
			<td class="header" style="width:60px;">标题</td>
			<td colspan="3"><input id="h_name" style="width:400px;" /><input id="it_id" type="hidden"/></td>
		</tr>
		<tr>
			<td class="header" style="width:60px;">编码</td>
			<td style="width:150px;"><input id="h_code"/></td>
			<td class="header" style="width:60px;">排序</td>
			<td><input id="h_sort"/></td>
		</tr>
		<tr>
			<td class="header">撰写</td>
			<td><input id="h_editorname" disabled="false"/></td>
			<td class="header">日期</td>
			<td><input id="h_editordate" disabled="false"/></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td colspan="3">
				<textarea id="h_content" name="h_content" style="width:90%; height:400px;" ></textarea>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/helper_update.js"></script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>