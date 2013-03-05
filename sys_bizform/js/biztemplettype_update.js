
var g_bftid = "";

function loadtype(){
	da.runDB("action/businessformtype_get_item.php",{
		dataType: "json",
		bft_id: g_bftid
	},function(res){
		if("FALSE"!= res && res[0]){
			for(var fld in res[0]){
				da("#"+fld).val(res[0][fld]);
			}
		}
	});
}

function updatebft(){
	da.runDB("action/businessformtype_update_item.php",{
		bft_id: g_bftid,
		
		bft_name: da("#bft_name").val(),
		bft_date: da("#bft_date").val(),
		bft_sort: da("#bft_sort").val(),
		bft_remark: da("#bft_remark").val()
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
	g_bftid = arrParam["bftid"];

	da(function(){
		loadtype();
		
		$( "#bft_date" ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true
		});
	});
});