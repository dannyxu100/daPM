<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>系统常量可选项管理</TITLE>
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
		.tableform>tbody>tr>td{padding:3px; vertical-align:top;}
		
		#tabbar{padding-top:5px;}
		
	</style>
 </HEAD>
<BODY>
<div>
	<div class="header">帮助文档管理</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;"><ul id="treehelpertype" class="ztree"></ul></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div class="list_top_bar">
					<div class="list_top_title"><a id="wft_title" href="javascript:void(0)" onclick="updateworkflowtype()" value=""></a></div>
					<div class="list_top_tools">
						<a class="item" href="javascript:void(0)" onclick="addworkflow();" ><img src="/images/sys_icon/add.png" /> 新建</a>
					</div>
				</div>
				
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_type">
						<div class="list_top_bar">
							<div class="list_top_title">基本信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updatehelpertype();" ><img src="/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						
						<table class="tablesolid" style="width:;">
							<tr>
								<td class="header" style="width:60px;">名称</td>
								<td><input id="ht_name" style="width:200px;" /><input id="ht_id" type="hidden"/></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input id="ht_sort"/></td>
							</tr>
							<tr>
								<td class="header">编码</td>
								<td colspan="3"><input id="ht_code" style="width:200px;"/></td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3">
									<textarea id="ht_remark" name="ht_remark" style="width:500px; height:150px;" ></textarea>
								</td>
							</tr>
						</table>
					</div>
					
					
					<div id="pad_list">
						<div class="list_top_bar">
							<div class="list_top_title">列表信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addhelper();" ><img src="/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deletehelper();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							</div>
						</div>
						
						<table id="tb_list" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
									<td style="width:20px;">序</td>
									<td style="width:200px;">名称</td>
									<td style="width:100px;">选项值</td>
									<td style="width:50px;">排序</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{p_id}">
									<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{h_id}" /></td>
									<td name="order">{order}</td>
									<td name="h_name" >{h_name}</td>
									<td name="h_code" >{h_code}</td>
									<td name="h_sort" >{h_sort}</td>
									<td name="tools">{tools}</td>
								</tr>
							</tbody>
							<tbody name="foot">
								<tr>
									<td colspan="6">
										共<span id="tb_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
										共<span id="tb_list_pagecount2" style="color:#c26220">0</span>&nbsp;页，
										当前在第<span id="tb_list_pageindex2" style="color:#c26220">0</span>&nbsp;页　
										<span id="tb_list_pageinfo">&nbsp;</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</td>
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
<script type="text/javascript" src="js/helper_manage.js"></script>
