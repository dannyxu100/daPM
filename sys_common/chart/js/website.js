
function showtable(){
	var chkobj = da("#bt_showtable");

	if(chkobj.is(":checked")){
		chkobj.removeAttr("checked");
		chkobj.dom[0].checked = "";
		da("#templet_sublist").hide();
	}
	else{
		chkobj.attr("checked", "true");
		chkobj.dom[0].checked = true;
		da("#templet_sublist").show();
	}
}

function getRandomColor()
{
	var r = Math.floor(Math.random() * 255).toString(16);
	var g = Math.floor(Math.random() * 255).toString(16);
	var b = Math.floor(Math.random() * 255).toString(16);
	r = r.length == 1 ? "0" + r : r;
	g = g.length == 1 ? "0" + g : g;
	b = b.length == 1 ? "0" + b : b;
	return "#" + r + g + b;
}

function runchart(){
	loading(true);
	loaddata(function(ds){
		if(0>=ds.length) return;
	
		var data = [];
		for(var i=0; i<ds.length; i++){
			data.push({
				name: ds[i].tc_status,
				value: ds[i].sum_count,
				color: getRandomColor()
			});
		}
		
		var chart = new iChart.Bar2D({
			render : 'viewchart',		//渲染的Dom目标,canvasDiv为Dom的ID
			data: data,					//绑定数据
			title : '网建业务统计',		//设置标题
			width : 800,				//设置宽度，默认单位为px
			height : 400,				//设置高度，默认单位为px
			shadow:true,				//激活阴影
			shadow_color:'#c7c7c7',		//设置阴影颜色
			coordinate:{				//配置自定义坐标轴
				scale:[{					//配置自定义值轴
					 position:'bottom',		//配置左值轴	
					 start_scale:0,			//设置开始刻度为0
					 end_scale:50,			//设置结束刻度为26
					 scale_space:2,			//设置刻度间距
					 listeners:{			//配置事件
						parseText:function(t,x,y){		//设置解析值轴文本
							return {text:t+" 次"}
						}
					}
				}]
			}
		});
		
		chart.draw();		//调用绘图方法开始绘图
		
		autoframeheight();
		loading(false);
	});
}

function loaddata(fn){
	daTable({
		id: "tb_list",
		url: "/sys_common/chart/action/chartitem_website_all.php",
		data: {
			// opt: "qry",
			dataType: "json",
			// dbsource: "hsd_leave",
			// dbfld: "l_id"
			wfid: 15
		},
		//loading: false,
		//page: false,
		pageSize: 99999,
		
		field: function( fld, val, row, ds ){
			return val;
		},
		loaded: function( idx, xml, json, ds ){
			//link_click("#tb_list tbody[name=details_auto] tr");
			fn(ds);
		},
		error: function(code,msg,ex){
			debugger;
		}
	}).load();
}

daLoader("daMsg,daTable,daIframe",function(){
	
	da(function(){
		
	});
});