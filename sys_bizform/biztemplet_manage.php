<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
		
		#bt_remark{width:400px; height:120px;}
		#tabbar{padding-top:5px;}
		
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
								<td style="width:160px;"><input id="bt_name" style="width:120px;"/><span class="must">*</span></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input type="text" id="bt_sort" value="0" style="width:50px;" /></td>
							</tr>
							<tr>
								<td class="header">创建人</td>
								<td><input id="bt_user" disabled="true" /></td>
								<td class="header">创建日</td>
								<td><input id="bt_date" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header">最近更新人</td>
								<td><input id="bt_edituser" disabled="true" /></td>
								<td class="header">最近更新日</td>
								<td><input id="bt_editdate" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3"><textarea id="bt_remark" ></textarea></td>
							</tr>
						</table>
					</div>
					
					<div id="pad_db" style="display:none;">
						<div class="list_top_bar">
							<div class="list_top_title"></div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updatesource();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						<div style="padding:20px;">
							数据源: 
							<select id="bt_dbsource" style="width:150px; margin-right:20px;" onchange="loaddbfld()">
								<option value="">空</option>
							</select>
							关联字段:  
							<select id="bt_dbfld" style="width:150px;">
								<option value="">空</option>
							</select> <span style="color:#f00;">(一般选择主键)</span>
						</div>
					</div>
					
					<div id="pad_list" style="display:none;">
						<div class="list_top_bar">
							<div class="list_top_title"></div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="viewlisthtml();" ><img src="/sys_power/images/sys_icon/search.png" /> 预览</a>
								<a class="item" href="javascript:void(0)" onclick="updatelisthtml();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						<textarea id="bt_listhtml" name="bt_listhtml" style="width:99%;height:300px;"></textarea>
					</div>
					
					<div id="pad_form" style="display:none;">
						<div class="list_top_bar">
							<div class="list_top_title"></div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updateformhtml();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						<textarea id="bt_formhtml" name="bt_formhtml" style="width:99%;height:800px;"></textarea>
					</div>
				</div>
				
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/biztemplet_manage.js"></script>


