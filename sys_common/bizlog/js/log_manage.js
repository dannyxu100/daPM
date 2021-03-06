﻿var g_bcid = "",
	g_title = "";

/**添加日志
*/
function addlog(){
	daWin({
		width:600,
		height:600,
		url: "/sys_common/bizlog/log_add_item.php?bcid="+ g_bcid,
		back: function(){
			loadloglist();
		}
	});
}

/**添加日志回复
*/
function addreply(bcid, lid){
	daWin({
		width:550,
		height:500,
		url: "/sys_common/bizlog/reply_add_item.php?bcid="+ bcid +"&lid="+ lid,
		back: function(){
			loadloglist();
		}
	});
}

/**加载日志列表
*/
function loadreplylist(){
	da.runDB("/sys_common/bizlog/action/reply_get_list.php", {
		dataType: "json",
		bcid: g_bcid
		
	},function(data){
		if("FALSE"!=data){
			var replyhtml = da("#replytemplet").html();
			
			for(var i=0; i<data.length; i++){
				da( "#reply_"+ data[i].r_lid ).append(replyhtml.replace(/{\w*}/g, 
				function( match, idx, self ){					//替换日志模板内容
					switch(match){
						case "{r_bcid}":
							return data[i].r_bcid;
						case "{r_lid}":
							return data[i].r_lid;
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

/**加载日志列表
*/
function loadloglist(){
	var objlist = da("#listPad");
	objlist.empty();
	da.runDB("/sys_common/bizlog/action/log_get_list.php", {
		dataType: "json",
		bcid: g_bcid
		
	},function(data){
		if("FALSE"!=data){
			var loghtml = da("#logtemplet").html();
			
			for(var i=0; i<data.length; i++){
				objlist.append(loghtml.replace(/{\w*}/g, 
				function( match, idx, self ){					//替换日志模板内容
					switch(match){
						case "{dot}":
							return 0==i?'<img src="/images/dot1.png" />':'<img src="/images/dot0.png" />';
						case "{l_bcid}":
							return data[i].l_bcid;
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
					}
				}));
			}
			autoframeheight();
			loadreplylist();
		}
	},function(msg, code, ex){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		g_title = arrparam["title"];
		
		if( g_title ){
			da("#log_title").text( decodeURIComponent(g_title) );
		}
		loadloglist();
	});
});