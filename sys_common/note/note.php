<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>日记便签</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>

<div class="list_top_bar">
	<div class="list_top_title">日记便签</div>
	<div class="list_top_tools">
		<a class="item" href="javascript:void(0)" onclick="addnote();" ><img src="/images/sys_icon/add.png" /> 新建我的便签</a>
		<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
	</div>
</div>

<div id="tabbar"></div>
<div class="list_top_bar">
	<div class="list_top_title"></div>
	<div class="list_top_tools">
		<select id="tran_search" style="float:left;">
			<option value="">全部</option>
		</select>
		<select id="fld_search" style="float:left;">
		</select>
		<input id="key_search" style="float:left;height:20px;" />
		<a class="item" style="float:left;" href="javascript:void(0)" onclick="clearkey()">清空</a>
		<a class="item" style="float:left;" href="javascript:void(0)" onclick="searchkey()"><img src="/images/sys_icon/search.png" />搜索</a>
	</div>
</div>

<table id="note_list" style="width:100%;">
	<tbody name="head">
		<tr>
			<td style="width:30px;">序</td>
			<td>客户名称</td>
			<td style="width:120px;">类型</td>
			<td style="width:80px;">负责人</td>
			<td style="width:80px;">手机</td>
			<td style="width:80px;">电话</td>
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
			<td>{tools}</td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="7">
				共<span id="note_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
				共<span id="note_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
				当前在第<span id="note_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页　&nbsp; 
				<span id="note_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
			</td>
		</tr>
	</tbody>
</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/note.js"></script>

