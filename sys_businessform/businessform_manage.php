﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>业务单管理</TITLE>
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
		
		#bf_remark{width:400px; height:120px;}
		#tabbar{padding-top:5px;}
		
		a.bfitem {display:block; float:left; margin:5px; padding:3px 5px; border:1px solid #999; background:#f5f5f5;}
		a.bfitem:hover { background:#fff; color:#000;}
		a.curbfitem { background:#666;  border:1px solid #000; color:#fff;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">业务单管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;"><ul id="treeDemo" class="ztree"></ul></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div class="righttitle">
					<a id="bft_title" href="javascript:void(0)" onclick="updateformtype()" value=""></a>
					<a style="margin-left:320px;" href="javascript:void(0)" onclick="addform()" >新建</a>
				</div>
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;" id="formlist"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_info">
						<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
							<a href="javascript:void(0)" onclick="updateform();" >保存</a> |
						</div>
						<table class="tablesolid" style="width:100%">
							<tr>
								<td class="header" style="width:80px;">名称</td>
								<td style="width:160px;"><input id="bf_name" style="width:120px;"/><span class="must">*</span></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input type="text" id="bf_sort" value="0" style="width:50px;" /></td>
							</tr>
							<tr>
								<td class="header">创建人</td>
								<td><input id="bf_user" disabled="true" /></td>
								<td class="header">创建日</td>
								<td><input id="bf_date" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header">最近更新人</td>
								<td><input id="bf_edituser" disabled="true" /></td>
								<td class="header">最近更新日</td>
								<td><input id="bf_editdate" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3"><textarea id="bf_remark" ></textarea></td>
							</tr>
						</table>
					</div>
					
					<div id="pad_db">
						
					</div>
					
					<div id="pad_list">
						<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
							<a href="javascript:void(0)" onclick="viewlisthtml();" >预览</a> |
							<a href="javascript:void(0)" onclick="updatelisthtml();" >保存</a> |
						</div>
						<textarea id="bf_listhtml" name="bf_listhtml" style="width:99%;height:300px;"></textarea>
					</div>
					
					<div id="pad_form">
						<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
							<a href="javascript:void(0)" onclick="updateformhtml();" >保存</a> |
						</div>
						<textarea id="bf_formhtml" name="bf_formhtml" style="width:99%;height:800px;"></textarea>
					</div>
				</div>
				
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
<script type="text/javascript" src="js/businessform_manage.js"></script>


<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
