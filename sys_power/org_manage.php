<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>部门管理</TITLE>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
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
		.righttitle {height:30px; line-height:30px; padding:0px 15px;border-bottom:1px solid #f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#po_remark{width:400px; height:120px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">部门管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="width:250px;vertical-align:top;"><ul id="treeDemo" class="ztree"></ul></td>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">基本信息</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="updateorg();" ><img src="/images/sys_icon/save.png" /> 保存</a>
					</div>
				</div>
				
				<table id="orgform" class="tableform" style="width:100%">
					<tr>
						<td colspan="3">名称 <input id="po_name" type="text" style="width:400px;" value="" /></td>
					</tr>
					<tr>
						<td style="width:130px;">编号 <input id="po_id" type="text" style="width:50px;" disabled="true" value=""/></td>
						<td style="width:130px;">排序 <input id="po_sort" type="text" style="width:50px;" value=""/></td>
						<td>日期 <input id="po_date" type="text" value="" /></td>
					</tr>
					<tr>
						<td colspan="3" style="vertical-align:top;">备注 <textarea id="po_remark" ></textarea></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/org_manage.js"></script>

