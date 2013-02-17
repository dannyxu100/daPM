
function savepowertype(){
	da.runDB("action/powertype_add_item.php",{
		pt_name: da("#pt_name").val(),
		pt_code: da("#pt_code").val(),
		pt_sort: da("#pt_sort").val(),
		pt_remark: da("#pt_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");

});