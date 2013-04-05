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
		}
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
		g_dbfldid = arrparam["dbfldid"];
				
		listenKey();
		
		loadtemplet();
	});
});
