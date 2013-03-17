
var g_hid = "",
	g_hcode = "";

/**加载帮助文档
*/
function loadinfo(){
	var param = {
		dataType: "json"
	}
	
	if( g_hid ){
		param["hid"] = g_hid;
	}
	else{
		param["hcode"] = g_hcode;
	}

	da.runDB("/sys_setting/helper/action/helper_get_item.php", param,
	function(data){
		if("FALSE" != data){
			for(var k in data){
				da("#"+k).html(data[k]);
			}
			
			//da("pre").addClass("prettyprint linenums").attr('style', 'overflow:auto');
			prettyPrint();
			
			autoframeheight();
		}
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin", function(){
	da(function(){
		//da.out("加载成功");
		var arrParam = da.urlParams();
		g_hid = arrParam["hid"];
		g_hcode = arrParam["hcode"];
		

		loadinfo();
	});

});