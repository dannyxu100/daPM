/*
	author: danny.xu
	date:		2011-4-30 14:38:52
	description:	分页类daPage脚本文件

*/

(function( win ){
 
var doc = win.document;
	
var daPage = function( pSetting ){
		return new daPage.fnStruct.init( pSetting );
};
	
daPage.fnStruct = daPage.prototype = {
	version: "daPage 1.0  \n\nauthor: danny.xu\n\ndate: 2011-4-30 14:43:25 \n\nThank you!!!",
	
	pObj: null,										//分页条容器对象
	pParentObj: null,							//分页条父节点
	
	error: "",										//错误信息
	
	pSetting: {
		parent: null,								//分页条父节点Id
		countPage:	0,							//总页数
		countList:	10,							//可显示数字链接按钮个数
		
		first:	1,									//第一个数字链接按钮编号
		last: 10,										//最后一个数字链接按钮编号
		
		firstHTML: '« 上一页',
		lastHTML: '下一页 »',

		omitHTML: "...",							
		
		current: 1,									//当前所处页数
		prev: 1,										//上一页
		next: 2,										//下一页
		
		css: {											//样式
			bar: "daPage",
			current: "current",
			disablePrev: "current prev",
			disableNext: "current next",
			omit: "omit"
		},

		showgoto: false,						//直接跳转
		showStart: true,						//显示首尾链接按钮
		showEnd: true,
		countStartAndEnd: 2,				//显示首尾边界页面链接按钮的个数
		
		click: null,								//按钮点击事件
		load: null
	},
	
	state:{
		showGoto: true,
		showStart: true,
		showEnd: true
	},
	
	//daPage分页对象初始化函数
	init: function( pSetting ){
		pSetting = this.pSetting = da.extend( {}, this.pSetting, pSetting );
		
		this.pParentObj = da( pSetting.parent );
		this.pParentObj = 0 < this.pParentObj.dom.length ? this.pParentObj.dom[0] : doc.body;
		
		this.click = pSetting.click || this.click;
		this.load = pSetting.load || this.load;
		
		if( !this.create() ){ alert("温馨提示：daPage创建失败。\n\n" + this.error + "。"); return null;};
		
		this.load.call( this );
		
		return this;
	},
	
	//修正daPage分页对象的设置参数
	reviseSetting: function(){
		var pSetting = this.pSetting,
				toStart, toEnd;

		pSetting.current = (( 1 > pSetting.current || pSetting.countPage < pSetting.current ) ? 1 : pSetting.current);
		toStart = pSetting.current,
		toEnd = pSetting.countPage - pSetting.current + 1;
				
		if( 0 > pSetting.countPage ) {
			this.error = "error: 分页总页数不能<=0";
			return false;
		}
		
		pSetting.prev = 1 > pSetting.current ? 1 : pSetting.current - 1;																		//计算上一页、下一页
		pSetting.next = pSetting.countPage < pSetting.current ? pSetting.countPage : pSetting.current + 1;

		
		if( pSetting.countList >= pSetting.countPage ){				//可显示页数 >= 总页数
			pSetting.first = 1;
			pSetting.last = pSetting.countList = pSetting.countPage;
			
			this.state.showStart = false;
			this.state.showEnd = false;
		}
		else{																									//可显示页数 < 总页数
			var isStart = toStart < pSetting.countList,									//前面的页数不够显示一轮
					isEnd = toEnd < pSetting.countList,											//后面的页数不够显示一轮
					isMidNotEnough = isStart && isEnd,											//前后页数都不够一轮显示
					isMidEnough = !isStart && !isEnd;												//前后页数都足够显示一轮

			if( ( isMidNotEnough && toStart < toEnd) || ( isStart && !isEnd ) ){							//前后页数都不够，但前面的页数比较少 或 前面的页数不够一轮，并且后面的页数足够显示一轮
					pSetting.first = 1;
					pSetting.last = pSetting.countList;
					
					this.state.showEnd = pSetting.showEnd && true;
					this.state.showStart = !this.state.showEnd;
					//alert(1+"："+this.state.showStart+"\n"+this.state.showEnd);
			}
			else if( ( isMidNotEnough && toStart > toEnd) || ( !isStart && isEnd ) ){					//前后页数都不够，但后面的页数比较少 或 后面的页数不够一轮，并且前面的页数足够显示一轮
					pSetting.first = pSetting.countPage - pSetting.countList + 1;
					pSetting.last = pSetting.countPage;
					
					this.state.showStart = pSetting.showStart && true;
					this.state.showEnd = !this.state.showStart;
					//alert(2+"："+this.state.showStart+"\n"+this.state.showEnd);
			}
			else if( isMidEnough ) {
					var mid = parseInt( pSetting.countList/2 );
					pSetting.first = pSetting.current - mid;
					pSetting.last = pSetting.current + ( pSetting.countList - mid );
					
					this.state.showStart = pSetting.showStart && true;
					this.state.showEnd = pSetting.showEnd && true;
					//alert(3);
					
			}
			
		}
		//alert("first:"+pSetting.first+"\n\nlast:"+pSetting.last);
		return true;
	},
	
	//创建分页按钮条
	create: function(){
		if( !this.reviseSetting() ) return false;
		
		var pSetting = this.pSetting,
				pParentObj = this.pParentObj,
				oldObj = this.pObj,
				pObj = doc.createElement("div");
		
		if( null !== oldObj )
			pParentObj.removeChild( oldObj );
		
		pObj.className = pSetting.css.bar;
		
		this.addLink( pObj, "PREV", pSetting.prev );										//添加前一页按钮
		this.addStartLink( pObj );																			//添加开始几页按钮
		
		for	( var n=pSetting.first,len=pSetting.last; n<=len; n++ ){
				this.addLink( pObj, "NUM", n );															//添加数字链接按钮

		}  
		
		this.addEndLink( pObj );																				//添加最后几页按钮
		this.addLink( pObj, "NEXT", pSetting.next );										//添加后一页按钮

		if( pSetting.showgoto)
			this.addGoto( pObj );

		//pParentObj.innerHTML = "";
		pParentObj.insertBefore( pObj, pParentObj.firstChild );
		this.pObj = pObj;

		return true;
	},
	
	//添加前几页的快捷数字链接
	/*
		objBar: 按钮容器对象
	*/
	addStartLink: function( objBar ){
		if( !this.state.showStart ) return;
		
		var pSetting = this.pSetting,
				n = 1,
				len = ( pSetting.first > pSetting.countStartAndEnd ? pSetting.countStartAndEnd : pSetting.first - 2 ) ; 			//前几页的快捷数字链接个数,要向前推2页

		for(; n<=len; n++){
			this.addLink( objBar, "NUM", n );					//添加数字链接按钮
		}
		this.addLink( objBar, "OMIT" );							//添加"..."省略号
	},
	
	//添加最后几页的快捷数字链接
	/*
		objBar: 按钮容器对象
	*/
	addEndLink: function( objBar ){
		if( !this.state.showEnd ) return;
		
		var pSetting = this.pSetting,
				toEnd = pSetting.countPage - pSetting.last,
				n = ( toEnd < pSetting.countStartAndEnd ? pSetting.last + 2 : (pSetting.countPage - pSetting.countStartAndEnd) + 1 ), 			//最后几页的快捷数字链接个数,要向后推2页
				len = pSetting.countPage;
//		alert(toEnd);
//		alert(n);
//		alert(len);
		this.addLink( objBar, "OMIT" );							//添加"..."省略号
		for(; n<=len; n++){
			this.addLink( objBar, "NUM", n );					//添加数字链接按钮
		}
	},
	
	//追加Link按钮
	/*
		objBar: 按钮容器对象
		type: 可选"PREV"|"NUM"|"NEXT"|"OMIT"
		num: 页数
	*/
	addLink: function( objBar, type, num ){
		var pSetting = this.pSetting,
				objLink;
		
		switch( type ){
				case "PREV":
					if( 1 > num ){
						objLink = doc.createElement("span");
						objLink.className = pSetting.css.disablePrev;
					}
					else{
						objLink = doc.createElement("a");
						objLink.href = "javascript:void(0)";
					}
					objLink.innerHTML = pSetting.firstHTML;
					
					break;
					
				case "NUM":
					if( pSetting.current == num ){
						objLink = doc.createElement("span");
						objLink.className = pSetting.css.current;
					}
					else{
						objLink = doc.createElement("a");
						objLink.href = "javascript:void(0)";
					}
					
					objLink.innerHTML = num;
					
					break;
					
				case "NEXT":
					if( pSetting.countPage < num ){
						objLink = doc.createElement("span");
						objLink.className = pSetting.css.disableNext;
					}
					else{
						objLink = doc.createElement("a");
						objLink.href = "javascript:void(0)";
					}
					objLink.innerHTML = pSetting.lastHTML;
					
					break;
					
				case "OMIT":
					objLink = doc.createElement("span");
					objLink.className = pSetting.css.omit;
					objLink.innerHTML = pSetting.omitHTML;
					
					break;
					
		}
		
		if( "A" === objLink.tagName.toUpperCase() ){				//绑定Link按钮点击事件
				var context = this;
				da( objLink ).bind("click",function(){					
					context.changePage( this, type, num );
				});
		}
		
		objBar.insertBefore( objLink );											//追加Link按钮
		
	},
	
	addGoto: function( pObj ){
		var context = this,
				objInput = doc.createElement("input"),
				objSelect, objOption, n;
		objInput.type = "text";
		objInput.value = "0";
		objInput.style.cssText = "width:50px;height:22px;margin-right:3px;";
		
		da( objInput ).bind( "change" , function() { 
			context.changePage( this, "NUM", this.value );
		});
		
		pObj.insertBefore(objInput);
		
		objInput = doc.createElement("input");
		objInput.type = "button";
		objInput.value = "跳转";
		objInput.style.cssText = "width:45px;height:22px;margin-right:3px;";
		pObj.insertBefore(objInput);
		
		objSelect = doc.createElement("select");
		objSelect.style.cssText = "width:80px;height:22px;margin-right:3px;";
		
		for( var i=1; i<30; i++ ){
			n = ( i* this.pSetting.countList );
			if( n > this.pSetting.countPage ) break;
			
			objOption = doc.createElement("option");
			objOption.innerHTML = "第 " + n + " 页" ;
			objOption.value = n;
			objSelect.insertBefore(objOption);
		}
		
		da( objSelect ).bind("click",function(){	
			alert($(this).children('option:selected').val());  //弹出select的值
			context.changePage( this, "NUM", this.value );
		});
		
		pObj.insertBefore(objSelect);
	},
	
	//Link按钮点击改变页面
	/*
		objLink: link对象
		type: 可选"PREV"|"NUM"|"NEXT"|"OMIT"
		num: 页数
	*/
	changePage: function( objLink, type, num ){
		this.pSetting.current = num;
		this.create();
		
		this.click.call( objLink, type, num );

	},
	
	//用户自定义点击事件
	/*
		type: 可选"PREV"|"NUM"|"NEXT"|"OMIT"
		num: 页数
		
		this:	link对象
	*/
	click: function( type, num ){
		//TODO:用户自定义事件函数，可以重载这个函数，实现自定义操作
		//alert( num );
	},

	
	//工具条第一次加载完毕
	/*
	*/
	load: function(){
		//TODO:用户自定义事件函数，可以重载这个函数，实现自定义操作
		//alert( num );
	}
}

daPage.fnStruct.init.prototype = daPage.prototype;

win.daPage = daPage;

})(window);