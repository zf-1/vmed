<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$all_times = array();
$arTags = array();


foreach($arResult["ITEMS"] as $key => $arElement)
{
	if (is_array($arElement['PROPERTIES']['ART_TAGS']['VALUE'])) {
		foreach ($arElement['PROPERTIES']['ART_TAGS']['VALUE'] as $tag) {
			$arTags[$tag] += $arElement['SHOW_COUNTER'];
		}
	}	  
	$all_times[] = MakeTimeStamp($arElement['TIMESTAMP_X'], "DD.MM.YYYY HH:MI:SS");
	if (is_array($arElement["DETAIL_PICTURE"])) {
		$file=CFile::ResizeImageGet($arResult["ITEMS"][$key]["DETAIL_PICTURE"]["ID"],array('width'=>350, 'height'=>150),BX_RESIZE_IMAGE_EXACT);
	    $arResult["ITEMS"][$key]["DETAIL_PICTURE"]["SRC"]=$file["src"];
	} else {
		$arResult["ITEMS"][$key]["DETAIL_PICTURE"]["SRC"] = SITE_TEMPLATE_PATH.'/project/images/other/prog-1.jpg';
	}
	$arElement['NAME'] = mb_strimwidth($arElement['NAME'],0,50,' ...');
	$arElement['PREVIEW_TEXT'] = mb_strimwidth($arElement['PREVIEW_TEXT'],0,100,' ...');
}

$arResult['POP_TAGS'] = $arTags;
ksort($arTags);
$arResult['TAGS'] = $arTags;

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
$_news = CIBlockElement::GetList(array('created_date'=>'DESC'),array('IBLOCK_ID'=>3,'ACTIVE'=>'Y','!ID'=>$arResult['ID']),false,array('nTopCount'=>7),array('ID','NAME','PREVIEW_TEXT','DETAIL_PAGE_URL','DATE_CREATE_UNIX'));
while ($news = $_news->GetNext()) {
	$format_date = date('j',$news['DATE_CREATE_UNIX']).' '.$arMonth[date('m',$news['DATE_CREATE_UNIX'])].' '.date('Y',$news['DATE_CREATE_UNIX']).', '.date('H:i',$news['DATE_CREATE_UNIX']);
	$format_name = mb_strimwidth($news['NAME'],0,50,' ...');
	$format_text = mb_strimwidth(strip_tags($news['PREVIEW_TEXT']),0,100,' ...');
	$arResult['NEWS'][$news['ID']]['NAME'] = $format_name;
	$arResult['NEWS'][$news['ID']]['PREVIEW_TEXT'] = $format_text;
	$arResult['NEWS'][$news['ID']]['DATE'] = $format_date;
	$arResult['NEWS'][$news['ID']]['LINK'] = $news['DETAIL_PAGE_URL'];	  
}

$arResult['LAST_MOD'] = max($all_times);
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));
?>