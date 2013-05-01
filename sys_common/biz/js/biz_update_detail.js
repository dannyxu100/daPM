var g_wfid = "",	//工作流id
	g_wfcid = "",	//工作流实例id
	g_tcid = "",	//当前事务变迁实例id
	g_tid = "",		//当前事务变迁id
	g_btid = "",	//业务单模板id
	g_bcid = "",	//业务单实例id
	g_dbsource = "",	//数据源名称
	g_dbfld = "",		//数据源主键名称
	g_dbfldid = "";		//数据源主键id

/**上传附件
*/
function uploadattach(){
	if( !g_btid || !g_bcid ){
		alert("未传入表单编号");
		return;
	}
	
	var folder = "/uploads/attach/biztemplet_"+ g_btid +"/"+ g_bcid;
	
	fn_uploadfile("可上传文件格式：txt, rar, zip, doc(docx), xls(xlsx)", {
        "fileTypeDesc": "附件文件",
		"multi": true,
		"fileTypeExts": "*.txt; *.rar; *.zip; *.doc; *.docx; *.xls; *.xlsx",
		"formData": {
			"folder": folder
		}
	},function(files){
		var arrname=[], arrurl = [];
		for( var k in files ){
			arrname.push( files[k].name );
			arrurl.push( folder +"/"+ files[k].name );
			
			delete files[k];
		}
		
		if( 0<arrname.length && 0<arrurl.length && arrname.length==arrurl.length){
			da.runDB("/sys_setting/filemanager/action/attach_add_list.php",{
				dataType: "json",
				type: "biztemplet_"+ g_btid,
				code: "bcid_"+ g_bcid,
				names: arrname.join("|"),
				urls: arrurl.join("|")
			
			},function(res){
				if("FALSE" != res){
					loadattach();
				}
				this.closeWin();
				
			},function(code,msg,ex){
				// debugger;
			});
		}
	});
	
}

/**加载附件信息附件
*/
function loadattach(){
	if( !g_btid || !g_bcid ){
		alert("未传入表单编号");
		return;
	}

	var listobj = da("#attach_list");

	da.runDB("/sys_setting/filemanager/action/attach_get_list.php",{
		dataType: "json",
		type: "biztemplet_"+ g_btid,
		code: "bcid_"+ g_bcid
	
	},function(data){
		if( "FALSE" != data){
			listobj.empty();
			
			for(var i=0; i<data.length; i++){
				listobj.append('<a class="attachitem" href="'
				+ data[i].a_url 
				+'" title="'
				+ data[i].a_puname 
				+'"><img src="/images/sys_icon/attach.png" style="vertical-align:middle" /> '
				+ data[i].a_name +'</a> ');
			}
			
			autoframeheight();
		}
	
	},function(code,msg,ex){
		// debugger;
	});
}


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
	for(var id in g_editors){		//同步在线编辑器的内容
		g_editors[ id ].sync();
	}
	
	if( !daValid.all() ) return;
	
	var data = {
		dataType: "json",
		wfid: g_wfid,
		btid: g_btid,
		dbsource: g_dbsource,
		dbfld: g_dbfld,
		dbfldid: g_dbfldid
	};

	da("input,textarea,select", "#templet_form").each(function(idx, obj){
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
		debugger;
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
			for(var key in data){
				var daObj = da("#"+key);
				
				if( 0 < daObj.dom.length ){
					if( g_editfield[key] ){
						if( g_editors[key] ){	//如果是在线编辑器内容
							g_editors[key].html(data[key]);
						}
						da("#"+key).val(data[key]);
					}
					else{
						daObj.after('<span>'+ data[key] +'</span>');
						daObj.remove();
					}
				}
			}
		}
		loading(false);
		autoframeheight();
	});
}

var g_editors = {};
/**初始化表单控件
*/
function loadsource(){
	da("input[source],textarea[source],select[source]").each(function(idx, tag){
		if( !g_editfield[tag.id] ) return;
	
		var daObj = da(tag);
		var source = daObj.attr("source").split(",");

		switch( source[0] ){
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
			case "list":
				if(1 > source.length) return;
			
				//加载系统可选项
				da.runDB("/sys_setting/item/action/item_get_list.php",{
					dataType: "json",
					// async: false,
					itcode: source[1]
					
				},function(data){
					if("FALSE"!=data){
						for(var i=0; i<data.length; i++){
							daObj.append([
								'<option value="', data[i].i_value,'">', data[i].i_name, '</option>'
							].join(''));
						}
					}	
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
			case "editorboxsimple":
				var g_editor;
				g_editor = KindEditor.create("#"+tag.id, {
					resizeType : 1,
					// filterMode : false,		//不过滤危险标签
					newlineTag: "br",
					allowPreviewEmoticons : false,
					fileManagerJson : '/plugin/kindeditor/php/file_manager_json.php',
					allowFileManager : true,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'emoticons', 'image', 'link', '|', 'justifyleft', 'justifycenter', 
						'justifyright', 'insertorderedlist','insertunorderedlist']
				});
				g_editors[ tag.id ]=g_editor;		//保存线编辑器对象（保存表单前需要同步内容）
				
				break;
		}
	});
}

/**加载自定义脚本
*/
function loadscript( jstxt ){
    var daHead = da("head");
	oScript = '<script type="text/javascript">'+jstxt+'</script>';
    daHead.append( oScript ); 
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
			loadscript( data[0].bt_formscript );		//加载自定义脚本
			
			loadsource();
			autoframeheight();
			loaddata();
			loadattach();
		}
	});
}


var g_onlyread = false,		//允许查看
	g_ennew = false,		//允许新建
	g_enassign = false,		//允许分单
	g_endel = false,		//允许删除
	g_jointran = false,		//参与了业务流程
	g_editfield = {};		//可编辑字段
	
/**初始化当前人员可操作权限
*/
function loadoptpower( fn ){
	da.runDB("action/biz2role_get_dataset.php",{
		dataType: "json",
		wfid: g_wfid,
		tcid: g_tcid,
		tid: g_tid
		
	},function(data){
		if("FALSE"!= data){
			for(var i=0; i<data.opt.length; i++){
				switch( data.opt[i].wf2r_type ){
					case "READ":
						if( !g_onlyread ) g_onlyread = true;
						break;
					case "NEW":
						if( !g_ennew ) g_ennew = true;
						break;
					case "ASSIGN":
						if( !g_enassign ) g_enassign = true;
						break;
					case "DELETE":
						if( !g_endel ) g_endel = true;
						break;
				}
			}
			
			if( data.tran && g_tcid == data.tran.tc_id ){
				g_jointran = true;
			}

			if( data.fld ){
				for(var i=0; i<data.fld.length; i++){
					g_editfield[data.fld[i].tle_field] = true;
				}
			}
	
			var left_tools = da("#lefttools"),
				right_tools = da("#righttools");

			//参与管理 或参与业务流程
			if( g_ennew || g_enassign || g_endel || g_jointran ){
				left_tools.append('<a class="item" href="javascript:void(0)" onclick="uploadattach();" ><img src="/images/sys_icon/attach.png" /> 上传附件</a>');
				
				if( g_jointran ){
					right_tools.append('<a class="item" href="javascript:void(0)" onclick="submitworkflow();" ><img src="/images/sys_icon/email_go.png" /> 提交流程</a>');
				}
			}
			
			if(da.isFunction(fn)) fn();
		}
	},function(code,msg,ex){
		// debugger;
	});

}


daLoader("daMsg,daValid,daDate,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_bcid = arrparam["bcid"];
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		g_tcid = arrparam["tcid"];
		g_tid = arrparam["tid"];
		g_dbfldid = arrparam["dbfldid"];
		
		loading(true);
		loadoptpower(function(){
			loadtemplet();
		});
	});
});
