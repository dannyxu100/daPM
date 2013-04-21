<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
  <TITLE>添加人员</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<style>
		td{padding:3px;}
		.must{color:#f00; font-weight:bold; padding-left:5px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title"></div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="saveuser();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table class="grid" style="width:100%">
		<tr>
			<td colspan="2" class="classheader" >账号信息</td>
		</tr>
		<tr>
			<td class="header" style="width:60px;">姓名</td>
			<td><input id="pu_name" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">账号</td>
			<td><input id="pu_code" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td class="header">初始密码</td>
			<td><input type="text" id="pu_pwd" value="666" /><span class="must">*</span></td>
		</tr>
		<tr>
			<td colspan="2" class="classheader" >权限信息</td>
		</tr>
		<tr>
			<td class="header">部门</td>
			<td>
				<input id="org_name" disabled="true" /><input type="hidden" id="pu_oid" />
				<input type="button" value="选择" onclick="selectorg()" />
			</td>
		</tr>
		<tr>
			<td class="header">角色</td>
			<td>
				<div id="roles">测试角色1、测试角色2、测试角色3</div>
				<input type="hidden" id="pu_rid" /><input type="button" value="选择" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="classheader">详细信息</td>
		</tr>
		<tr>
			<td class="header">手机</td>
			<td><input id="pu_phone" /></td>
		</tr>
		<tr>
			<td class="header">电话</td>
			<td><input id="pu_telephone" /></td>
		</tr>
		<tr>
			<td class="header">地址</td>
			<td><input id="pu_address" /></td>
		</tr>
		<tr>
			<td class="header">电子邮箱</td>
			<td><input id="pu_email" /></td>
		</tr>
		<tr>
			<td class="header">QQ</td>
			<td><input id="pu_qq" /></td>
		</tr>
		<tr>
			<td class="header">最后登陆</td>
			<td><input id="pu_lastlogin" /></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td><textarea style="width:200px; height:100px;" id="pu_remark" ></textarea></td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/user_add.js"></script>

