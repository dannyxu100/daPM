
var wftid = "";

function saveworkflow(){
	da.runDB("action/workflow_add_item.php",{
		wf_wftid: wftid,
		wf_name: da("#wf_name").val(),
		wf_sort: da("#wf_sort").val(),
		wf_isrun: da("[name=wf_isrun]:checked").val(),
		wf_starttaskid: da("#wf_starttaskid").val(),
		wf_user: da("#wf_user").val(),
		wf_date: da("#wf_date").val(),
		wf_edituser: da("#wf_edituser").val(),
		wf_editdate: da("#wf_editdate").val(),
		wf_remark: da("#wf_remark").val()
	},function(res){
		if("FALSE"!=res){
			alert("添加成功");
		}
	});
}

daLoader("daTable,daWin,daMsg", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	wftid = arrParam["wftid"];

});