
var ptid = "";

function loadpowertype(){
	da.runDB("action/powertype_get_item.php",{
		dataType: "json",
		pt_id: ptid
	},function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});
}

function updatepowertype(){
	da.runDB("action/powertype_update_item.php",{
		pt_id: ptid,
		
		pt_name: da("#pt_name").val(),
		pt_code: da("#pt_code").val(),
		pt_sort: da("#pt_sort").val(),
		pt_remark: da("#pt_remark").val()
	},function(res){
		if(res=="FALSE"){
			alert("对不起，修改失败。");
		}
		else{
			alert("修改成功。");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	ptid = arrParam["ptid"];

	da(function(){
		loadpowertype();
	});
});