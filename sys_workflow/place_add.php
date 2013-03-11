<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	
	s<TITLE>添加工作流库所</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
	<div style="height:30px;line-height:30px; border-bottom:#999; text-align:right; padding:0px 20px;">
		<a href="javascript:void(0)" onclick="saveplace();" >保存</a> |
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px;">名称</td>
			<td><input id="p_name" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="p_sort" value="0" /></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">类型</td>
			<td>
				<select id="p_type" disabled="true">
					<option value="1">起点库所</option>
					<option value="50" selected="true">过程库所</option>
					<option value="999">终止库所</option>
				</select>
				<div>1.未开放</div>
				<div>2.起点、终点库所会在新建流程时，系统自动创建</div>
			</td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea style="width:200px; height:100px;" id="p_remark" ></textarea></td>
		</tr>
	</table>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/place_add.js"></script>

