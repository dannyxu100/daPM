
function scrolltop(obj){
	var daObj = da(obj);
	if (0 != da(window).scrollTop()) {
		daObj.fadeIn()
	}
	
	da("#logbox").scroll(function(){
		if(0 != da("#logbox").scrollTop()){
			daObj.fadeIn();
		}
		else{
			daObj.fadeOut();
		}
	});

	daObj.click(function() {
		da("#logbox").act({
			scrollTop: 0
		},100);
	});
}

/**加载日志列表
*/
function loadreplylist(lids){
	da.runDB("/sys_common/bizlog/action/reply2log_get_list.php", {
		dataType: "json",
		lids: lids
		
	},function(data){
		if("FALSE"!=data){
			var replyhtml = da("#replytemplet").html();
			
			for(var i=0; i<data.length; i++){
				da( "#reply_"+ data[i].r_lid ).append(replyhtml.replace(/{\w*}/g, 
				function( match, idx, self ){					//替换日志模板内容
					switch(match){
						case "{userico}":
							return data[i].pu_icon?data[i].pu_icon:"/uploads/userico/default.png";
						case "{puname}":
							return data[i].pu_name;
						case "{r_content}":
							return data[i].r_content;
						case "{r_date}":
							return data[i].r_date;
					}
				}));
			}
			
			autoframeheight();
		}
	},function(msg, code, ex){
		// debugger;
	});
}


/**查看日志详细信息
* bcid: 业务单实例 id
*/
function viewlog( bcid, cstname ){
	daWin({
		width: 900,
		height: 500,
		url: "/sys_common/bizlog/log_manage.php?bcid="+ bcid,
		title: cstname
	});
}

/**添加日志回复
*/
function addreply(lid){
	daWin({
		width:600,
		height:500,
		url: "/sys_common/bizlog/reply_add_item.php?bcid="+ g_bcid +"&lid="+ lid,
		back: function(){
			// loadloglist();
		}
	});
}

var g_num = 0,
	g_loadlock = false;

/**加载日志列表
*/
function loadloglist(){
	if( g_loadlock ) return;
	g_loadlock = true;
	da("#loadingmsg").fadeIn();
	autoframeheight();

	var objlist = da("#listPad");
	// objlist.empty();
	
	da.runDB("/sys_common/bizlog/action/log_get_top20.php", {
		dataType: "json",
		dbsource: "td_website",
		dbfld: "ws_id",
		num: g_num
		
	},function(data){
		if("FALSE"!=data){
			var lids = [];
			
			var loghtml = da("#logtemplet").html();
			
			for(var i=0; i<data.length; i++){
				lids.push(data[i].l_id);
			
				objlist.append(loghtml.replace(/{\w*}/g, 
				function( match, idx, self ){					//替换日志模板内容
					switch(match){
						case "{l_id}":
							return data[i].l_id;
						case "{userico}":
							return data[i].pu_icon?data[i].pu_icon:"/uploads/userico/default.png";
						case "{puname}":
							return data[i].pu_name;
						case "{l_content}":
							return data[i].l_content;
						case "{l_date}":
							return data[i].l_date;
						default:
							return data[i][match.replace(/\{|\}/g, "")];
					}
				}));
			}
			
			g_num += data.length;
			g_loadlock = false;
			da("#loadingmsg").fadeOut();
			autoframeheight();
			
			loadreplylist(lids.join(","));
		}

	},function(msg, code, ex){
		// debugger;
		g_loadlock = false;
		da("#loadingmsg").fadeOut();
	});
}

/**滚动条到底部加载更多数据
*/
function scrollevent(){
	da("#logbox").height(da(da.getRootWin()).height()-60);

	daWheel({
		target: "#logbox",
		down: function(){
			var bottom = da("#logbox").height() + da("#logbox").scrollTop();

			// da.out(da("#logbox").height()+"    "+ da("#logbox").scrollTop()+"    "+ da("#logpad").height())
			if(bottom >= da("#logpad").height())
			{
				loadloglist();
			}
		}
	});
}

daLoader("daMsg,daIframe,daWin,daWheel",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
		loadloglist();
		
		scrollevent();
		// scrolltop("#scrolltop");
		
		daFrame.shandowborder("#shadowbox1", "left,right,bottom,top");
		daFrame.shandowborder("#shadowbox2", "left,right,bottom,top");
		daFrame.shandowborder("#shadowbox3", "left,right,bottom,top");
	});
});