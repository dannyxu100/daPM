﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>工作流管理</TITLE>
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
	<div class="header">工作流管理</div>
	<table class="tablesolid" style="width:100%">
		<tr>
			<td rowspan="4" style="width:250px;vertical-align:top;"><ul id="treeDemo" class="ztree"></ul></td>
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
			<td style="vertical-align:top;" id="workflowlist"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config" style="display:none;">
					<div id="tabbar"></div>
					
					<div id="pad_workflow">
						<div class="list_top_bar">
							<div class="list_top_title">基本信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updateworkflow();" ><img src="/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						
						<table class="tablesolid" style="width:100%">
							<tr>
								<td class="header" style="width:60px;">名称</td>
								<td colspan="3"><input id="wf_name" style="width:200px;" /><span class="must">*</span></td>
							</tr>
							<tr>
								<td class="header">排序</td>
								<td style="width:250px;"><input type="text" id="wf_sort" value="0" style="width:50px;" /></td>
								<td class="header" style="width:80px;">启用</td>
								<td>
									<label><input name="wf_isrun" type="radio" value="1"/>是</label>
									<label><input name="wf_isrun" type="radio" checked="true" value="0"/>否</label>
								</td>
							</tr>
							<tr>
								<td class="header" style="width:60px;">图标</td>
								<td colspan="3">
									<img id="wf_icon" src="/uploads/userico/default.png" style="width:50px; height:50px;" title="点击上传" onclick="updateicon()" />
								</td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">启动任务</td>
								<td colspan="3"><input id="wf_starttaskid" disabled="true"/>(未开放)</td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">创建人</td>
								<td><input id="wf_user" disabled="true" /></td>
								<td class="header" style="width:80px;">创建日</td>
								<td><input id="wf_date" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header" style="width:80px;">最近更新人</td>
								<td><input id="wf_edituser" disabled="true" /></td>
								<td class="header" style="width:80px;">最近更新日</td>
								<td><input id="wf_editdate" disabled="true" /></td>
							</tr>
							<tr>
								<td class="header">备注</td>
								<td colspan="3">
									<textarea id="wf_remark" name="wf_remark" style="width:90%; height:500px;" ></textarea>
								</td>
							</tr>
						</table>
					</div>
					
					<div id="pad_power">
						<div class="list_top_bar">
							<div class="list_top_title"></div>
							<div class="list_top_tools">
							</div>
						</div>
						
						<table class="tablesolid" style="width:100%">
							<tr>
								<td class="header" style="width:60px;">主表单</td>
								<td>
									<input id="wf_btname" disabled="true"/>
									<input id="wf_btid" type="hidden" disabled="true"/>
									<a href="javascript:void(0)" onclick="selectmainform()">选择</a>
								</td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
							</tr>
							<tr>
								<td class="header">仅 看</td>
								<td>
									<span id="read_rolename" style="float:left; padding:2px; margin:2px; border:1px solid #ccc;"></span>
									<a href="javascript:void(0)" onclick="selectreadrole()">选择</a>
									<span style="color:#900; margin-left:10px;">(注：查看全部信息)</span>
								</td>
							</tr>
							<tr>
								<td class="header">新 建</td>
								<td>
									<div id="new_rolename" style="float:left;padding:2px; margin:2px; border:1px solid #ccc;"></div>
									<a href="javascript:void(0)" onclick="selectnewrole()">选择</a>
								</td>
							</tr>
							<tr>
								<td class="header">分 单</td>
								<td>
									<div id="assign_rolename" style="float:left;padding:2px; margin:2px; border:1px solid #ccc;"></div>
									<a href="javascript:void(0)" onclick="selectassignrole()">选择</a>
								</td>
							</tr>
							<tr>
								<td class="header">删 除</td>
								<td>
									<div id="del_rolename" style="float:left;padding:2px; margin:2px; border:1px solid #ccc;"></div>
									<a href="javascript:void(0)" onclick="selectdelrole()">选择</a>
								</td>
							</tr>
						</table>
					</div>
					
					<div id="pad_placelist">
						<div class="list_top_bar">
							<div class="list_top_title">库所列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addplace();" ><img src="/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deleteplace();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							</div>
						</div>
						
						<table id="tb_placelist" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
									<td style="width:20px;">序</td>
									<td style="width:200px;">名称</td>
									<td style="width:50px;">排序</td>
									<td style="width:80px;">类型</td>
									<td>备注</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{p_id}">
									<td style="text-align:center;">{checkbox}</td>
									<td name="order" title="{p_id}">{order}</td>
									<td name="p_name" >{p_name}</td>
									<td name="p_sort" >{p_sort}</td>
									<td name="p_type" >{p_type}</td>
									<td name="p_remark">{p_remark}</td>
								</tr>
								<!--
								<tr>
									<td colspan="7" name="order">{order}</td>
								</tr>
								-->
							</tbody>
							<tbody name="foot">
								<tr>
									<td  colspan="6" name="sum_order">
										共<span id="tb_placelist_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
										共<span id="tb_placelist_pagecount2" style="color:#c26220">0</span>&nbsp;页，
										当前在第<span id="tb_placelist_pageindex2" style="color:#c26220">0</span>&nbsp;页　
										<span id="tb_placelist_pageinfo">&nbsp;</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					

					<div id="pad_tranlist">
						<div class="list_top_bar">
							<div class="list_top_title">事务变迁列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addtran();" ><img src="/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deletetran();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							</div>
						</div>
						
						<table id="tb_tranlist" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
									<td style="width:20px;">序</td>
									<td style="width:150px;">名称</td>
									<td style="width:50px;">排序</td>
									<td style="width:80px;">类型</td>
									<td style="width:60px;">时限</td>
									<td style="width:80px;">完毕任务</td>
									<td>执行角色</td>
									<td style="width:50px;">可编辑</td>
									<td>附表单</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{t_id}">
									<td style="text-align:center;"><input type="checkbox" name="chkitem_tran" value="{t_id}" /></td>
									<td name="order" title="{t_id}">{order}</td>
									<td name="t_name" title="{t_id}">{t_name}</td>
									<td name="t_sort" >{t_sort}</td>
									<td name="t_type" >{t_type}</td>
									<td name="t_limit" >{t_limit}</td>
									<td name="t_firetaskid" >{t_firetaskid}</td>
									<td name="t_rolename" >{t_rolename}</td>
									<td name="limitedit" ><img style="margin-left:10px; vertical-align:middle;" src="/images/sys_icon/down.png" onclick="viewlimitedit(this,{t_id})" /></td>
									<td name="t_formname" >{t_formname}</td>
								</tr>
								<tr name="limiteditpad" style="display:none;background-color:#444;">
									<td colspan="6" style="border-right:0px;">
										&nbsp;
									</td>
									<td colspan="3" style="padding:0px;padding-bottom:10px;border-right:0px;">
										<div name="limiteditlist" value="{t_id}" >未设置</div>
									</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
							<tbody name="foot">
								<tr>
									<td  colspan="10" name="sum_order">
										共<span id="tb_tranlist_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
										共<span id="tb_tranlist_pagecount2" style="color:#c26220">0</span>&nbsp;页，
										当前在第<span id="tb_tranlist_pageindex2" style="color:#c26220">0</span>&nbsp;页　
										<span id="tb_tranlist_pageinfo">&nbsp;</span>
									</td>
								</tr>
							</tbody>
						</table>
						<div style="display:none;">
							<table id="tb_limiteditlist" style="width:100%;background:#fff;">
								<tbody name="head">
									<tr>
										<td style="width:20px;">序</td>
										<td>可编辑项</td>
										<td style="width:120px;">编码</td>
										<td style="width:50px;">&nbsp;</td>
									</tr>
								</tbody>
								<tbody name="body" style="display:none">
									<tr>
										<td name="order">{order}</td>
										<td name="COLUMN_COMMENT" >{COLUMN_COMMENT}</td>
										<td name="COLUMN_NAME" >{COLUMN_NAME}</td>
										<td ><input type="checkbox" name="chklimitedit" field="{COLUMN_NAME}" onclick="selectlimitedit(this)" /></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					
					<div id="pad_arclist">
						<div class="list_top_bar">
							<div class="list_top_title">路由向弧列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addarc();" ><img src="/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deletearc();" ><img src="/images/sys_icon/delete.png" /> 删除</a>
							</div>
						</div>
						
						<table id="tb_arclist" style="width:100%;">
							<tbody name="head">
								<tr>
									<td style="text-align:center; width:20px;"><input type="checkbox" /></td>
									<td style="width:20px;">序</td>
									<td style="width:100px;">名称</td>
									<td style="width:150px;">库所名称</td>
									<td style="width:40px;">方向</td>
									<td style="width:150px;">变迁名称</td>
									<td style="width:50px;">排序</td>
									<td style="width:100px;">类型</td>
									<td>表达式</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{a_id}">
									<td style="text-align:center;"><input type="checkbox" name="chkitem_arc" value="{a_id}" /></td>
									<td name="order" title="{a_id}">{order}</td>
									<td name="a_name" style="font-weight:bold;" >{a_name}</td>
									<td name="p_name" >{p_name}</td>
									<td name="a_direction" >{a_direction}</td>
									<td name="t_name" >{t_name}</td>
									<td name="a_sort" >{a_sort}</td>
									<td name="a_type" >{a_type}</td>
									<td name="a_precondition" >{a_precondition}</td>
								</tr>
								<!--
								<tr>
									<td colspan="7" name="order">{order}</td>
								</tr>
								-->
							</tbody>
							<tbody name="foot">
								<tr>
									<td  colspan="9" name="sum_order">
										共<span id="tb_arclist_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
										共<span id="tb_arclist_pagecount2" style="color:#c26220">0</span>&nbsp;页，
										当前在第<span id="tb_arclist_pageindex2" style="color:#c26220">0</span>&nbsp;页　
										<span id="tb_arclist_pageinfo">&nbsp;</span>
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
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="js/workflow_manage.js"></script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
