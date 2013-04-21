<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	<title>我的桌面</title>
	<link rel="stylesheet" href="/css/base.css" />
</head>

<body >
	<table style="width:100%;">
		<tr>
			<td style="width:770px; vertical-align:top;">
				<div id="shadowbox1" class="shadowbox">
					<div id="logbox">
						<div class="list_top_bar">
							<div class="list_top_title">最新日志</div>
							<div class="list_top_tools" style="float:left;">
								<select id="logtype" onchange="changelogtype()">
									<option value="0">全部</option>
									<option value="1">我的日志</option>
								</select>
							</div>
							<div class="list_top_tools">
								<a class="item" href="javascript:void(0)" onclick="refreshlog();" ><img src="/images/sys_icon/refresh.png" /> 刷新</a>
							</div>
						</div>
						<div id="logpad">
							<div id="listPad" style="padding:5px;"></div>
							<div id="loadingbar">
								<div id="loadingmsg">
									<img src="/images/loading.gif" style="vertical-align:middle;"/> 数据加载中...
								</div>
								<a href="javascript:void(0)" class="bt_menu" style="text-align:center;" onclick="loadloglist()">点击显示更多</a>
							</div>
						</div>
					</div>
					
					<div id="scrolltop2"></div>
				</div>
				
			</td>
			<td style="width:500px; vertical-align:top;">
				<div id="shadowbox2" class="shadowbox">
					<div class="list_top_bar">
						<div class="list_top_title">我的备忘录</div>
						<div id="righttools" class="list_top_tools">
							<a class="item" href="javascript:void(0)" onclick="addnote();" ><img src="/images/sys_icon/add.png" /> 新建便签</a>
						</div>
					</div>
					<div style="height:260px; overflow:hidden;">
						<table id="note_list" style="width:100%;">
							<!--<tbody name="head">
								<tr>
									<td>序</td>
									<td>标题</td>
									<td>便签本</td>
									<td>日期</td>
								</tr>
							</tbody>
							-->
							<tbody name="body" style="display:none">
								<tr>
									<td style="width:30px;">{order}</td>
									<td>{n_title}</td>
									<td style="width:100px;">{nt_name}</td>
									<td style="width:80px;" fmt="yyyy-mm-dd/p">{n_date}</td>
								</tr>
							</tbody>
							<tbody>
								<tr>
									<td colspan="4">
										共<span id="note_list_recordcount2" style="color:#c26220;">0</span>&nbsp;条， 
										共<span id="note_list_pagecount2" style="color:#c26220;">0</span>&nbsp;页， 
										当前在第<span id="note_list_pageindex2" style="color:#c26220;">0</span>&nbsp;页&nbsp;<span id="note_list_pageinfo" style="color:#c26220;">&nbsp;</span> 
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				
				<div id="shadowbox3" class="shadowbox">
					<div class="list_top_bar">
						<div class="list_top_title">通知公告</div>
						<div id="righttools" class="list_top_tools"></div>
					</div>
					<div id="notice_scrollpad">
						<ul id="noticelist"></ul>
					</div>
				</div>
			</td>
		</tr>
	</table>

	<div id="logtemplet" style="display:none;">
		<ul id="log_{l_id}" class="logitem" style="padding-left:10px" >
			<div class="ico" >
				<img src="{userico}"/>
				<div class="txt">{puname}</div>
			</div>
			<div class="pl" >
				<div class="pl_img"></div>
			</div>
			<div class="content daRadius">
				<span style="margin-right:20px; font-weight:bold; color:#666">({ws_cstname})</span>
				<span style="color:#aaa">{l_date}</span>
				<div style="margin-top:10px;">{l_content}</div>
				<div class="logtoolbar" >
					<a href="javascript:void(0);" onclick="viewlog('{bc_id}', '{ws_cstname}')">查看全部</a>
					<a href="javascript:void(0);" onclick="addreply('{l_bcid}','{l_id}')">留言</a>
				</div>
			</div>
			<div style="clear:both;"></div>
			<div id="reply_{l_id}" class="logreply" ></div>
		</ul>
	</div>
	<div id="replytemplet" style="display:none;">
		<ul class="item">
			<div class="ico" >
				<img src="{userico}"/>
				<div class="txt">{puname}</div>
			</div>
			<div class="pr">
				<div class="pr_img"></div>
			</div>
			<div class="content daRadius" >
				<div class="rdate">{r_date}</div>
				{r_content}
				<div class="replytoolbar" >
					<a href="javascript:void(0);" onclick="addreply('{r_bcid}','{r_lid}')">回复</a>
				</div>
			</div>
			<div style="clear:both;"></div>
		</ul>
	</div>
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="js/mydesk.js"></script>