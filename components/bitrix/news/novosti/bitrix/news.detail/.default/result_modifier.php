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
$_news = CIBlockElement::GetList(array('DATE_ACTIVE_FROM'=>'DESC'),array('IBLOCK_ID'=>3,'ACTIVE'=>'Y','!ID'=>$arResult['ID']),false,array('nTopCount'=>7),array('ID','NAME','PREVIEW_TEXT','DETAIL_PAGE_URL','DATE_ACTIVE_FROM'));
while ($news = $_news->GetNext()) {
    if (stristr($news['DATE_ACTIVE_FROM'],' ') == false) {
        $unix = MakeTimeStamp($news['DATE_ACTIVE_FROM'], "DD.MM.YYYY");
    }else{
        $unix = MakeTimeStamp($news['DATE_ACTIVE_FROM'], "DD.MM.YYYY HH:MI:SS");
    }
	$format_date = date('j',$unix).' '.$arMonth[date('m',$unix)].' '.date('Y',$unix).', '.date('H:i',$unix);
	$format_name = mb_strimwidth($news['NAME'],0,50,' ...');
	$format_text = mb_strimwidth(strip_tags($news['PREVIEW_TEXT']),0,100,' ...');
	$arResult['NEWS'][$news['ID']]['NAME'] = $format_name;
	$arResult['NEWS'][$news['ID']]['PREVIEW_TEXT'] = $format_text;
	$arResult['NEWS'][$news['ID']]['DATE'] = $format_date;
	$arResult['NEWS'][$news['ID']]['LINK'] = $news['DETAIL_PAGE_URL'];	  
}

$file=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width'=>300, 'height'=>300),BX_RESIZE_IMAGE_PROPORTIONAL,true);
$arResult["DETAIL_PICTURE"]["SRC"]=$file["src"];
$arResult["DETAIL_PICTURE"]["HEIGHT"]=$file["height"];
$arResult["DETAIL_PICTURE"]["WIDTH"]=$file["width"];

$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));
?>