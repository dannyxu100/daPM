var level2menu = "";

/**显示隐藏左栏
*/
function slideleft(){
	var tdObj = da("#left_frame"),
		btObj = da("#bt_slide");
		
	if(tdObj.is(":hidden")){
		tdObj.show();
		btObj.dom[0].className = "bt_slideleft";
	}
	else{
		tdObj.hide();
		btObj.dom[0].className = "bt_slideright";
	}
}

/**点击二级菜单
*/
function clickmenu( url, obj ){
	da(".curmenu").removeClass("curmenu");
	da(obj).addClass("curmenu");

	goto( url );
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
				listObj.append('<a class="bt_menu" href="javascript:void(0)" onclick="clickmenu(\''+data[i].pm_url+'\', this)"><img src="'+data[i].pm_img+'"/> '+ data[i].pm_name +'</a>');

			}
			
			da(da(".bt_menu").dom[0]).click();
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
