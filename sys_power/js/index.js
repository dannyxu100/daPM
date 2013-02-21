var level2menu = "";

/**显示隐藏左栏
*/
function slideleft(){
	var tdObj = da("#left_frame");
	if(tdObj.is(":hidden")){
		tdObj.show();
	}
	else{
		tdObj.hide();
	}
}

/**加载菜单
*/
function loadlevel2menu(){
	da.runDB("/sys_power/action/menu_get_list.php",{
		dataType: "json",
		pmpid: level2menu
	},function(data){
		if("FALSE" != data ){
			var listObj = da("#menu_list");
			
			for(var i=0; i<data.length; i++){
				listObj.append('<a class="bt_menu" href="javascript:void(0)" onclick="goto(\''+data[i].pm_url+'\')">'+ data[i].pm_name +'</a>');

			}
		}
	});
}


daLoader("daIframe,daWin,daToolbar",function(){
	da(function(){
		var arrParam = da.urlParams();
		level2menu = arrParam["menu"];
		
		loadlevel2menu();
	});
});
