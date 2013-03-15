var g_wfid = "",
	g_wfcid = "";


/**提交业务流程
*/
function updatetran(){
	da.runDB( "/sys_common/biz/action/trancase_submit_item.php", {
		dataType: "json",
		wfid: g_wfid,
		wfcid: g_wfcid,
		aid: da("#arclist").val()
	},
	function(data){debugger;
		if( "FALSE" != data ){
			alert("提交成功。");
		}
		else{
			alert("操作失败。");
		}
	},function(a,b,c){
		debugger;
	});
}


/**加载工作流向弧（路由）可选项
*/
function loadarclist(){
	da.runDB( "/sys_common/biz/action/arc2direction_get_list.php", {
		dataType: "json",
		wfid: g_wfid,
		wfcid: g_wfcid
	},
	function(data){
		if( "FALSE" != data ){
			var arcObj = da("#arclist");
			
			for(var i=0; i<data.length; i++){
				arcObj.append('<option value="'+ data[0].a_id +'">'+ data[0].a_name +'</option>');
			}
		}
	},function(a,b,c){
		debugger;
	});
}

daLoader("daIframe",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		
		loadarclist();
	});
});
