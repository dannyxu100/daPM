<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php" ?>
	<TITLE>添加表单</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
	<div class="list_top_bar">
		<div class="list_top_title"></div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="saveform();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px;">名称</td>
			<td><input id="bt_name" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="bt_sort" value="0" /></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea style="width:200px; height:100px;" id="bt_remark" ></textarea></td>
		</tr>
	</table>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/biztemplet_add.js"></script>

