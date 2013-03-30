<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>修改工作流路由向弧</TITLE>
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
			<a class="item" href="javascript:void(0)" onclick="savearc();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td class="header" style="width:60px">名称</td>
			<td><input type="text" id="a_name" valid="account,false" validinfo="不能为空。" /> (提交流程可选项)</td>
		</tr>
		<tr>
			<td class="header">排序</td>
			<td><input type="text" id="a_sort" value="999" valid="int" validinfo="只能为数字。" /> (编号最好别紧贴,可以预留步骤位置)</td>
		</tr>
		<tr>
			<td class="header">向弧类型</td>
			<td>
				<select id="a_type">
					<option value="SEQ" selected="true">一般顺序流类型(SEQ)</option>
					<option value="Explicit Or Split">显示条件分支(Explicit Or Split)</option>
					<option value="Implicit Or Split">隐式条件分支(Implicit Or Split)</option>
					<option value="Or Join">条件汇聚(Or Join 包含了显示和隐式)</option>
					<option value="And Split">并行分支(And Split)</option>
					<option value="And Join">并行汇聚(And Join)</option>
				</select>（分支或汇聚类型）
			</td>
		</tr>
		<tr>
			<td class="header">向弧方向</td>
			<td>
				<label>
				<input type="radio" name="a_direction" value="IN" checked="true" />
					库所<img src="/images/to_right.jpg" />变迁
				</label>
				<br/>
				<label><input type="radio" name="a_direction" value="OUT" />
					库所<img src="/images/to_left.jpg" />变迁
				</label>
			</td>
		</tr>
		<tr>
			<td class="header">&nbsp;</td>
			<td>
				<span id="pad_place">库所：<select id="a_pid"></select></span>&nbsp;&nbsp;&nbsp;
				<span id="pad_tran">变迁：<select id="a_tid"></select></span>
			</td>
		</tr>
		<tr>
			<td class="header">表达式</td>
			<td>
				<textarea id="a_precondition" style="width:90%; height:120px;" ></textarea>
				<div>(只有当类型为 Explicit Or Split时有效，这个包含了我们知道的值只有true或false的guard表达式。)</div>
			</td>
		</tr>
	</table>
	
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/arc_update.js"></script>

