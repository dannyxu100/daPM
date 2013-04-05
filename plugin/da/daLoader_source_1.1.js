/**daLoader
*前端资源颗粒化管理
* @author danny.xu
* @version daLoader1.0 2012-4-26
*/

(function( win, undefined ){
var doc = win.document,
	head = doc.head || doc.getElementsByTagName('head')[0];

var daLoader = (function(){
	
	/**daLoader类构造函数
	*/
	var daLoader = function( setting ){
		if( "string" === typeof setting || "function" === typeof setting ){
			daLoader.ready.apply( this, arguments );
			return;
		}
	
		return new daLoader.fnStruct.init( setting );
	};

	daLoader.fnStruct = daLoader.prototype = {
		version: "daLoader v1.0 \n author: danny.xu \n date: 2012-4-26",
		//TODO:成员属性
		setting: {},
		
		init: function( setting ){
			setting = this.setting = da.extend( {}, this.setting, setting );
		}
		//TODO:成员函数
	};

	daLoader.fnStruct.init.prototype = daLoader.prototype;			//模块通过原型实现继承属性
	
	daLoader.mapfile = {};
	daLoader.queue = [];
	daLoader.waiting = {};
	daLoader.finished = {};
	
	
	/**预加载文件函数
	*/
	daLoader.loadfile = function(path, type, charset, fn) {
		if( daLoader.waiting[path] ) {													//重复引用，监听判断
			if(fn) {
				/* 
				da.timer( 1, function( path, type, charset, fn ) {
					daLoader.loadfile( path, type, charset, fn );
				}, path, type, charset, fn );
				 */
				setTimeout(function() {
					daLoader.loadfile( path, type, charset, fn );
				},1);
				return;
			}
			return;
		}
		if(daLoader.finished[path]) {
			fn && fn();
			
			return;
		}
		
		daLoader.waiting[path] = true;													//开始加载,标记waiting
		
		var tmp = path.split('?')[0];											//去参数得到纯文件路径
		type = type || tmp.toLowerCase().substring(tmp.lastIndexOf('.')+1);		//获得文件类型
		charset = charset || "utf-8";
		
		var nodeObj;							//创建元素
		
		if( 'css' === type ) {
			nodeObj = doc.createElement('link');
			nodeObj.type = 'text/css';
			nodeObj.rel = 'stylesheet';
			nodeObj.href = path;
			
			daLoader.waiting[path] = false;			//css默认为异步加载，所以直接设置为完成状态
			daLoader.finished[path] = true;
			
			head.insertBefore( nodeObj, null );
			fn && fn();
			
			return;								//直接退出，不再执行下面的代码
		}
		else if( 'js' === type ) {
			nodeObj = doc.createElement('script');
			nodeObj.type = 'text/javascript';
			nodeObj.src = path;
			nodeObj.async = 'true';				//如果支持的话，设置异步加载属性
			if( charset )
				nodeObj.charset = charset;
		} 
		
		nodeObj.onload = nodeObj.onreadystatechange=function() {
			if (!this.readyState || this.readyState==='loaded' || this.readyState==='complete') {
				daLoader.waiting[path] = false;		//完成加载
				daLoader.finished[path] = true;
				
				fn && fn();
				
				nodeObj.onload = nodeObj.onreadystatechange = null;			//清除加载监听事件
			}
		};

		nodeObj.onerror = function() {			//可能路径有误，错误结束加载
			daLoader.waiting[path] = false;
			throw new Error( path+ "加载失败" );
			fn && fn();
			
			nodeObj.onerror = null;
		};
	
		head.insertBefore( nodeObj, null );
	};
	
	/**待加载文件队列处理函数
	*/
	daLoader.handle = function( queue, fn ) {
		var count = queue.length;
		
		var fnLast = function() {
			if( 0 == --count ) fn && fn();
		};
		
		var setting, arrNeed;
		for(var i=0,len=queue.length; i<len; i++) {
			setting = daLoader.mapfile[ queue[i] ];
			
			if( !setting )
				throw new Error( "错误: 无法引用"+ queue[i] +" 模块，"+ queue[i] +"未定义。" );
			
			if( setting.need ) {											//需要依赖关系文件
				arrNeed = setting.need.split(",");

				daLoader.handle(arrNeed, (function(setting) {
					return function() {
						daLoader.loadfile( setting.path, setting.type, setting.charset, fnLast);
					}
				})(setting));
			}
			else {															//没有依赖
				daLoader.loadfile( setting.path, setting.type, setting.charset, fnLast);
			}
		}
	};
	
	/**添加预加载类
	*/
	daLoader.def = function(name, setting){
		if(!name || !setting || !setting.path) return;
		daLoader.mapfile[name] = setting;
	};
	
	/**引入类
	*/
	daLoader.include = function( sclass ){
		if( !sclass ) return;
		daLoader.queue = daLoader.queue.concat(sclass.split(","));
	};
	
	
	/**引入文件加载完毕回调
	*/
	daLoader.ready = function( sclass, fn ){
		if( "string" === typeof sclass ){
			daLoader.include( sclass );
		}
		else{
			fn = sclass;
		}
		
		daLoader.handle( daLoader.queue, function(){
			daLoader.queue = [];
			fn && fn(); 
		
		});
	};
	
	
	return daLoader;
})();


win.daLoader = daLoader;

})(window);



//模块定义
(function(){
var _p = "/plugin/da";

//-------------------------------------
daLoader.def('da_CSS', {path: _p+'/da/da.css' });
daLoader.def('da', {path: _p+'/da/da_source_1.3.6.js', type:'js', charset:'utf-8', need:"da_CSS" });		//核心库
//-------------------------------------
daLoader.def('daPage_CSS', {path: _p+'/daPage/daPage.css'});
daLoader.def('daPage', {path: _p+'/daPage/daPage.js', need:"da,daPage_CSS" });								//分页类
daLoader.def('daTable_CSS', {path: _p+'/daTable2.0/daTable.css'});
daLoader.def('daTable', {path: _p+'/daTable2.0/daTable_source_2.1.js', need:"da,daPage,daTable_CSS" });		//数据集类
daLoader.def('daExcel_CSS', {path: _p+'/daExcel/daExcel.css'});
daLoader.def('daExcel', {path: _p+'/daExcel/daExcel_source.js', need:"da,daExcel_CSS" });					//Excel操作类
//-------------------------------------
daLoader.def('daTreeCore', {path: _p+'/daTreeCore/daTreeCore_source.js', need:"da" });					//内存树类
daLoader.def('daDrag', {path: _p+'/daDrag/daDrag_source.js', need:"da" });								//拖拽操作类
daLoader.def('daWheel', {path: _p+'/daWheel/daWheel_source.js', need:"da" });								//滚轮操作类
daLoader.def('daKey', {path: _p+'/daKey/daKey_source.js', need:"da" });									//键盘操作类
//-------------------------------------
daLoader.def('daFx', {path: _p+'/daFx/daFx_source.js', need:"da" });										//动画操作类
daLoader.def('daGif', {path: _p+'/daFx/daGif_source.js', need:"da,daFx" });								//逐帧动画类
//-------------------------------------
daLoader.def('daSVG', {path: _p+'/daCanvas/daSVG_source.js', need:"da" });
daLoader.def('daVML', {path: _p+'/daCanvas/daVML_source_1.1.2.js', need:"da" });
daLoader.def('daCanvas', {path: _p+'/daCanvas/daCanvas_source.js', need:"da,daVML,daSVG" });				//绘图类
daLoader.def('daGuide', {path: _p+'/daGuide/daGuide_source.js', need:"da,daCanvas" });					//向导类
//-------------------------------------
daLoader.def('daTreeCore', {path: _p+'/daTreeCore/daTreeCore_source.js', need:"da" });							//内存树类
daLoader.def('daTreeView_CSS', {path: _p+'/daTreeView/daTreeView.css'});
daLoader.def('daTreeView', {path: _p+'/daTreeView/daTreeView_source.js', need:"da,daTreeCore,daTreeView_CSS" });	//视图树类
//-------------------------------------
daLoader.def('daLoading_CSS', {path: _p+'/daLoading/daLoading.css'});
daLoader.def('daLoading', {path: _p+'/daLoading/daLoading_source.js', need:"da,daLoading_CSS" });				//Loading类
//-------------------------------------
daLoader.def('daMsg_CSS', {path: _p+'/daMsg/daMsg.css'});
daLoader.def('daMsg', {path: _p+'/daMsg/daMsg_source.js', need:"da,daFx,daMsg_CSS" });						//消息类
//-------------------------------------
daLoader.def('daIframe', {path: _p+'/daIframe/daIframe_source_1.3.js', need:"da,daFx,daLoading" });			//缓存框架类
//-------------------------------------
daLoader.def('daFrame_CSS', {path: _p+'/daFrame/daFrame.css'});
daLoader.def('daFrame', {path: _p+'/daFrame/daFrame_source.js', need:"da,daFx,daDrag,daWheel,daLoading,daFrame_CSS" });		//容器框架类
//-------------------------------------
daLoader.def('daWin_CSS', {path: _p+'/daWin/daWin.css' });
daLoader.def('daWin', {path: _p+'/daWin/daWin_source_1.2.js', need:"da,daFrame,daWin_CSS" });					//窗口 控件类


//-------------------------------------
daLoader.def('daButton_CSS', {path: _p+'/daButton/daButton.css' });
daLoader.def('daButton', {path: _p+'/daButton/daButton_source.js', need:"da,daButton_CSS" });					//按钮 控件类
//-------------------------------------
daLoader.def('daToolbar_CSS', {path: _p+'/daToolbar/daToolbar.css' });
daLoader.def('daToolbar', {path: _p+'/daToolbar/daToolbar_source.js', need:"da,daToolbar_CSS" });				//工具条(分组按钮) 控件类
//-------------------------------------
daLoader.def('daOption_CSS', {path: _p+'/daOption/daOption.css' });
daLoader.def('daOption', {path: _p+'/daOption/daOption_source.js', need:"da,daGif,daOption_CSS" });			//可选项 控件类
//-------------------------------------
daLoader.def('daList_CSS', {path: _p+'/daList/daList.css' });
daLoader.def('daList', {path: _p+'/daList/daList_source.js', need:"da,daFx,daKey,daFrame,daList_CSS" });		//列表 控件类
//-------------------------------------
daLoader.def('daSelect_CSS', {path: _p+'/daSelect/daSelect.css' });
daLoader.def('daSelect', {path: _p+'/daSelect/daSelect_source_2.0.js', need:"da,daGif,daList,daSelect_CSS" });//下拉框 控件类
//-------------------------------------
daLoader.def('daTab_CSS', {path: _p+'/daTab2.0/daTab.css' });
daLoader.def('daTab', {path: _p+'/daTab2.0/daTab_source.js', need:"da,daTab_CSS" });								//Tab按钮 控件类
//-------------------------------------
daLoader.def('daTip_CSS', {path: _p+'/daTip2.0/daTip2.0.css' });
daLoader.def('daTip', {path: _p+'/daTip2.0/daTip_source_2.0.js', need:"da,daTip_CSS" });								//ToolTip类
daLoader.def('daMenu', {path: _p+'/daTip2.0/daMenu_source2.0.js', need:"da,daTip" });								//右键菜单类
//-------------------------------------
daLoader.def('daLunar', {path: _p+'/daDate_3.0/daLunar_source.js', need:"da" });	
daLoader.def('daDate_CSS', {path: _p+'/daDate_3.0/daDate.css' });
daLoader.def('daDate', {path: _p+'/daDate_3.0/daDate_source.js', need:"da,daLunar,daDate_CSS" });			//日期控件类
//-------------------------------------
daLoader.def('daCalendar_CSS', {path: _p+'/daCalendar/daCalendar.css' });
daLoader.def('daCalendar', {path: _p+'/daCalendar/daCalendar_source.js', need:"da,daTip,daCalendar_CSS" });	//日历控件类
//-------------------------------------
daLoader.def('daInput_CSS', {path: _p+'/daInput/daInput.css' });
daLoader.def('daInput', {path: _p+'/daInput/daInput_source.js', need:"da,daGif,daKey,daList,daInput_CSS" });	//智能输入框 控件类
//-------------------------------------
daLoader.def('daUI', {path: _p+'/daUI/daUI_source.js', 
need:"da,daButton,daInput,daOption,daSelect,daDate,daTip,daKey" });			//daUI接口



//-------------------------------------
daLoader.def('daQuery', {path: _p+'/daQuery/daQuery.js', need:"da" });										//组合查询 控件类
daLoader.def('daValid', {path: _p+'/daValid/daValid_source.js', need:"da" });							//数据验证类
//-------------------------------------
daLoader.def('daMap_CSS', {path: _p+'/daMap/daMap.css' });
daLoader.def('daMap', {path: _p+'/daMap/daMap.js', need:"da,daFx,daDrag,daWheel,daKey,daLoading,daMap_CSS" });	//GIS地图 控件类

})();

//daLoader依赖da核心库
daLoader.ready("da");



