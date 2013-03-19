
var g_wfid = "",
	g_tid = "";


function savetran(){
	da.runDB("action/tran_update_item.php",{
		tid: g_tid,
		tname: da("#t_name").val(),
		tsort: da("#t_sort").val(),
		ttype: da("#t_type").val(),
		tlimit: da("#t_limit").val(),
		tfiretaskid: da("#t_firetaskid").val(),
		tremark: da("#t_remark").val()
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

function loadtran(){
	da.runDB("/sys_workflow/action/tran_get_item.php",{
		dataType: "json",
		tid: g_tid
		
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

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_wfid = arrParam["wfid"];
	g_tid = arrParam["tid"];

	loadtran();
});