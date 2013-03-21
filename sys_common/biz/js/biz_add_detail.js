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
			// iframeBack();
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


daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_wfid = arrparam["wfid"];
		
		loadtemplet();
	});
});
