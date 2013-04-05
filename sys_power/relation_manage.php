<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
  <TITLE>上下属管理</TITLE>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/ztree/zTreeStyle.css" type="text/css"/>
	<link rel="stylesheet" href="/css/jquery-ui-1.9.2.custom.min.css"/>
 
	<style type="text/css">
		.ztree li span.button.add {
			margin-left:2px;
			margin-right: -1px;
			background-position:-144px 0;
			vertical-align:top;
			*vertical-align:middle
		}
		
		.header {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}		
		.righttitle {height:30px; line-height:30px; padding:0px 15px;border-bottom:1px solid #f0f0f0;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">上下属管理</div>

	<table class="tablesolid" style="width:100%">
		<tr>
			<td style="width:250px;vertical-align:top;"><ul id="orgtree" class="ztree"></ul></td>
			<td style="width:180px;vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">上级列表</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="addleader();" ><img src="/images/sys_icon/add.png" /> 添加</a>
					</div>
				</div>
				<div id="leaderlist"></div>
			</td>
			<td style="width:300px;vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title">从属列表</div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="adduser();" ><img src="/images/sys_icon/add.png" /> 添加</a>
						<a class="item" href="javascript:void(0)" onclick="deleteuser();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
					</div>
				</div>
				<div id="userlist">
					<table id="tbuser_list" style="width:100%;">
						<tbody name="head">
							<tr>
								<td style="width:20px;">序</td>
								<td style="width:50px;">名称</td>
								<td style="width:80px;">手机</td>
							</tr>
						</tbody>
						<tbody name="body" style="display:none">
							<tr value="{pu_id}">
								<td name="order">{order}</td>
								<td name="pu_name" >{pu_name}</td>
								<td name="pu_phone" >{pu_phone}</td>
							</tr>
						</tbody>
						<tbody name="foot">
							<tr>
								<td  colspan="3" name="sum_order">
									共<span id="tbuser_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
									共<span id="tbuser_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
									当前在第<span id="tbuser_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
									<span id="tbuser_list_pageinfo">&nbsp;</span>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</td>
			<td style="vertical-align:top;">&nbsp;</td>
		</tr>
	</table>
	
</div>
</BODY>
</HTML>


<script type="text/javascript" src="/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.core-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.exedit-3.5.min.js"></script>
<script type="text/javascript" src="/plugin/ztree/jquery.ztree.excheck-3.5.min.js"></script>
<script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="/js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/relation_manage.js"></script>

