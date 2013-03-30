<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加工作流事务变迁</TITLE>
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
			<a class="item" href="javascript:void(0)" onclick="savetran();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px;">名称</td>
			<td><input id="t_name" valid="account,false" validinfo="不能为空。"  /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="t_sort" value="999"  valid="int" validinfo="只能为数字。" />(编号最好别紧贴,可以预留步骤位置)</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">类型</td>
			<td>
				<select id="t_type">
					<option value="AUTO">自动触发</option>
					<option value="USER" selected="true">人工操作</option>
					<option value="TIME">限时触发</option>
					<option value="MSG">消息触发</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class="header">时限</td>
			<td><input id="t_limit" style="width:60px;"/> 个小时</td>
		</tr>
		<tr>
			<td class="header">完毕任务</td>
			<td><input id="t_firetaskid" disabled="true"/>(未开放)</td>
		</tr>
		<tr>
			<td class="header">权限角色</td>
			<td><input id="t_rolename" /><input type="hidden" id="t_roleid" /><input type="button" id="" value="选择" /></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea id="t_remark" style="width:200px; height:100px;" ></textarea></td>
		</tr>
	</table>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/tran_add.js"></script>

