var g_wfid = "",	//工作流id
	g_wfcid = "",	//工作流实例id
	g_tcid = "",	//当前事务变迁id
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
		debugger;
	});
}


/**查看业务表单详细信息
*/
function viewbizlog(){
	if( g_isctrl ){
		daWin({
			width: 800,
			height: 500,
			url: "/sys_common/bizlog/log_manage.php?bcid="+ g_bcid,
			back: function(){
				
			}
		});
	}
	else{
		goto("/sys_common/bizlog/log_manage.php?bcid="+ g_bcid );
	}
	
}

/**加载表单数据
*/
function loaddata(){
	if( "" == g_dbsource || "" == g_dbfld ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}

	da.setForm( "#templet_form", 
	"/sys_common/biz/action/dbsource_get_item.php", {
		dataType: "json",
		dbsource: g_dbsource,
		dbfld: g_dbfld,
		dbfldid: g_dbfldid
		
	},function( fld, val, row, ds ){
		return val;
		
	},function( data ){
		//debugger;
		da("#templet_form").show();
		autoframeheight();
		
	},function( msg, code, content ){
		//debugger;
	});
	
}

var g_editors = {};
/**初始化表单控件
*/
function init(){
	da("input,textarea").each(function(idx, tag){
		var daObj = da(tag);
		
		daObj.attr("disabled","disabled");
		daObj.addClass("disabled");
		
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
			formObj.append( data[0].bt_form2html );
			loadscript( data[0].bt_form2script );		//加载自定义脚本
			
			init();
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
	g_jointran = false;		//参与了业务流程
	
/**初始化当前人员可操作权限
*/
function loadoptpower( fn ){
	da.runDB("action/biz2role_get_dataset.php",{
		dataType: "json",
		wfid: g_wfid,
		tcid: g_tcid
		
	},function(data){
		if("FALSE"!= data){
			for(var i=0; i<data.ds1.length; i++){
				switch( data.ds1[i].wf2r_type ){
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

			if( data.ds2 && g_tcid == data.ds2.tc_id ){
				g_jointran = true;
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

var g_isctrl = false;
/**监听按键
*/
function listenKey(){
	daKey({
		keydown: function(keyName, ctrlKey, altKey, shiftKey){
			if( !g_isctrl ){
				g_isctrl = ctrlKey;
			}
		},
		keyup: function(keyName, ctrlKey, altKey, shiftKey){
			if( g_isctrl ){
				g_isctrl = ctrlKey;
			}
			if( "Enter" == keyName){
				searchkey();
			}
		}
	});
}

daLoader("daMsg,daKey,daValid,daDate,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_bcid = arrparam["bcid"];
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		g_tcid = arrparam["tcid"];
		g_dbfldid = arrparam["dbfldid"];
				
		listenKey();
		
		loadoptpower(function(){
			loadtemplet();
		});
	});
});
