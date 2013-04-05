<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加可选项</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>
 
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
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="saveitem();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table class="tablesolid" style="width:;">
		<tr>
			<td class="header" style="width:60px;">选项名</td>
			<td><input id="i_name" style="width:200px;" /><input id="it_id" type="hidden"/></td>
			<td class="header" style="width:80px;">选项值</td>
			<td><input id="i_value"/></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td colspan="3"><input id="i_sort" style="width:100px;"/></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td colspan="3">
				<textarea id="i_remark" name="i_remark" style="width:480px; height:150px;" ></textarea>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/item_add.js"></script>
