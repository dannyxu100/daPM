<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <HEAD>
	<?php include_once rtrim($_SERVER['DOCUMENT_ROOT'],"/")."/action/logincheck.php";?>
	
	<TITLE>查看帮助文档</TITLE>
	<link rel="stylesheet" href="/css/base.css"/>
	<link rel="stylesheet" href="/plugin/prettify/prettify.css"/>
 
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
	<div class="doc_pad">
		<div class="doc_title" id="h_name"></div>
		<div class="doc_infobar">
			编码: <span id="h_code"></span> / 
			排序: <span id="h_sort"></span> / 
			撰写: <span id="h_editorname"></span> / 
			日期: <span id="h_editordate"></span>
		</div>
		<div id="h_content"></div>
	</div>
</div>
</BODY>
</HTML>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script type="text/javascript" src="/js/fn.js"></script>
<script type="text/javascript" src="/plugin/prettify/prettify.js"></script>
<script type="text/javascript" src="js/helper_view.js"></script>
