﻿
var wfid = "";

function saveplace(){
	if(!daValid.all()) return;
	
	da.runDB("action/place_add_item.php",{
		p_wfid: wfid,
		p_name: da("#p_name").val(),
		p_sort: da("#p_sort").val(),
		p_remark: da("#p_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daMsg,daValid,daTable,daWin", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	wfid = arrParam["wfid"];

});