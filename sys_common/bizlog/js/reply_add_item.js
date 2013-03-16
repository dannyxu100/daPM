var g_bcid = "",
	g_lid = "";

/**添加日志
*/
function savereply(){
	da.runDB("/sys_common/bizlog/action/reply_add_item.php",{
		dataType: "json",
		bcid: g_bcid,
		lid: g_lid,
		content: g_editor.html()
		
	},function(res){
		if("FALSE"!=res){
			alert("添加成功。");
			back();
		}	
	},function(msg, code, ex){debugger;
		alert(code);
	});
	
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		g_lid = arrparam["lid"];
		
		da("#replyuser").text(fn_getcookie("puname"));
		da("#replydate").text(new Date().format("yyyy-mm-dd hh:nn:ss"));
	});
});