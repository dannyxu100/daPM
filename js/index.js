
function showuserinfo(){
	da(".userinfo_list").show();
}
function hideuserinfo(){
	da(".userinfo_list").hide();
}

/**修改密码
*/
function updatepwd(){
	daWin({
		width:350,
		height:400,
		url:"pwd.php"
	});
}

/**加载菜单
*/
function loadmenu(){
	da.runDB("/sys_power/action/menu_get_list.php",{
		dataType: "json",
		pmlevel: 1
	},function(data){
		if("FALSE" != data ){
			barObj = daToolbar({
				parent: "#menubar"
			});

			for(var i=0; i<data.length; i++){
				barObj.appendItem({
					id: "bt_menu"+data[i].pm_id,
					html: '<img src="'+ data[i].pm_img +'" /> '+data[i].pm_name,
					data: {
						id: data[i].pm_id,
						url: data[i].pm_url,
						img: data[i].pm_img
					},
					click: function(){
						// alert(this.data.url)
						goto(this.data.url, g_isctrl, "page"+this.data.id);	//需要缓存，缓存code为page+pm_id
					}
				});
			}
			
			barObj.select("bt_menu"+data[0].pm_id);
		}
	},function(res, msg, ex){
		alert(ex);
	});
}


var g_isctrl = false;
/**监听按键
*/
function listenKey(){
	daKey({
		keydown: function(keyName, ctrlKey, altKey, shiftKey){
			if( !g_isctrl ){
				g_isctrl = ctrlKey;
			}
		},
		keyup: function(keyName, ctrlKey, altKey, shiftKey){
			if( g_isctrl ){
				g_isctrl = ctrlKey;
			}
		}
	});
}


daLoader("daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		//decodeURIComponent(da.cookie("COOKIE_FROM_DASYS"));
		loadmenu();
		
		listenKey();
	});
});
