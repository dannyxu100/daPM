
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
	
	autoframeheight();
}

/**点击二级菜单
*/
function clickworkflow( wfid, btid, obj ){
	da(".curmenu").removeClass("curmenu");
	da(obj).addClass("curmenu");
	
	goto("/web/biz/biz_list.php?wfid="+ wfid, true);
}

/**加载菜单
*/
function loadworkflow(){
	da.runDB("/web/biz/action/workflow2role_get_list.php",{
		dataType: "json",
		roleids: fn_getcookie("roleid")
		
	},function(data){
		if("FALSE" != data ){
			var listObj = da("#workflow_list");
			
			for(var i=0; i<data.length; i++){
				listObj.append('<a class="bt_menu" href="javascript:void(0)" onclick="clickworkflow(\''+data[i].wf_id+'\', \''+data[i].wf_btid+'\', this)"><img src=""/> '+ data[i].wf_name +'</a>');

			}
			
			da(da(".bt_menu").dom[0]).click();
		}
	});
}


daLoader("daMsg,daTable,daIframe,daWin",function(){
	da(function(){
		loadworkflow();
	});
});
