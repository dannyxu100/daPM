<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加工作流</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
	<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
		<a href="javascript:void(0)" onclick="saveworkflow();" >保存</a> |
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px;">名称</td>
			<td><input id="wf_name" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="wf_sort" value="0" /></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">启用</td>
			<td>
				<label><input name="wf_isrun" type="radio" value="1"/>是</label>
				<label><input name="wf_isrun" type="radio" checked="true" value="0"/>否</label>
			</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">启动任务</td>
			<td><input id="wf_starttaskid" disabled="true"/>(未开放)</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">创建人</td>
			<td><input id="wf_user" disabled="true" /></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">创建日</td>
			<td><input id="wf_date" disabled="true" /></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">最近更新人</td>
			<td><input id="wf_edituser" disabled="true" /></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">最近更新日</td>
			<td><input id="wf_editdate" disabled="true" /></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea style="width:200px; height:100px;" id="wf_remark" ></textarea></td>
		</tr>
	</table>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/workflow_add.js"></script>

