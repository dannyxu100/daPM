function scrolltop(obj){
	var daObj = da(obj);
	if (0 != da(window).scrollTop()) {
		daObj.fadeIn()
	}
	
	da(window).scroll(function(){
		da(".menupad").css("top", da(window).scrollTop()+"px");
		
		if(0 != da(window).scrollTop()){
			daObj.fadeIn();
		}
		else{
			daObj.fadeOut();
		}
	});

	daObj.click(function() {
		da("html,body").act({
			scrollTop: 0
		},100);
	});
}


function viewcase(cid){
	if( "" == cid ){
		// alert("对不起，该表单没有指定数据源。");
		return;
	}

	loading(true);
	
	da("#caseform").html( da("#templet_caseform").html() );
	
	da.setForm( "#caseform", 
	"/sys_common/case/action/case_get_item.php", {
		dataType: "json",
		cid: cid
		
	},function( fld, val, row, ds ){
		return val;
		
	},function( data ){
		loading(false);
		showcase();
		autoframeheight();
		
	},function( msg, code, content ){
		//debugger;
	});
	
}

function showcase(){
	da("#caseview").fadeIn();
	da("#casetype").hide();
}
function hidecase(){
	da("#caseview").fadeOut();
	da("#casetype").fadeIn();
}

var g_curtypeobj;
function loadcase(obj, type ){
	if( g_curtypeobj ){
		da(g_curtypeobj).removeClass("current");
	}
	da(obj).addClass("current");
	g_curtypeobj = obj;

	da("#case_title").text(type);

	var casegrid = da("#case_grid");
	casegrid.empty();
	

	da.runDB("/sys_common/case/action/case2type_get_list.php",{
		dataType: "json",
		type: type
		
	},function(data){
		if("FALSE"!=data){
			for(var i=0; i<data.length; i++){
				casegrid.append([
					'<a class="case_item" href="javascript:void(0)" onclick="viewcase(', data[i].c_id,')">',
						'<div class="case_item_t"></div>',
						'<div class="case_item_content">',
							'<img src="', data[i].c_img?data[i].c_img:"/images/no_img.jpg",'" />',
							'<div class="overlayer"></div>',
							'<div class="title" >', data[i].c_title,'</div>',
							'<div class="text" >', data[i].c_abstract,'</div>',
						'</div>',
						'<div class="case_item_b"></div>',
					'</a>'
				].join(''));
			}
			
			casegrid.append('<div style="clear:both;"></div>');
			autoframeheight();
		}	
	});

}


function loadcasetype(){
	var typelist = da("#menu_items");
	typelist.empty();
	
	da.runDB("/sys_common/case/action/casetype2count_get_list.php",{
		dataType: "json"
		
	},function(data){
		if("FALSE"!=data){
			for(var i=0; i<data.length; i++){
				typelist.append([
					'<a href="javascript:void(0)" onclick="loadcase(this, \'', data[i].type,'\')" >', 
					data[i].type,
					' <span style="color:#fff;font-size:10px;">( ', data[i].count,' )</span></a>'
				].join(''));
			}
		}	
	},function(code,msg,ex){
		// debugger;
	});
}

var g_menutimer = null;
function menuscroll() {
	da("#menu_items").stop(true,true).act({
		marginTop: "-40px"
	}, 
	200, function() {
		da(this).css({ marginTop: "0px" });
		da("a:first", this).appendTo(this);
	});
}

function autoscroll(){
	g_menutimer = setInterval("menuscroll()", 2000);
	
	da("#menu_list").hover(function() {
		if( null != g_menutimer ){
			clearInterval(g_menutimer);
			g_menutimer = null;
		}
		
	}, function(){
		if( null == g_menutimer ){
			g_menutimer = setInterval("menuscroll()", 2000);
		}
	});
}

daLoader("daIframe,daWin,daToolbar,daKey",function(){
	da(function(){
		var winHeight = da(window).height()-50;
		da(".menupad").height( 500 > winHeight ? 500 : winHeight);
		da("#menu_list").height( da(".menupad").height());
		
		daFrame.shandowborder(".menupad", "right");
		scrolltop("#scrolltop");
		
		autoscroll();
		
		loadcasetype();
	});
});
