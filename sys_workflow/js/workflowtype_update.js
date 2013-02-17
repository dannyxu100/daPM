
var wftid = "";

function loadpowertype(){
	da.runDB("action/workflowtype_get_item.php",{
		dataType: "json",
		wft_id: wftid
	},function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});
}

function updatewft(){
	da.runDB("action/workflowtype_update_item.php",{
		wft_id: wftid,
		
		wft_name: da("#wft_name").val(),
		wft_date: da("#wft_date").val(),
		wft_sort: da("#wft_sort").val(),
		wft_remark: da("#wft_remark").val()
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
	wftid = arrParam["wftid"];

	da(function(){
		loadpowertype();
		
		$( "#wft_date" ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true
		});
	});
});