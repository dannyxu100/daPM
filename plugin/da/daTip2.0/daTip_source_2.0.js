/*
	author:	danny.xu
	date:	2010.12.10
	description:	daTip类(信息提示框)
*/

da.extend({
	
		//判断一个点所处呈现页面的某区域判断
		/*
			pos: 需判断点坐标（pos为null直接返回"center"）		{ left:100, top:200 }
			size; 对象尺寸 														{ width:100, height:200 }
		*/
		inPageArea: function(pos,size){
				if( null == da.isNull( pos, null ) ) return "5";
				
				var da_Win = da(window),
						winWidth = parseInt( da_Win.width(), 10 ) || 0,
						winHeight = parseInt( da_Win.height(), 10 ) || 0;
				
				var d_toLeft = pos.left,
						d_toRight = winWidth - pos.left,
						d_toTop = pos.top,
						d_toBottom = winHeight - pos.top;
				
				var sArea = [];
		  	if( d_toTop>=d_toBottom )	sArea.push( "B" );				//偏下
		  	else	sArea.push( "T" );														//偏上
			  if( d_toRight>=d_toLeft )	sArea.push( "L" );				//偏左
			  else	sArea.push( "R" );														//偏右
		  	
		  	if( undefined == size ) return sArea.join("");

		  	if( size.height >= size.width )			//如果信息框为 长条形
		  		sArea.reverse();
		  	
		  	var nArea = 5;				//默认正中
		  	switch( sArea.join("") ){
		  		case "TL": nArea = "87"; break;
		  		case "LT": nArea = "47"; break;
		  		case "TR": nArea = "89"; break;
		  		case "RT": nArea = "69"; break;
		  		case "BL": nArea = "21"; break;
		  		case "LB": nArea = "41"; break;
		  		case "BR": nArea = "23"; break;
		  		case "RB": nArea = "63"; break;
		  	}
		  	
		  	return nArea;
		}
	
});



/*
	author:	danny.xu
	date:	2011-1-13
	description:	daTip类(信息提示框)
*/
( function( win ){
	var doc = win.document;
	
	/**构造函数
	* @param {PlainObject} tipSetting 用户配置参数
	*/
	var daTip = function( tipSetting ){
			return new daTip.fnStruct.init( tipSetting );
	};
	
	daTip.fnStruct = daTip.prototype = {
			tipObj: null,								//提示框容器对象
			tipId: "",									//提示框DOM对象id
			tipCloseBt: null,						//提示框关闭按钮DOM对象
			tipTarget: null,						//提示目标DOM对象
			tipParentObj: null,					//daTip所处DOM对象
			tipTableObj: null,					//daTip样式table结构 DOM对象
			tipMidObj: null,						//提示框中心容器DOM对象
			tipPointers: null,					//daTip样式指针DOM对象集
			
			tipSetting: {
				title: "",								//daTip标题
				html: "",									//daTip内容HTML，也可以是DOM对象
				target: null,							//提示目标DOM对象
				color: "#f0f0f0",					//提示信息文字颜色
				bg: "#d66500",						//提示框中心背景色
				
				onlyOne: false,						//是否为全局共享
				group: "daTip",						//缓存分组名称
				pointer: "87",						//用户自定义daTip指针方向, 默认"87"(上左)
				events: null,							//daTip绑定事件
				parent: null,							//daTip容器DOM对象
				
				close: true,							//是否显示关闭按钮
				warn: {							
					open: false,
					length: 10,
					delay: 350,
					show: null
				}
			},
			
			tipState: "hide",						//daTip对象的显示状态"hide","show"
			
			warnTimer: null,						//警告动画timer
			
			/**daTip初始化函数
			* @param {PlainObject} tipSetting 用户配置参数
			*/
			init: function( tipSetting ){
				tipSetting = this.tipSetting = da.extend(true, {}, this.tipSetting, tipSetting );
				
				var da_objTarget = da( tipSetting.target ),
						daTipObj = null;
				
				if( tipSetting.onlyOne )
					daTipObj = da.data( win , this.tipSetting.group );												//获取全局共享缓存对象
				else if( 0 < da_objTarget.dom.length )
					daTipObj = da.data( da_objTarget.dom[0] , this.tipSetting.group );				//获取缓存对象
				
				
				if( null != daTipObj ){																											//如果已经存在直接显示
						if( tipSetting.onlyOne ){																								//全局共享，每次显示需要更新提示对象和提示内容
							daTipObj.tipParentObj = da( tipSetting.parent ).dom[0] || doc.body;
							daTipObj.tipTarget = da( tipSetting.target ).dom[0] || null;
					  	daTipObj.tipObj.style.display = "block";
					  	da( daTipObj.tipObj ).css( {width: "100%", height:"100%" } ); 
					  	daTipObj.tipMidObj.innerHTML = tipSetting.html || daTipObj.tipTarget.getAttribute("daTip") || "未定义提示内容。";
					  	
					  	da( daTipObj.tipObj ).css( {width: da(daTipObj.tipTableObj).width(), height:da(daTipObj.tipTableObj).height() } ); 
					  	
						}
						
						daTipObj.show();
						return daTipObj;
				}
				else{																													//如果没有缓存对象就new一个	
						this.tipParentObj = da( tipSetting.parent ).dom[0] || doc.body;
						this.tipTarget = da( tipSetting.target ).dom[0] || null;
						this.tipSetting.html = tipSetting.html || this.tipTarget.getAttribute("daTip") || "未定义提示内容。";
						
						do{
							this.tipId = "daTip"+ ( new Date ).getTime();						//避免重复id
						}
						while( null != doc.getElementById( this.tipId ) );
						
						this.tipPointers = {	
							p8: null,
							p6: null,
							p2: null,
							p4: null
						};
						
						this.create();
						this.show();
						this.bindEvent();
						
						daTip.daTipCache[ this.tipId ] = this;										//放入队列，便于批量操作
					
						da.data( (tipSetting.onlyOne ? win : this.tipTarget), this.tipSetting.group, this);					//压入缓存
					
					return this;
				}
				
				
			},
			
			//提示框DOM创建函数
			create: function(){
					var tipId = this.tipId,
							tipObj = doc.createElement("DIV");
							tipTableObj = null,
							isDOM = ( 1 === this.tipSetting.html.nodeType );				//判断传入的HTML参数是否是DOM对象
					
					
					this.tipParentObj.insertBefore( tipObj, null );
					this.tipObj = tipObj;
					
					tipObj.id = tipId;
					tipObj.style.left = "0px";
					tipObj.style.top = "0px";
					tipObj.className = "daTip";
					tipObj.innerHTML = ['<table id="', tipId, '_tb" class="daTipTable" cellpadding="0" cellspacing="0">',
																'<tr>',
																	'<td class="daTipTL"></td>',
																	'<td class="daTipT">',
																	'<div class="daTipTitle">', this.tipSetting.title, '</div>',
																	'</td>',
																	'<td class="daTipTR"></td>',
																'</tr>',
																'<tr>',
																	'<td class="daTipL"></td>',
																	'<td id="', tipId, '_mid" class="daTipMid">',
																		( isDOM ? "" : this.tipSetting.html ),
																	'</td>',
																	'<td class="daTipR"></td>',
																'</tr>',
																'<tr>',
																	'<td class="daTipBL"></td><td class="daTipB"></td><td class="daTipBR"></td>',
																'</tr>',
															'</table>',
															'<div id="', tipId, '_p8" class="daTipP8"></div>',
															'<div id="', tipId, '_p6" class="daTipP6"></div>',
															'<div id="', tipId, '_p2" class="daTipP2"></div>',
															'<div id="', tipId, '_p4" class="daTipP4"></div>',
															
															'<a id="', tipId, '_CloseBt" class="daTipCloseBt" href="javascript:void(0);" onclick=""></a>',
														].join( "" );
					
					//da.copy(this.tipParentObj.outerHTML);
					
					this.tipPointers.p8 = doc.getElementById( tipId + "_p8" );
					this.tipPointers.p6 = doc.getElementById( tipId + "_p6" );
					this.tipPointers.p2 = doc.getElementById( tipId + "_p2" );
					this.tipPointers.p4 = doc.getElementById( tipId + "_p4" );
					
					this.tipTableObj = tipTableObj = doc.getElementById( tipId + "_tb" );
					this.tipCloseBt = doc.getElementById( tipId + "_CloseBt" );
					this.tipMidObj = doc.getElementById( tipId + "_mid");
					
					if( isDOM )
						this.tipMidObj.insertBefore( this.tipSetting.html, null );
					
					this.color();
			
					//根据信息框内容，调整信息框容器DIV对象的尺寸
					var da_tipTableObj = da( tipTableObj );
					da( this.tipObj ).css( {width: da_tipTableObj.width(), height:da_tipTableObj.height() } ); 
			},
			
			//daTip事件绑定函数
			bindEvent: function(){
				// if( this.tipSetting.events )
					// da.eventBind( this.tipObj, this.tipSetting.events);
				
				// var context = this;
				// da.eventBind( this.tipCloseBt, {click: function(){
					// context.hide();
				// }} );
				
				var context = this;
				da(this.tipCloseBt).bind("click",function(){
					context.hide();
				});
				
			},
			
			/**获得daTip对象的显示位置
			* @param {PlainObject} posTarget 提示目标对象位置点，如：{left: 10, top: 20}
			* @param {PlainObject} sizeTarget 提示目标对象的尺寸，如：{width: 10, height: 20}
			*/
			getPos: function( posTarget, sizeTarget ){
					if( !posTarget ) {alert("daTip温馨提示: 需要提供提示目标对象，或提示目标的位置。"); return;}; 
					sizeTarget = sizeTarget || {width:0, height:0};
					
					var da_tipObj = da( this.tipObj ),
							sizeTip = { width: da_tipObj.width(), height: da_tipObj.height() },
							pNum = da.inPageArea( posTarget, sizeTip ),
							isNoPointer = false,
							pointerObj = null,
							tmp;
					
					if( this.tipSetting.pointer ){
						if( null === this.tipSetting.pointer.match(/no|5/g) ){
							pNum = this.tipSetting.pointer || pNum;
	
						}
						else{
							isNoPointer = true;
							pNum = this.tipSetting.pointer.replace( "no", "" ) || pNum;
						}
					
					}
					tmp = "p" + pNum.match(/8|6|2|4/g);
					
					for( var n in this.tipPointers ){
						if( !isNoPointer && tmp === n )
							da( this.tipPointers[ n ] ).css("display","block");
						else
							da( this.tipPointers[ n ] ).css("display","none");
						
					}
					
					pointerObj = this.tipPointers[ tmp ];
					
					if( !isNoPointer ) da( pointerObj ).css("display","block");

			  	switch( pNum ){												//根据箭头的指向，调整摆放信息框的位置
			  		case "8":
			  			pointerObj.style.left = ( sizeTip.width/2 - 13 ) + "px";
			  			posTarget.top += ( sizeTarget.height + (!isNoPointer && 12 ) );
							posTarget.left += ( sizeTarget.width/2 - sizeTip.width/2 );
			  			break;
			  		case "6":
			  			pointerObj.style.top = ( sizeTip.height/2 - 15 ) + "px";
			  			posTarget.top += ( sizeTarget.height/2 - sizeTip.height/2 );
							posTarget.left -= ( sizeTip.width + (!isNoPointer && 12 ) );
			  			break;
			  		case "2": 
			  			pointerObj.style.left = ( sizeTip.width/2 - 13 ) + "px";
							posTarget.top -= ( sizeTip.height + (!isNoPointer && 12 ) );
							posTarget.left += ( sizeTarget.width/2 - sizeTip.width/2 );
			  		  break;
			  		case "4": 
			  			pointerObj.style.top = ( sizeTip.height/2 - 15 ) + "px";
			  			posTarget.top += ( sizeTarget.height/2 - sizeTip.height/2 );
							posTarget.left += ( sizeTarget.width + (!isNoPointer && 12 ) );
							break;
			  		case "87":
			  			pointerObj.style.left = "13px";
			  			posTarget.top += ( sizeTarget.height + 12 );
							posTarget.left -= 26;
			  			break;
			  		case "89": 
			  			pointerObj.style.right = "13px";
				  		posTarget.top += ( sizeTarget.height + 12 );
							posTarget.left -= ( sizeTip.width - 30 );
			  			break;
			  		case "69": 
			  			pointerObj.style.top = "15px";
							posTarget.top -= 30;
							posTarget.left -= ( sizeTip.width + 12 );
							break;
			  		case "63": 
			  			pointerObj.style.bottom = "15px";
							posTarget.top -= ( sizeTip.height - 30 );
							posTarget.left -= ( sizeTip.width + 12 );
							break;
			  		case "23": 
			  			pointerObj.style.right = "14px";
							posTarget.top -= ( sizeTip.height + 12 );
							posTarget.left -= ( sizeTip.width - 30 );
			  		  break;
			  		case "21": 
			  			pointerObj.style.left = "15px";
							posTarget.top -= ( sizeTip.height + 12 );
							posTarget.left -= 26;
							break;
			  		case "41": 
			  			pointerObj.style.bottom = "15px";
							posTarget.top -= ( sizeTip.height - 30 );
							posTarget.left += ( sizeTarget.width + 12 );
							break;
			  		case "47": 
			  			pointerObj.style.top = "15px";
							posTarget.top -= 30;
							posTarget.left += ( sizeTarget.width + 12 );
							break;
						case "5":
							var da_Win = da(window),
									winWidth = parseInt( da_Win.width(), 10 ) || 0,
									winHeight = parseInt( da_Win.height(), 10 ) || 0;
								
							posTarget = {};
							posTarget.top = ( winHeight - sizeTip.height ) / 2;
							posTarget.left = ( winWidth - sizeTip.width ) / 2;
							
							break;
							
			  	}
			  	return posTarget;
			  	
			},
			
			//显示提示框
			show: function(){
				this.tipObj.style.display = "block";
				this.tipState = "show";												//改变daTip的显示状态
				
				var da_targetObj = da(this.tipTarget),
						posTarget = da_targetObj.pos(),
						sizeTarget = {width: da_targetObj.width(), height: da_targetObj.height()},
						posTip = this.getPos( posTarget, sizeTarget );
			
				this.pos( posTip );
			
				if( !this.tipSetting.close )
					this.tipCloseBt.style.display = "none";
				
				if( this.tipSetting.warn.open )								//如果需要播放警告动画
					this.warn();
					
			},
			
			//隐藏提示框
			hide: function(){
					da( this.tipObj ).css( "display","none" );
					this.tipState = "hide";																//改变daTip的显示状态
					
					if( this.tipSetting.warn.open )												//如果正在播放警告动画，就停止
						this.warn(false);
			},
			
			//设置tip的位置
			pos: function( pos ){
					var da_tipObj = da( this.tipObj );
					// da_tipObj.offset({ left:pos.left, top:pos.top });
					da_tipObj.css({ left:pos.left+"px", top:pos.top+"px" });
			},
			
			/**daTip跟随鼠标，设置显示位置
			*/
			followMouse: function( evt ){
					var posMouse = {left: evt.pageX, top: evt.pageY};
					
					switch(this.tipSetting.pointer){
						case "87":
						case "89":
							posMouse.top += 13;
							break;
						case "47":
						case "41":
							posMouse.left += 13;
							break;
						case "69":
						case "63":
							posMouse.left -= 13;
							break;
						case "21":
						case "23":
							posMouse.top -= 13;
							break;
						case "5":
							posMouse.top += 13;
							posMouse.left += 13;
							break;
					}
					
					this.pos( this.getPos( posMouse ) );
			},
			
			//设置tip背景颜色
			color: function( bg, sColor ){
				if( undefined !== bg )	this.tipSetting.bg = bg;
				if( undefined !== sColor )	this.tipSetting.color = sColor;
				
				this.tipMidObj.style.background = this.tipSetting.bg;
				this.tipMidObj.style.color = this.tipSetting.color;
			},
			
			/**警示动画
			* @param {boolean} param 是否停止动画播放
			*/
			warn: function( param ){
				if( false === param && this.warnTimer ) {
					clearTimeout( this.warnTimer );											 //停止播放警告动画
					return;
				}
				
				var context = this,
						fnShow = null,
						step = 1;
				
				if( da.isFunction( param ) )
					this.tipSetting.warn.show = param;
				fnShow = this.tipSetting.warn.show;
				
				if( this.warnTimer ) clearTimeout( this.warnTimer );	//清除前一次调用动画的timer
				
				this.warnTimer = setInterval(function(){
						if( fnShow ) 
							fnShow.call( context, step, context.tipMidObj );
						else{
							switch(step){
								case 1:
								case 3:
									var posTip = da( context.tipObj ).pos();
									context.pos({left: posTip.left, top: posTip.top-5 });
									context.color( "#f17303" );
									break;
								case 2: 
								case 4: 
									var posTip = da( context.tipObj ).pos();
									context.pos({left: posTip.left, top: posTip.top+5 });
									context.color( "#d66500" );
									break;
							}
						}
						
						if( context.tipSetting.warn.length < ++step ) step = 1;
						
				}, this.tipSetting.warn.delay);
			}
			
	};
	
	daTip.daTipCache = {};
	
	/**跟随光标的tip
	* @param {PlainObject} tipSetting 用户配置参数
	*/
	daTip.cursor = function( tipSetting ){
			var da_targetObj = da( tipSetting.target ),
					daTipObj = null;
					
			if( 0 == da_targetObj.dom.length ){ alert("daTip温馨提示：跟随光标的tip,需要设置被提示DOM对象。"); return; }
			
			tipSetting.close = false;												//不需要显示关闭按钮
						
			da_targetObj.bind("mouseover", function(evt){
					daTipObj = daTip( tipSetting );
					daTipObj.followMouse( evt );
				
			}).bind("mousemove",function(evt){
					if( daTipObj ){
						daTipObj.followMouse( evt );
					}
					
			}).bind("mouseout",function(evt){
					if(daTipObj) daTipObj.hide();
					
			});
			
	};
	
	/**显示所有的/分组的daTip信息框
	* @param {String} group 分组名称
	*/
	daTip.show = function( group ){
		for( var id in daTip.daTipCache){
			if( group && group != daTip.daTipCache[ id ].tipSetting.group ) continue;
			if( "hide" == daTip.daTipCache[ id ].tipState ) 
				daTip.daTipCache[ id ].show();
		}
	};
	
	/**隐藏所有的/分组的daTip信息框
	* @param {String} group 分组名称
	*/
	daTip.hide = function( group ){
		for( var id in daTip.daTipCache){
			if( group && group != daTip.daTipCache[ id ].tipSetting.group ) continue;
			if( "show" == daTip.daTipCache[ id ].tipState ) 
				daTip.daTipCache[ id ].hide();
		}
	};
	
	
	
	//对象继承da类属性
	daTip.fnStruct.init.prototype = daTip.prototype;
	
	
	
	//全局变量
	win.daTip = win.datip = daTip;
	
} )( window );
