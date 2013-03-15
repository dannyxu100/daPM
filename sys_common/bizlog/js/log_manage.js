var g_bcid = "";

/**添加日志
*/
function addlog(){
	daWin({
		width:800,
		height:600,
		url: "/sys_common/bizlog/log_add_item.php?bcid="+ g_bcid,
		back: function(){
			loadlist();
		}
	});
}

/**加载日志列表
*/
function loadlist(){
	var objlist = da("#listPad");
	objlist.empty();
	da.runDB("/sys_common/bizlog/action/log_get_list.php", {
		dataType: "json",
		bcid: g_bcid
		
	},function(data){
		if("FALSE"!=data){
			for(var i=0; i<data.length; i++){
				objlist.append('<ul>'+ data[i].l_content +'</ul>');
			}
		}
	},function(msg, code, ex){
		alert(code);
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
		loadlist();
	});
});