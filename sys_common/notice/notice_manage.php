<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>通知公告管理</TITLE>
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
		.topheader {height:30px; line-height:30px; padding:0px 15px; font-weight:bold; border-bottom:1px solid #ccc; background:#f0f0f0;}
	</style>
 </HEAD>
<BODY>
<div>
	<div class="topheader">通知公告管理</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;"><ul id="treenoticetype" class="ztree"></ul></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_type">
						<div class="list_top_bar">
							<div class="list_top_title">基本信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updatenoticetype();" ><img src="/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						
						<table class="tablesolid" style="width:;">
							<tr>
								<td class="header" style="width:60px;">名称</td>
								<td><input id="nt_name" style="width:200px;" /><input id="nt_id" type="hidden"/></td>
								<td class="header" style="width:80px;">排序</td>
								<td><input id="nt_sort"/></td>
							</tr>
							<tr>
								<td class="header">编码</td>
								<td colspan="3"><input id="nt_code" style="width:200px;"/></td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3">
									<textarea id="nt_remark" name="nt_remark" style="width:500px; height:150px;" ></textarea>
								</td>
							</tr>
						</table>
					</div>
					
					
					<div id="pad_list">
						<div class="list_top_bar">
							<div class="list_top_title">列表信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addnotice();" ><img src="/images/sys_icon/add.png" /> 添加</a>
							</div>
						</div>
						
						<table id="tb_list" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="width:20px;">序</td>
									<td style="width:200px;">标题</td>
									<td style="width:50px;">排序</td>
									<td>摘要</td>
									<td style="width:80px">&nbsp;</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{n_id}">
									<td name="order">{order}</td>
									<td name="n_title" >{n_title}</td>
									<td name="n_sort" >{n_sort}</td>
									<td name="n_abstract" >{n_abstract}</td>
									<td name="n_remark">{tools}</td>
								</tr>
							</tbody>
							<tbody name="foot">
								<tr>
									<td colspan="5">
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
<script type="text/javascript" src="js/notice_manage.js"></script>
