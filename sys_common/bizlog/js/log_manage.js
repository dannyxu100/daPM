var g_bcid = "";

/**添加日志
*/
function addlog(){
	daWin({
		width:800,
		height:600,
		url: "/sys_common/bizlog/log_add_item.php?bcid="+ g_bcid,
		back: function(){
			
		}
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
	});
});