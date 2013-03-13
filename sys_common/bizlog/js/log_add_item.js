
/**添加日志
*/
function addlog(){
	daWin({
		width:800,
		height:600,
		url: "/sys_common/bizlog/log_add_item.php",
		back: function(){
			
		}
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_wfid = arrparam["wfid"];
		
	});
});