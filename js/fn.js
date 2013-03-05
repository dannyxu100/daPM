


/**ªÒ»°cookie÷µ
*/
function fn_getcookie(name){
	var arrcookie = decodeURIComponent(da.cookie("COOKIE_FROM_DASYS")).split('|');

	for(var i=0; i<arrcookie.length; i++){
		var arr = arrcookie[i].split(':');
	
		if( name != arr[0] ) continue;
		
		return arr[1];
	}
	return "null";
	
}