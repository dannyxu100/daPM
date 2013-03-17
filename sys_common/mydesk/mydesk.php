<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?include_once $_SERVER['DOCUMENT_ROOT']."action/logincheck.php";?>
	<title>我的桌面</title>
	<link rel="stylesheet" href="/css/base.css" />
</head>

<body >
	<table style="width:100%;">
		<tr>
			<td style="width:500px;">&nbsp;</td>
			<td style="width:500px; padding:5px;">
				<h3>最新日志</h3>
				<div id="listPad" style="padding:5px;"></div>
				
				<div id="logtemplet" style="display:none;">
					<ul id="log_{l_id}" class="logitem" >
						<div class="ico" >
							<img src="{userico}"/>
							<div class="txt">{puname}</div>
						</div>
						<div class="pl" >
							<div class="pl_img"></div>
						</div>
						<div class="content" >
							<div class="ldate">{l_date}</div>
							{l_content}
						</div>
						<div style="clear:both;"></div>
						<div class="logtoolbar" >
							<a href="javascript:void(0)" onclick="addreply({l_id})">回复</a>
						</div>
						<div id="reply_{l_id}" class="logreply" ></div>
					</ul>
				</div>
				<div id="replytemplet" style="display:none;">
					<ul class="item">
						<div class="ico" >
							<img src="{userico}"/>
							<div class="txt">{puname}</div>
						</div>
						<div class="pr">
							<div class="pr_img"></div>
						</div>
						<div class="content" >
							<div class="rdate">{r_date}</div>
							{r_content}
						</div>
						<div style="clear:both;"></div>
					</ul>
				</div>
			</td>
		</tr>
	</table>
</body>
</html>

<script type="text/javascript" src="/plugin/da/daLoader_source_1.1.js"></script>
<script>

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

/**加载日志列表
*/
function loadloglist(){
	var objlist = da("#listPad");
	objlist.empty();
	da.runDB("/sys_common/bizlog/action/log_get_top20.php", {
		dataType: "json"
		
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
					}
				}));
			}
			
			loadreplylist(lids.join(","));
			autoframeheight();
		}
	},function(msg, code, ex){
		// debugger;
	});
}

daLoader("daMsg,daIframe,daWin",function(){
	da(function(){
		var arrparam = da.urlParams();
		g_bcid = arrparam["bcid"];
		
		loadloglist();
	});
});
</script>