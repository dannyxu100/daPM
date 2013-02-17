<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>人员管理</TITLE>
	<link rel="stylesheet" href="/css/base.css">
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css">
 
	<style type="text/css">
		.ztree li span.button.add {
			margin-left:2px;
			margin-right: -1px;
			background-position:-144px 0;
			vertical-align:top;
			*vertical-align:middle
		}
		
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}		
		.righttitle {height:30px; line-height:30px; padding:0px 5px;border-bottom:1px solid #f0f0f0;}
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#po_remark{width:400px; height:120px;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="righttitle">权限类型信息列表
	<a style="margin-left:320px;" href="javascript:void(0)" onclick="addpowertype();" >新建</a> | 
	<a href="javascript:void(0)" >删除</a> | 
	</div>
	

	<table id="tb_list" style="width:500px;">
		<tbody name="head">
			<tr>
				<td style="width:20px;">序</td>
				<td style="width:50px;">名称</td>
				<td style="width:80px;">代码</td>
				<td style="width:50px;">排序</td>
				<td>备注</td>
			</tr>
		</tbody>
		<tbody name="body" style="display:none">
			<tr value="{pt_id}">
				<td name="order">{order}</td>
				<td name="pt_name" >{pt_name}</td>
				<td name="pt_code" >{pt_code}</td>
				<td name="pt_sort" >{pt_sort}</td>
				<td name="pt_remark">{pt_remark}</td>
			</tr>
		</tbody>
		<tbody name="foot">
			<tr>
				<td  colspan="5" name="sum_order">
					共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
					共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
					当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
					<span id="tb_list_pageinfo">&nbsp;</span>
				</td>
			</tr>
		</tbody>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>

<script type="text/javascript" src="js/powertype_manage.js"></script>

