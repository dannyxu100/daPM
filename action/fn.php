<?php
	/**获取cookie值
	*/
	function fn_getcookie( $name ){
		$arrcookie = explode('|', urldecode($_COOKIE["COOKIE_FROM_DASYS"]));
		
		for($i=0; $i<count($arrcookie); $i++){
			$arr = explode(':', $arrcookie[$i]);
			
			if( $name != $arr[0] ) continue;
			
			return $arr[1];
		}
		return "null";
	}
	
?>