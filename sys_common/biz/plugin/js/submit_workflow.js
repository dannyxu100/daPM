var g_wfid = "",
	g_wfcid = "";


/**提交业务流程
*/
function updatetran(){
	confirm("您是否确定已经完成业务？", function(){
		da.runDB( "/sys_common/biz/action/trancase_submit_item.php", {
			dataType: "text",
			wfid: g_wfid,
			wfcid: g_wfcid,
			aid: da("[name=chkarclist]:checked").val(),
			remark: da("#remark").val()
		},
		function(emails){
			if( "FALSE" != emails ){
				alert("提交成功。");
				
				/*发送个邮件提醒*/
				fn_sendemail( emails, 
					"PM新业务提醒", 
					[
						"<div>亲，祝你工作开心! <br/>PS: 您有新的业务等待处理（来自网联天下技术部）。</div><br/><br/>",
						"<div><span style='font-weight:bold;'>备注信息：</span>",
						da("#remark").val(),
						"</div>"
					].join("")
				);
			}
			else{
				alert("对不起，操作失败。");
			}
		},function(a,b,c){
			// debugger;
		});
	});
}


/**加载工作流向弧（路由）可选项
*/
function loadarclist(){
	da.runDB( "/sys_common/biz/action/arc2direction_get_list.php", {
		dataType: "json",
		wfid: g_wfid,
		wfcid: g_wfcid
	},
	function(data){
		debugger;
		if( "FALSE" != data && 0 < data.length ){
			var arcObj = da("#arclist");
			switch( data[0].a_type ){
				// SEQ：一般顺序流类型；
				// Explicit Or Split：显示条件分支；
				// Implicit Or Split：隐式条件分支； 
				// Or Join：条件汇聚(显示和隐式)；
				// And Split：并行分支； 
				// And Join：并行汇聚
				case "SEQ":
				case "And Join":
				case "Explicit Or Split":
					for(var i=0; i<data.length; i++){
						arcObj.append('<label ><input type="radio" name="chkarclist" '
						+ ( 0==i ?' checked="true" ':'') 
						+' value="'+ data[i].a_id +'"/>'+ data[i].a_name +'</label>');
					}
					break;
					
				case "And Split":
					da("#acrtype").text("并行处理");
				
					var item = [];
					for(var i=0; i<data.length; i++){
						item.push(data[i].a_name);
					}
					arcObj.append('<label ><input type="radio" name="chkarclist" checked="true" value="'+ data[0].a_id +'"/>'+ item.join("; ") +'</label>');
					break;
					
				
			}
			
		}
	},function(a,b,c){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_wfid = arrparam["wfid"];
		g_wfcid = arrparam["wfcid"];
		
		loadarclist();
	});
});
