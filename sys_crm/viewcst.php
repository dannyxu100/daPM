<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>客户信息</TITLE>
	<link rel="stylesheet" href="/css/base.css">
</HEAD>
<BODY>
<div>
	<div class="list_top_bar">
		<div class="list_top_title">客户信息</div>
		<div class="list_top_tools" style="float:left;">
			<a class="item" href="javascript:void(0)" onclick="iframeBack();" ><img src="/images/sys_icon/arrow_back.png" /> 返回</a>
		</div>
		<div class="list_top_tools">
			<!--<a class="item" href="javascript:void(0)" onclick="savecst();" ><img src="/images/sys_icon/save.png" /> 保存</a>-->
		</div>
	</div>
	
	<table id="cst_form" class="grid" style="width:100%;display:none;">
		<tr>
			<td colspan="6" class="classheader">基本信息</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">客户名称:</td>
			<td colspan="5">{c_name}</td>
		</tr>
		<tr>
			<td class="header">详细地址:</td>
			<td colspan="5">{c_addr}</td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">客户性质</td>
		</tr>
		<tr>
			<td class="header" style="width:80px;">客户来源:</td>
			<td style="width:160px;">{c_source}</td>
			<td class="header" style="width:80px;">客户类型:</td>
			<td style="width:160px;">{c_type}</td>
			<td class="header" style="width:80px;">客户级别:</td>
			<td>{c_level}</td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">联系方式</td>
		</tr>
		<tr>
			<td class="header">负责人:</td>
			<td>{c_user}</td>
			<td class="header">电话:</td>
			<td>{c_telephone}</td>
			<td class="header">手机:</td>
			<td>{c_phone}</td>
		</tr>
		<tr>
			<td class="header">Q Q:</td>
			<td>{c_qq}</td>
			<td class="header">电子邮件:</td>
			<td>{c_email}</td>
			<td class="header">传真:</td>
			<td>{c_fax}</td>
		</tr>
		<tr>
			<td class="header">企业网址:</td>
			<td colspan="5"><a href="{c_website}" target="_blank">{c_website}</a></td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">其他</td>
		</tr>
		<tr>
			<td class="header">行业:</td>
			<td colspan="5">{c_trade}</td>
		</tr>
		<tr>
			<td class="header">备注:</td>
			<td colspan="5">{c_remark}</td>
		</tr>
		<tr>
			<td colspan="6" class="classheader">记录信息</td>
		</tr>
		<tr>
			<td class="header">录入日期:</td>
			<td>{c_createdate}</td>
			<td class="header">录入人:</td>
			<td colspan="3">{c_createpuname}</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/viewcst.js"></script>

