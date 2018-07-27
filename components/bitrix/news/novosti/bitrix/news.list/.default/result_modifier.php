<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arMonth = array(
        "01" => "Января",
        "02" => "Февраля",
        "03" => "Марта",
        "04" => "Апреля",
        "05" => "Мая",
        "06" => "Июня",
        "07" => "Июля",
        "08" => "Августа",
        "09" => "Сентября",
        "10" => "Октября",
        "11" => "Ноября",
        "12" => "Декабря"
    );
$all_times = array();

foreach($arResult["ITEMS"] as $key => $arElement)
{
	if (stristr($arElement['DATE_ACTIVE_FROM'],' ') != false) {
		$all_times[$key] = MakeTimeStamp($arElement['DATE_ACTIVE_FROM'], "DD.MM.YYYY HH:MI:SS");
	}else{
		$all_times[$key] = MakeTimeStamp($arElement['DATE_ACTIVE_FROM'], "DD.MM.YYYY");
	}	  
	
	$format_date = date('j',$all_times[$key]).' '.$arMonth[date('m',$all_times[$key])].' '.date('Y',$all_times[$key]).', '.date('H:i',$all_times[$key]);
	$format_name = mb_strimwidth($arElement['NAME'],0,50,' ...');
	$format_text = mb_strimwidth(strip_tags($arElement['PREVIEW_TEXT']),0,100,' ...');
	$arResult["ITEMS"][$key]['NAME'] = $format_name;
	$arResult["ITEMS"][$key]['PREVIEW_TEXT'] = $format_text;
	$arResult["ITEMS"][$key]['DATE'] = $format_date;
	$arResult["ITEMS"][$key]['LINK'] = $arElement['DETAIL_PAGE_URL'];		  
}

$_articles = CIBlockElement::GetList(array('created_date'=>'DESC'),array('IBLOCK_ID'=>5,'ACTIVE'=>'Y','!ID'=>$arResult['ID']),false,array('nTopCount'=>7),array('ID','IBLOCK_ID','NAME','PREVIEW_TEXT','DETAIL_PAGE_URL','PROPERTY_ART_TAGS','DETAIL_PICTURE'));
while ($articles = $_articles->GetNext()) {
	if (empty($articles['DETAIL_PICTURE'])) {
		$img = SITE_TEMPLATE_PATH.'/project/images/other/prog-1.jpg';
	}else{
		$tmp_img = CFile::ResizeImageGet($articles['DETAIL_PICTURE'],array('width'=>343, 'height'=>150),BX_RESIZE_IMAGE_PROPORTIONAL);
		$img = $tmp_img['src'];
		
	}	  
	$format_name = mb_strimwidth($articles['NAME'],0,50,' ...');
	$format_text = mb_strimwidth($articles['PREVIEW_TEXT'],0,100,' ...');
	$arResult['ARTICLES'][$articles['ID']]['NAME'] = $format_name;
	$arResult['ARTICLES'][$articles['ID']]['PREVIEW_TEXT'] = $format_text;
	$arResult['ARTICLES'][$articles['ID']]['LINK'] = $articles['DETAIL_PAGE_URL'];	 
	$arResult['ARTICLES'][$articles['ID']]['TAGS'] = $articles['PROPERTY_ART_TAGS_VALUE'];	 
	$arResult['ARTICLES'][$articles['ID']]['IMG'] = $img;	 

}




$arResult['LAST_MOD'] = max($all_times);
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));
?>