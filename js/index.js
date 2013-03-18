
function showuserinfo(){
	da(".userinfo_list").show();
}
function hideuserinfo(){
	da(".userinfo_list").hide();
}
/**上传头像
*/
function uploadico(){
	var newfilename = fn_getcookie("puname")+"_"+fn_getcookie("puid");

	fn_uploadfile({
        "fileTypeDesc": "图片文件",
		// "multi": true,
		"fileTypeExts": "*.gif; *.jpg; *.png",
		"formData": {
			"folder": "/uploads/userico",
			"name": newfilename
		}
	},function(files){
		var imgurl = "";
		for( var k in files ){
			imgurl = "/uploads/userico/"+ newfilename + files[k].type;
		}
		
		da.runDB("/sys_power/action/user_update_puicon.php",{
			dataType: "json",
			puid: fn_getcookie("puid"),
			puicon: imgurl
		});
	});
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

/**加载用户信息
*/
function loaduserinfo(){
	da("#puicon").attr("src", fn_getcookie("puicon"));
	da("#puname").text(fn_getcookie("puname"));
	da("#poname").text(fn_getcookie("poname"));
	da("#rolename").text(fn_getcookie("rolename"));
	da("#groupname").text(fn_getcookie("groupname"));
}

daLoader("daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		loaduserinfo();
		loadmenu();
		
		listenKey();
	});
});
