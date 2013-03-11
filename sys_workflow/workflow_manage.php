<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	
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
						<a class="item" href="javascript:void(0)" onclick="addworkflow();" ><img src="/sys_power/images/sys_icon/add.png" /> 新建</a>
					</div>
				</div>
				
			</td>
		</tr>
		<tr>
			<td style="vertical-align:top;" id="workflowlist"></td>
		</tr>
		<tr>
			<td style="vertical-align:top;">
				<div id="pad_config">
					<div id="tabbar"></div>
					
					<div id="pad_workflow">
						<div class="list_top_bar">
							<div class="list_top_title">基本信息</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="updateworkflow();" ><img src="/sys_power/images/sys_icon/save.png" /> 保存</a>
							</div>
						</div>
						
						<table class="tablesolid" style="width:100%">
							<tr>
								<td class="header" style="width:60px;">名称</td>
								<td><input id="wf_name" style="width:200px;" /><span class="must">*</span></td>
								<td class="header" style="width:80px;">主表单</td>
								<td>
									<input id="wf_btname" disabled="true"/>
									<input id="wf_btid" type="hidden" disabled="true"/>
									<a href="javascript:void(0)" onclick="selectmainform()">选择</a>
								</td>
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
					
					<!--
					<div id="pad_map">
						<div></div>
						<div><img id=""/></div>
					</div>
					-->
					
					<div id="pad_placelist">
						<div class="list_top_bar">
							<div class="list_top_title">库所列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addplace();" ><img src="/sys_power/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deleteu2r();" ><img src="/sys_power/images/sys_icon/delete.png" /> 删除</a>
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
									<td name="order">{order}</td>
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
								<a class="item" href="javascript:void(0)" onclick="addtran();" ><img src="/sys_power/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deleteg2r();" ><img src="/sys_power/images/sys_icon/delete.png" /> 删除</a>
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
									<td>表单</td>
								</tr>
							</tbody>
							<tbody name="body" style="display:none">
								<tr value="{t_id}" title="{t_remark}">
									<td style="text-align:center;"><input type="checkbox" name="chkitem_tran" value="{t_id}" /></td>
									<td name="order">{order}</td>
									<td name="t_name" >{t_name}</td>
									<td name="t_sort" >{t_sort}</td>
									<td name="t_type" >{t_type}</td>
									<td name="t_limit" >{t_limit}</td>
									<td name="t_firetaskid" >{t_firetaskid}</td>
									<td name="t_rolename" >{t_rolename}</td>
									<td name="t_formname" >{t_formname}</td>
								</tr>
							</tbody>
							<tbody name="foot">
								<tr>
									<td  colspan="9" name="sum_order">
										共<span id="tb_tranlist_recordcount2" style="color:#c26220;">0</span>&nbsp;条，
										共<span id="tb_tranlist_pagecount2" style="color:#c26220">0</span>&nbsp;页，
										当前在第<span id="tb_tranlist_pageindex2" style="color:#c26220">0</span>&nbsp;页　
										<span id="tb_tranlist_pageinfo">&nbsp;</span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					
					<div id="pad_arclist">
						<div class="list_top_bar">
							<div class="list_top_title">路由向弧列表</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="addarc();" ><img src="/sys_power/images/sys_icon/add.png" /> 添加</a>
								<a class="item" href="javascript:void(0)" onclick="deleteg2r();" ><img src="/sys_power/images/sys_icon/delete.png" /> 删除</a>
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
									<td style="text-align:center;"><input type="checkbox" name="chkitem" value="{a_id}" /></td>
									<td name="order">{order}</td>
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
<script type="text/javascript" src="js/workflow_manage.js"></script>

<script charset="utf-8" src="/plugin/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/plugin/kindeditor/lang/zh_CN.js"></script>
