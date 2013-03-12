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
		url: "/web/biz/plugin/submit_workflow.php?wfid="+ g_wfid +"&wfcid="+ g_wfcid,
		back: function(){
			
		}
	});
}

/**创建业务
*/
function savebiz(){
	//goto("");
}


/**加载表单数据
*/
function loaddata(){
	if( "" == g_dbsource || "" == g_dbfld ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}
	
	da.runDB("/web/biz/action/dbsource_get_item.php", {
		dataType: "json",
		dbsource: g_dbsource,
		dbfld: g_dbfld,
		dbfldid: g_dbfldid
		
	},function(data){
		if( "FALSE" != data ){
			for(var key in data){
				da("#"+key).val(data[key]);
			}
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

			loaddata();
		}
	});
}


daLoader("daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_btid = arrparam["btid"];
		g_bcid = arrparam["bcid"];
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		g_dbsource = arrparam["dbsource"];
		g_dbfld = arrparam["dbfld"];
		g_dbfldid = arrparam["dbfldid"];
		
		loadtemplet();
	});
});
