
var g_wfid = "",
	g_pid = "";

function saveplace(){
	if(!daValid.all()) return;
	
	da.runDB("/sys_workflow/action/place_update_item.php",{
		pid: g_pid,
		pname: da("#p_name").val(),
		ptype: da("#p_type").val(),
		psort: da("#p_sort").val(),
		premark: da("#p_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("修改成功。");
		}
		else{
			alert("操作失败。");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

function loadplace(){
	da.runDB("/sys_workflow/action/place_get_item.php",{
		dataType: "json",
		pid: g_pid
		
	},function(data){
		if("FALSE"!=data){
			for( var k in data){
				da("#"+k).val(data[k]);
			}
		}
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daValid,daTable,daWin", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_wfid = arrParam["wfid"];
	g_pid = arrParam["pid"];

	loadplace();
});