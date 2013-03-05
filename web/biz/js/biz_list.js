
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

/**加载工作流对应 表单列表页模板
*/
function loadtemplet( bfid ){
	da.runDB("/sys_businessform/action/businessform_get_item.php",{
		dataType: "json",
		bf_id: bfid
		
	},function(data){
		if("FALSE" != data ){
			var listObj = da("#templet_list");
			listObj.append( decodeURI(data[0].bf_listhtml) );

		}
	});
}

/**点击二级菜单
*/
function clickworkflow( wfid, obj ){
	da(".curmenu").removeClass("curmenu");
	da(obj).addClass("curmenu");
	
	loadtemplet(1);
}

/**加载菜单
*/
function loadworkflow(){
	da.runDB("/web/biz/action/workflowbypower_get_list.php",{
		dataType: "json",
		roleids: fn_getcookie("roleid")
		
	},function(data){
		if("FALSE" != data ){
			var listObj = da("#workflow_list");
			
			for(var i=0; i<data.length; i++){
				listObj.append('<a class="bt_menu" href="javascript:void(0)" onclick="clickworkflow(\''+data[i].wf_id+'\', this)"><img src=""/> '+ data[i].wf_name +'</a>');

			}
			
			da(da(".bt_menu").dom[0]).click();
		}
	});
}


daLoader("daIframe,daWin,daToolbar",function(){
	da(function(){
		loadworkflow();
	});
});
