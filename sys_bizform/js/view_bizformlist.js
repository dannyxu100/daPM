
var g_bfid = "";

function loadlist(){
	var data1 = {
			dataType: "json",
			opt: "qry"
		};
		
	daTable({
		id: "tb_list",
		url: "/sys_power/action/powertype_get_list.php",
		data: data1,
		//loading: false,
		//page: false,
		pageSize: 20,
		
		field: function( fld, val, row, ds ){
			// da.out($v[_pu_remark]);
			// if( "pu_count" == fld )
				// return 0==val?"完整SQL":"不完整SQL";
			if("pt_name"==fld){
				return '<a href="javascript:void(0)" onclick="updatepowertype('+row.pt_id+')">'+val+'</a>';
			}
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			// toExcel();
		}
	}).load();

}

function loadformhtml(){
	da.runDB("/sys_businessform/action/businessform_get_item.php",{
		dataType: "json",
		bf_id: g_bfid
		
	},function(data){
		if("FALSE" != data){
			da("#pad_main").html(decodeURI(data[0].bf_listhtml));
			
			loadlist();
		}
	});
}

daLoader("daTable", function(){
	//da.out("加载成功");
	var arrParam = da.urlParams();
	g_bfid = arrParam["bfid"];

	da(function(){
		//alert(1);
		loadformhtml();
	});
});
//-->