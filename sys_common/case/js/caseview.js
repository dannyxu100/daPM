var g_cid = "";

/**加载案例信息
*/
function loadcase(){
	if( "" == g_cid ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}

	loading(true);
	da.setForm( "#caseform", 
	"/sys_common/case/action/case_get_item.php", {
		dataType: "json",
		cid: g_cid
		
	},function( fld, val, row, ds ){
		return val;
		
	},function( data ){
		//debugger;
		da("#caseform").show();
		loading(false);
		autoframeheight();
		
	},function( msg, code, content ){
		//debugger;
	});
}

daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_cid = arrparam["cid"];
		
		loadcase();
	});
});