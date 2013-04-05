<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php" ?>
	<TITLE>业务表单类型</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}		
		.righttitle {height:30px; line-height:30px; padding:0px 15px;border-bottom:1px solid #f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#btt_remark{width:400px; height:120px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">表单类型基本信息</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="updatebtt();" ><img src="/images/sys_icon/save.png"/>保存</a>
		</div>
	</div>
	
	<table id="orgform" class="tableform" style="width:100%">
		<tr>
			<td colspan="3">名称 <input id="btt_name" type="text" value="" /></td>
		</tr>
		<tr>
			<td style="width:130px;">编号 <input id="btt_id" type="text" style="width:50px;" disabled="true" value=""/></td>
			<td style="width:130px;">排序 <input id="btt_sort" type="text" style="width:50px;" value=""/></td>
			<td>日期 <input id="btt_date" type="text" value="" /></td>
		</tr>
		<tr>
			<td colspan="3" style="vertical-align:top;">备注 <textarea id="btt_remark" ></textarea></td>
		</tr>
	</table>
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/biztemplettype_update.js"></script>

