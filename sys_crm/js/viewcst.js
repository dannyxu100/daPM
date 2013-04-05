
var g_cid="";

/**加载客户详细信息
*/
function loadcstinfo(){
	if(""==g_cid){
		alert("未指定客户编号。");
		return;
	}

	da.setForm("#cst_form",
	"/sys_crm/action/customer_get_item.php",{
		dataType: "json",
		cid: g_cid
		
	},function(fld,val, row, ds ){
		return val;
	
	},function(data){
		da("#cst_form").show();
		autoframeheight();
		
	},function(code, msg, ex){
		debugger;
	});
	
}

daLoader("daMsg,daValid,daIframe,daWin",function(){
	da(function(){
		var arrParam = da.urlParams();
		g_cid = arrParam["cid"];
		
		loadcstinfo();
	});
});
