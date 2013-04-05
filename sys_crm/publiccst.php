<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>公海客户</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>

<div class="list_top_bar">
	<div class="list_top_title">公海客户</div>
	<div class="list_top_tools">
		<a class="item" href="javascript:void(0)" onclick="addpubliccst();" ><img src="/images/sys_icon/add.png" /> 新建</a>
		<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
	</div>
</div>
<table id="cst_list" style="width:100%;">
	<tbody name="head">
		<tr>
			<td style="width:30px;">序</td>
			<td>客户名称</td>
			<td style="width:120px;">类型</td>
			<td style="width:80px;">负责人</td>
			<td style="width:80px;">手机</td>
			<td style="width:80px;">电话</td>
			<td style="width:80px;">录入人</td>
			<td style="width:100px;">&nbsp;</td>
		</tr>
	</tbody>
	<tbody name="body" style="display:none">
		<tr>
			<td name="order">{order}</td>
			<td>{c_name}</td>
			<td>{c_type}</td>
			<td>{c_user}</td>
			<td>{c_phone}</td>
			<td>{c_telephone}</td>
			<td>{c_createpuname}</td>
			<td>{tools}</td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="8">
				共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
				共<span id="tb_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
				当前在第<span id="tb_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页　&nbsp; <span id="tb_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
			</td>
		</tr>
	</tbody>
</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/publiccst.js"></script>

