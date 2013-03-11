
var g_wfid = "";

function loadtran(){
	da.runDB("/sys_workflow/action/tran_get_list.php",{
		dataType: "json",
		wfid: g_wfid
	},function( data ){
		if("FALSE"!=data ){
			var listObj = da("#a_tid");
			for(var i=0;i<data.length;i++){
				listObj.append('<option value="'+ data[i].t_id +'">'+ data[i].t_name +' '+ data[i].t_sort +'</option>');
			}
		}
	});
}

function loadplace(){
	da.runDB("/sys_workflow/action/place_get_list.php",{
		dataType: "json",
		wfid: g_wfid
	},function( data ){
		if("FALSE"!=data ){
			var listObj = da("#a_pid");
			for(var i=0;i<data.length;i++){
				listObj.append('<option value="'+ data[i].p_id +'">'+ data[i].p_name +' '+ data[i].p_sort +'</option>');
			}
		}
	});
}

function savearc(){
	da.runDB("action/arc_add_item.php",{
		a_wfid: g_wfid,
		a_name: da("#a_name").val(),
		a_sort: da("#a_sort").val(),
		a_direction: da("[name=a_direction]:checked").val(),
		a_pid: da("#a_pid").val(),
		a_tid: da("#a_tid").val(),
		a_type: da("#a_type").val(),
		a_precondition: da("#a_precondition").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_wfid = arrParam["wfid"];

	loadplace();
	loadtran();
});