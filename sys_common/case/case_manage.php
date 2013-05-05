<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>案例管理</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	
 </HEAD>
<BODY>

<div class="list_top_bar">
	<div class="list_top_title">案例管理</div>
	<div class="list_top_tools">
		<a class="item" href="javascript:void(0)" onclick="addcase();" ><img src="/images/sys_icon/add.png" /> 新建案例</a>
		<!--<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>-->
	</div>
</div>

<div id="tabbar"></div>
<div class="list_top_bar">
	<div class="list_top_title"></div>
	<div class="list_top_tools">
		<input id="key_search" style="float:left;height:20px;" />
		<a class="item" style="float:left;" href="javascript:void(0)" onclick="clearkey()">清空</a>
		<a class="item" style="float:left;" href="javascript:void(0)" onclick="searchkey()"><img src="/images/sys_icon/search.png" />搜索</a>
	</div>
</div>

<table id="case_list" style="width:100%;">
	<tbody name="head">
		<tr>
			<td style="width:30px;">序</td>
			<td style="width:50px;">略缩图</td>
			<td style="width:200px;">标题</td>
			<td style="width:100px;">分类</td>
			<td>摘要</td>
			<td style="width:120px;">日期</td>
			<td style="width:50px;">排序</td>
			<td style="width:50px;">状态</td>
			<td style="width:100px;">&nbsp;</td>
		</tr>
	</tbody>
	<tbody name="body" style="display:none">
		<tr>
			<td name="order">{order}</td>
			<td><img src="{c_img}" style="width:40px; height:30px;"/></td>
			<td>{c_title}</td>
			<td>{c_type}</td>
			<td>{c_abstract}</td>
			<td fmt="yyyy-mm-dd hh:nn:ss/p">{c_date}</td>
			<td>{c_sort}</td>
			<td>{c_status}</td>
			<td>{tools}</td>
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="9">
				共<span id="case_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
				共<span id="case_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
				当前在第<span id="case_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页　&nbsp; 
				<span id="case_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
			</td>
		</tr>
	</tbody>
</table>
	
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/case_manage.js"></script>

