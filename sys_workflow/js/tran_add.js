
var wfid = "";

function savetran(){
	if(!daValid.all()) return;
	
	da.runDB("action/tran_add_item.php",{
		t_wfid: wfid,
		t_name: da("#t_name").val(),
		t_sort: da("#t_sort").val(),
		t_type: da("#t_type").val(),
		t_limit: da("#t_limit").val(),
		t_firetaskid: da("#t_firetaskid").val(),
		t_remark: da("#t_remark").val()
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