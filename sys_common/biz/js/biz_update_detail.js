var g_wfid = "",	//工作流id
	g_wfcid = "",	//工作流实例id
	g_btid = "",	//业务单模板id
	g_bcid = "",	//业务单实例id
	g_dbsource = "",	//数据源名称
	g_dbfld = "",		//数据源主键名称
	g_dbfldid = "";		//数据源主键id


/**提交业务流程
*/
function submitworkflow(){
	daWin({
		width: 500,
		height: 300,
		url: "/sys_common/biz/plugin/submit_workflow.php?wfid="+ g_wfid +"&wfcid="+ g_wfcid,
		back: function(){
			
		}
	});
}

/**创建业务
*/
function savebiz(){
	//goto("");
	for(var id in g_editors){		//同步在线编辑器的内容
		g_editors[ id ].sync();
	}
	
	if( !daValid.all() ) return;
	
	var data = {
		dataType: "json",
		wfid: g_wfid,
		btid: g_btid,
		dbsource: g_dbsource
	};

	da("input,textarea", "#templet_form").each(function(idx, obj){
		data[obj.id] = encodeURIComponent(da(obj).val());
	});
	
	da.runDB("/sys_common/biz/action/biz_update_item.php", data, 
	function(res){
		// debugger;
		if("FALSE" != res ){
			alert("保存成功。");
			// iframeBack();
		}
		else{
			alert("操作失败。");
		}
	},function(res, msg, ex){		//错误信息
		// debugger;
	});
}


/**加载表单数据
*/
function loaddata(){
	if( "" == g_dbsource || "" == g_dbfld ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}
	
	da.runDB("/sys_common/biz/action/dbsource_get_item.php", {
		dataType: "json",
		dbsource: g_dbsource,
		dbfld: g_dbfld,
		dbfldid: g_dbfldid
		
	},function(data){
		if( "FALSE" != data ){
			var daObj;
			for(var key in data){
				if( g_editors[key] ){	//如果是在线编辑器内容
					g_editors[key].html(data[key]);
				}
				da("#"+key).val(data[key]);
			}
		}
		
		autoframeheight();
	});
}

var g_editors = {};
/**初始化表单控件
*/
function init(){
	da("input[source],textarea[source]").each(function(idx, tag){
		var daObj = da(tag);
		var source = daObj.attr("source");

		switch( source ){
			case "date":
				daDate({
					target: tag, 
					// showFootBar: true,
					selectTime: true
				});
				break;
			case "user":
				daObj.bind("click",function(){
					daWin({
						width: 600,
						height: 500,
						isover: true,
						url: "/sys_power/plugin/select_user.htm",
						back: function( data ){
							for(var k in data){
								daObj.val(data[k].pu_name);
							}
						}
					});
				});
				break;
			case "editorbox":
				var g_editor;
				
				g_editor = KindEditor.create("#"+tag.id, {
					resizeType : 1,
					// filterMode : false,		//不过滤危险标签
					newlineTag: "br",
					allowPreviewEmoticons : false,
					fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
					allowFileManager : true,
					items : [
						'source', '|', 'undo', 'redo', '|', 'preview', 'print', 'template', 'code', 'cut', 'copy', 'paste',
						'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
						'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
						'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
						'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
						'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'multiimage',
						'flash', 'media', 'insertfile', 'table', 'hr', 'emoticons', 'baidumap', 'pagebreak',
						'anchor', 'link', 'unlink', '|'
					]
				});
				
				g_editors[ tag.id ]=g_editor;		//保存线编辑器对象（保存表单前需要同步内容）
				
				break;
		}
	});
}

/**加载工作流对应 表单列表页模板
*/
function loadtemplet(){
	if( "" == g_btid || 0 == g_btid ){
		// alert("对不起，找不到该表单模板。");
		return;
	}
	
	da.runDB("/sys_bizform/action/biztemplet_get_item.php",{
		dataType: "json",
		bt_id: g_btid
		
	},function(data){
		if("FALSE" != data ){
			g_dbsource = data[0].bt_dbsource;
			g_dbfld = data[0].bt_dbfld;
			
			var formObj = da("#templet_form");
			formObj.append( data[0].bt_formhtml );
			
			init();
			autoframeheight();
			loaddata();
		}
	});
}


daLoader("daMsg,daValid,daDate,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_bcid = arrparam["bcid"];
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		g_dbfldid = arrparam["dbfldid"];
		
		loadtemplet();
	});
});
