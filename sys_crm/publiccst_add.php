<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>添加公海客户</TITLE>
	<link rel="stylesheet" href="/css/base.css">
</HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">新建公海客户</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<a class="item" href="javascript:void(0)" onclick="savecst();" ><img src="/images/sys_icon/save.png" /> 保存</a>
		</div>
	</div>
	
	<table id="cst_form" class="grid" style="width:100%">
		<tr>
			<td colspan="6" class="classheader">基本信息</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">客户名称</td>
			<td colspan="5"><input id="c_name" type="text" style="width:650px;" valid="anything,false" validinfo="不能为空"/></td>
		</tr>
		<tr>
			<td class="header">详细地址</td>
			<td colspan="5"><input id="c_addr" type="text" style="width:650px;" /></td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">客户性质</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">客户来源</td>
			<td style="width:160px;"><select id="c_source" ></select></td>
			<td class="header" style="width:80px;">客户类型</td>
			<td style="width:160px;"><select id="c_type" ></select></td>
			<td class="header" style="width:80px;">客户级别</td>
			<td><select id="c_level" ></select></td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">联系方式</td>
		</tr>
		<tr>
			<td class="header">负责人</td>
			<td><input id="c_user" type="text" valid="anything,false" validinfo="不能为空"/></td>
			<td class="header">电话</td>
			<td><input id="c_telephone" type="text" valid="phone,false" validinfo="格式不正确"/></td>
			<td class="header">手机</td>
			<td><input id="c_phone" type="text" valid="mobile,true" validinfo="格式不正确"/></td>
		</tr>
		<tr>
			<td class="header">Q Q</td>
			<td><input id="c_qq" type="text" valid="int,true" validinfo="格式不正确"/></td>
			<td class="header">电子邮件</td>
			<td><input id="c_email" type="text" valid="email,true" validinfo="格式不正确"/></td>
			<td class="header">传真</td>
			<td><input id="c_fax" type="text" /></td>
		</tr>
		<tr>
			<td class="header">企业网址</td>
			<td colspan="5"><input id="c_website" type="text" style="width:650px;" valid="http,true" validinfo="格式不正确"/></td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">其他</td>
		</tr>
		<tr>
			<td class="header">行业</td>
			<td colspan="5"><select id="c_trade" ></select></td>
		</tr>
		<tr>
			<td class="header">备注</td>
			<td colspan="5"><textarea id="c_remark" style="width:650px; height:100px;" ></textarea></td>
		</tr>
		<tr>
			<td class="header">录入日期</td>
			<td colspan="5"><span id="c_createdate"></span></td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/publiccst_add.js"></script>

