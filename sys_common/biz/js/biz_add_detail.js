var g_wfid = "",
	g_btid = "",
	g_dbsource = "";

	
/**创建业务
*/
function savebiz(){
	if( "" == g_dbsource ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}
	
	// g_editor.sync();
	
	if( !daValid.all() ) return;
	
	var data = {
		dataType: "json",
		wfid: g_wfid,
		btid: g_btid,
		dbsource: g_dbsource
	};

	da("input,textarea", "#templet_form").each(function(idx, obj){
		data[obj.id] = da(obj).val();
	});
	
	da.runDB("/sys_common/biz/action/biz_add_item.php", data, 
	function(res){
		// debugger;
		if("FALSE" != res ){
			alert("保存成功。");
			iframeBack();
		}
		else{
			alert("操作失败。");
		}
	},function(res, msg, ex){		//错误信息
		// debugger;
	});
}

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
			var formObj = da("#templet_form");
			formObj.append( data[0].bt_formhtml );
			g_dbsource = data[0].bt_dbsource;
			
			init();
		}
	});
}


daLoader("daMsg,daIframe,daWin,daValid,daDate",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_wfid = arrparam["wfid"];
		
		loadtemplet();
	});
});
