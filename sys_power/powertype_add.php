<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
  <TITLE>添加权限类型</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
		<a href="javascript:void(0)" onclick="savepowertype();" >保存</a> |
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px;">名称</td>
			<td><input id="pt_name" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">代码</td>
			<td><input id="pt_code" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="pt_sort" value="" /></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea style="width:200px; height:100px;" id="pt_remark" ></textarea></td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/powertype_add.js"></script>

