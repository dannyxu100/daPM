<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
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
		
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#po_remark{width:400px; height:120px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">人员管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="width:200px;vertical-align:top;"><ul id="orgtree" class="ztree"></ul></td>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">成员信息列表</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="adduser();" ><img src="/images/sys_icon/add.png" /> 新建</a>
						<a class="item" href="javascript:void(0)" ><img src="/images/sys_icon/delete.png" /> 删除</a>
					</div>
				</div>
				
				<table id="tb_list" style="width:100%;">
					<tbody name="head">
						<tr>
							<td style="width:20px;">序</td>
							<td style="width:50px;">名称</td>
							<td style="width:80px;">账号</td>
							<td style="width:80px;">手机</td>
							<td style="width:80px;">电话</td>
							<td>地址</td>
							<td style="width:80px;">最近登陆</td>
							<td style="width:80px;">登陆次数</td>
							<td style="width:100px;">备注</td>
						</tr>
					</tbody>
					<tbody name="body" style="display:none">
						<tr value="{pu_id}">
							<td name="order">{order}</td>
							<td name="pu_name" >{pu_name}</td>
							<td name="pu_code" >{pu_code}</td>
							<td name="pu_phone" >{pu_phone}</td>
							<td name="pu_telephone" >{pu_telephone}</td>
							<td name="pu_address" >{pu_address}</td>
							<td fmt="yyyy-mm-dd/p" edit="1">{pu_lastlogin}</td>
							<td name="pu_logincount" edit="1">{pu_logincount}</td>
							<td name="pu_remark" edit="1">{pu_remark}</td>
						</tr>
					</tbody>
					<tbody name="foot">
						<tr>
							<td  colspan="9" name="sum_order">
								共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
								共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
								当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
								<span id="tb_list_pageinfo">&nbsp;</span>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>

<script type="text/javascript" src="js/user_manage.js"></script>

