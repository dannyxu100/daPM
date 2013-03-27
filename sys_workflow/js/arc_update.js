
var g_wfid = "",
	g_aid = "";

function loadtran(){
	da.runDB("/sys_workflow/action/tran_get_list.php",{
		dataType: "json",
		async: false,
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
		async: false,
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
	if(!daValid.all()) return;

	da.runDB("action/arc_update_item.php",{
		aid: g_aid,
		aname: da("#a_name").val(),
		asort: da("#a_sort").val(),
		adirection: da("[name=a_direction]:checked").val(),
		apid: da("#a_pid").val(),
		atid: da("#a_tid").val(),
		atype: da("#a_type").val(),
		aprecondition: da("#a_precondition").val()
	},function(res){
		if("FALSE"!=res){
			alert("修改成功。");
		}
		else{
			alert("操作失败。");
		}
	});
}

function loadarc(){
	da.runDB("/sys_workflow/action/arc_get_item.php",{
		dataType: "json",
		aid: g_aid
		
	},function(data){
		if("FALSE"!=data){
			for( var k in data){
				da("#"+k).val(data[k]);
			}
			da("[name=a_direction][value="+ data["a_direction"] +"]").attr("checked","true");
		}
	},function(code,msg,ex){
		// debugger;
	});
}

daLoader("daMsg,daValid,daTable,daWin", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_wfid = arrParam["wfid"];
	g_aid = arrParam["aid"];

	loadplace();
	loadtran();
	loadarc();
});