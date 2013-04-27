function scrolltop(obj){
	var daObj = da(obj);
	if (0 != da(window).scrollTop()) {
		daObj.fadeIn()
	}
	
	da(window).scroll(function(){
		if(0 != da(window).scrollTop()){
			daObj.fadeIn();
		}
		else{
			daObj.fadeOut();
		}
	});

	daObj.click(function() {
		da("html,body").act({
			scrollTop: 0
		},100);
	});
}

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

	fn_uploadfile("上传文件尺寸为50x50像素。", {
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
		width:">350",
		height:400,
		url:"/sys_setting/pwd.php"
	});
}

function showmorelist(){
	var listObj = da("#list_menumore");
	if( listObj.is(":hidden") ){
		listObj.slideDown(100);
	}
}

function hidemorelist(){
	var listObj = da("#list_menumore");
	if(!listObj.is(":hidden")){
		listObj.hide();
	}
}

function clickmenu(url, id){
	da("#menu_cur").empty();

	goto(url, g_isctrl, "page"+id);	//需要缓存，缓存code为page+pm_id
}


function clickmoremenu(obj, url, id){
	var menucurObj = da("#menu_cur"),
		menuObj = da(obj),
		cloneObj = obj.cloneNode(true);
	
	cloneObj.id = "";
	da(cloneObj).attr("id", "");
	da(cloneObj).addClass("curmenu2");
	
	g_toolbar.cancelselect();
	
	menucurObj.empty();
	menucurObj.append(cloneObj);
	
	goto(url, g_isctrl, "page"+ id);	//需要缓存，缓存code为page+pm_id
	hidemorelist();
}

var g_toolbar;
/**加载菜单
*/
function loadmenu(){
	da.runDB("/sys_power/action/menu_get_byrole.php",{
		dataType: "json",
		pmlevel: 1
	},function(data){
		if("FALSE" != data ){
			var listmoreObj = da("#list_menumore"),
				num_show = 5;
			
			if( num_show < data.length ){		//超过默认显示一级菜单数，显示更多
				da("#menumorebox").show();
			}
			
			g_toolbar = daToolbar({
				parent: "#menus"
			});
			
			for(var i=0; i<data.length; i++){
				if(0<num_show){		//默认显示菜单个数
					num_show--;
					g_toolbar.appendItem({
						id: "bt_menu"+data[i].pm_id,
						html: '<img src="'+ data[i].pm_img +'" /> '+data[i].pm_name,
						data: {
							id: data[i].pm_id,
							url: data[i].pm_url,
							img: data[i].pm_img
						},
						click: function(){
							// alert(this.data.url)
							clickmenu(this.data.url, this.data.id);
						}
					});
				}
				else{				//更多菜单
					listmoreObj.append('<a class="bt_menu" href="javascript:void(0)" onclick="clickmoremenu(this,\''
					+ data[i].pm_url +'\', '
					+ data[i].pm_id +')"><img src="'
					+ data[i].pm_img +'"/> '
					+ data[i].pm_name +'</a>');
					
				}
			}
			g_toolbar.select("bt_menu"+data[0].pm_id);
		}
	},function(res, msg, ex){
		// debugger;
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

daLoader("daMsg,daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		loaduserinfo();
		loadmenu();
		listenKey();
		
		da("#menumorebox").hover(function(){
			showmorelist();
			da("#bt_more").addClass("hover");
		},
		function(){
			hidemorelist();
			da("#bt_more").removeClass("hover");
		});
		
		
		da("#userico").hover(function(){
			showuserinfo();
		},
		function(){
			hideuserinfo();
		});
		
		// da(".userinfo_list").bgiframe();
		// da("#menumorebox").bgiframe();

		scrolltop("#scrolltop");
		
		// gamestart();
	});
});


function gamestart(){
	var objgamebg = da("#gamebg"),
		objgamefly = da("#gamefly"),
		objgamepointer = da("#gamepointer"),
		winsize = {
		width: da(window).width(),
		height: da(window).height()
	};
	
	objgamebg.width(winsize.width);
	objgamebg.height(winsize.height);
	objgamebg.bind("mousemove",function(evt){
		objgamepointer.css({
			top: (evt.pageY-25) +"px",
			left: (evt.pageX-25) +"px"
		});
	});
	
	objgamepointer.bind("mouseup",function(){
		da.out(1111);
	});
	
	// objgamefly.act({
		
	// },function(){
	
	// });
}