<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>数据库管理</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
 
	<style type="text/css">
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}		
		.righttitle {height:30px; line-height:30px; padding:0px 15px;border-bottom:1px solid #f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#bf_remark{width:400px; height:120px;}
		#tabbar{padding-top:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">数据库管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;"><ul id="dbtree" class="ztree"></ul></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title"><a id="wft_title" href="javascript:void(0)" onclick="updateformtype()" value=""></a></div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="addform();" ><img src="/sys_power/images/sys_icon/add.png" /> 新建</a>
					</div>
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
						<div class="list_top_bar">
							<div class="list_top_title"></div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updateform();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
							</div>
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
					
				</div>
				
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/db_manage.js"></script>
