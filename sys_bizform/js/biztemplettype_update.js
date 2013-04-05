
var g_bttid = "";

function loadtype(){
	da.runDB("action/biztemplettype_get_item.php",{
		dataType: "json",
		btt_id: g_bttid
	},function(data){
		if("FALSE"!= data){
			for(var fld in data){
				da("#"+fld).val(data[fld]);
			}
		}
	});
}

function updatebtt(){
	da.runDB("action/biztemplettype_update_item.php",{
		btt_id: g_bttid,
		
		btt_name: da("#btt_name").val(),
		btt_date: da("#btt_date").val(),
		btt_sort: da("#btt_sort").val(),
		btt_remark: da("#btt_remark").val()
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
	g_bttid = arrParam["bttid"];

	da(function(){
		loadtype();
		
		$( "#btt_date" ).datepicker({
		  defaultDate: "+1w",
		  changeMonth: true
		});
	});
});