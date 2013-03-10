var g_btid = "1";

/**创建业务
*/
function addbiz(){
	goto("");
}


/**加载工作流对应 表单列表页模板
*/
function loadtemplet(){
	da.runDB("/sys_bizform/action/biztemplet_get_item.php",{
		dataType: "json",
		bt_id: g_btid
		
	},function(data){
		if("FALSE" != data ){
			var formObj = da("#templet_form");
			formObj.append( decodeURI(data[0].bt_formhtml) );

		}
	});
}


daLoader("daIframe,daWin",function(){
	da(function(){
		loadtemplet();
	});
});
