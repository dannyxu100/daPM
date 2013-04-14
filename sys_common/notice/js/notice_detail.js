var g_nid = "";

/**添加日志
*/
function loadnotice(){
	if(""==g_nid){
		alert("未指定通知公告编号。");
		return;
	}

	da.setForm("#noticeform",
	"/sys_common/notice/action/notice_get_item.php",{
		dataType: "json",
		nid: g_nid
		
	},function(fld,val, row, ds ){
		return val;
	
	},function(data){
		da("#noticeform").show();
		autoframeheight();
		
	},function(code, msg, ex){
		// debugger;
	});
	
}


daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_nid = arrparam["nid"];
		
		loadnotice();
	});
});