var g_nid = "";

/**添加日志
*/
function loadnote(){
	if(""==g_nid){
		alert("未指定便签。");
		return;
	}

	da.setForm("#noteform",
	"/sys_common/note/action/note_get_item.php",{
		dataType: "json",
		nid: g_nid
		
	},function(fld,val, row, ds ){
		return val;
	
	},function(data){
		da("#noteform").show();
		autoframeheight();
		
	},function(code, msg, ex){
		// debugger;
	});
	
}


daLoader("daMsg,daIframe,daWin,daValid",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_nid = arrparam["nid"];
		
		loadnote();
	});
});