<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
foreach($arResult["SEARCH"] as $key => $arItem){
	if (substr($arItem["URL"],0,1) != '/') {
		$arItem["URL"] = '/'.$arItem["URL"];
	}
	if (!$arItem["BODY_FORMATED"]) {
		$arItem["BODY_FORMATED"] = mb_strimwidth($arItem['BODY'],0,120,' ...');
	}else{
		$clear = strip_tags($arItem["BODY_FORMATED"]);
		$_b = mb_stripos($clear,$arResult["REQUEST"]['QUERY']);		
		$_l = mb_strlen($arResult["REQUEST"]['QUERY']);
		if ($_b > 50) {
			$_b_text = mb_stristr($clear,$arResult["REQUEST"]['QUERY'],true);
			$_b_text = mb_substr($_b_text,-50);
			$_b_text = '...'.$_b_text;
			$_e_text = mb_stristr($clear,$arResult["REQUEST"]['QUERY']);
			$_e_text = mb_substr($_e_text,$_l,30);
			$_e_text .= '...';
			$arItem["BODY_FORMATED"] = $_b_text.'<b>'.$arResult["REQUEST"]['QUERY'].'</b>'.$_e_text;
		}else{
			$arItem["BODY_FORMATED"] = mb_strimwidth($arItem["BODY_FORMATED"],0,120,'...');
		}
	}
	$arResult["SEARCH"][$key] = $arItem;	  
}
  

?>