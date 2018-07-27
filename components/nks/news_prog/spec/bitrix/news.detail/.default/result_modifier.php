<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','DETAIL_PAGE_URL'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['LINK'] = $clinic['DETAIL_PAGE_URL'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];	  
}

if (isset($arResult["PREVIEW_PICTURE"]["ID"]) && $arResult["PREVIEW_PICTURE"]["ID"]>0)
{
    $file=CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width'=>297, 'height'=>400),BX_RESIZE_IMAGE_EXACT,true);
    $arResult["PREVIEW_PICTURE"]["SRC"]=$file["src"];
    $arResult["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];
    $arResult["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];
}

if ( !empty($arResult['PROPERTIES']['thx']['VALUE'])) {
	foreach ($arResult['PROPERTIES']['thx']['VALUE'] as $thx) {
		$arResult['THX'][$thx]['BIG'] = CFile::GetPath($thx);
		$file=CFile::ResizeImageGet($thx,array('width'=>80, 'height'=>110),BX_RESIZE_IMAGE_EXACT);
		$arResult['THX'][$thx]['SM'] = $file["src"];
	}
}
$initials = explode(' ',$arResult['NAME']);
$arResult['INITIALS'] = $initials[0].' '.mb_substr($initials[1],0,1).'.'.mb_substr($initials[2],0,1).'.';
$arResult['FIRST_NAME'] = $initials[0];
$arResult['SECOND_NAME'] = $initials[1].' '.$initials[2];


if($arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"] != "") { 
	$res = CIBlockSection::GetList(array(),array('NAME'=>$arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"],'IBLOCK_ID'=>2));
	if($ar_res = $res->GetNext())
		$arResult['MAIN_SPEC'] = $ar_res["SECTION_PAGE_URL"];
}
if($arResult["PROPERTIES"]["dop_specializaciya"]["VALUE"]) {
	$arDopList = array();
	$i=0;
	foreach($arResult["PROPERTIES"]["dop_specializaciya"]["VALUE"] as $arDop)
	{
		$arSelect = Array('NAME', 'SECTION_PAGE_URL');
		$arFilter = Array("NAME" => $arDop);
		$res = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter, false, $arSelect);
		if($ob = $res->GetNext())
		{
			$arDopList[$i]['LINK'] = $ob["SECTION_PAGE_URL"];
			$arDopList[$i]['NAME'] = $arDop;
		}
		$i++;
	}
	$arResult['DOP_SPEC'] = $arDopList;
} 

if(!empty($arResult["PROPERTIES"]["PRICE_LINK"]["VALUE"])) {
	$serv = array();
	$_elems = CIBlockElement::GetList(array('IBLOCK_SECTION_ID'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PRICE_LINK"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
	while ($elem = $_elems->GetNext()) {
		$_sect = CIBlockElement::GetElementGroups($elem['ID'], true,array('NAME','ID'));
		if ($sect = $_sect->GetNext()) {
			$serv[$sect['NAME']][$elem['NAME']]['Одинцово'] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['Звенигород'] = $elem['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['ПРЕМИУМ'] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
		}
	}
	$arResult['PRICE_SERVICES'] = $serv;
}

$_otzyvy = CIBlockElement::GetList(array('created'=>'DESC'),array('IBLOCK_ID'=>14,'PROPERTY_FEEDBACK_ABOUT' => $arResult['NAME'],'ACTIVE'=>'Y'),false,array('nTopCount'=>7),array('ID','IBLOCK_ID','NAME','PREVIEW_TEXT','DATE_CREATE'));
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
while($otzyv = $_otzyvy->GetNext()) {
	$o_initials = explode(' ',$otzyv['NAME']);
	$ar_time = explode(' ',$otzyv['DATE_CREATE']);
	$time = substr($ar_time[1],0,-3);
	$data = explode('.',$ar_time[0]);
	$full_time = (int)$data[0].' '.$arMonth[$data[1]].' '.$data[2].', '.$time;  
	$arResult['OTZYVY'][$otzyv['ID']] = $otzyv;	
	$arResult['OTZYVY'][$otzyv['ID']]['FIRST_NAME'] = $o_initials[0];
	$arResult['OTZYVY'][$otzyv['ID']]['SECOND_NAME'] = $o_initials[1].' '.$o_initials[2];
	$arResult['OTZYVY'][$otzyv['ID']]['FORMAT_DATE'] = $full_time;	
}

  
$arSameFilt = array(
	'IBLOCK_ID'=>2,
	'!ID'=>$arResult['ID'],
	array(
        "LOGIC" => "OR",
        array("PROPERTY_dop_specializaciya_VALUE" => $arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"]),
        array("PROPERTY_osnovnaya_specializaciya_VALUE" => $arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"]),
    ),
    'ACTIVE' => 'Y'
);
$_same = CIBlockElement::GetList(array('PROPERTY_VIEW_COUNTER'=>'DESC'),$arSameFilt,false,false,array('IBLOCK_ID','ID','NAME','PROPERTY_centr','PROPERTY_osnovnaya_specializaciya','PROPERTY_dop_specializaciya', 'DETAIL_PAGE_URL','DETAIL_PICTURE'));
while ($same = $_same->GetNext()) {
	$same['MINIPIC'] = CFile::GetPath($same['DETAIL_PICTURE']);
	$s_initials = explode(' ',$same['NAME']);
	$same['LAST_NAME'] = $s_initials[0];
	$same['FIRST_NAME'] = $s_initials[1];
	$same['SECOND_NAME'] = $s_initials[2];
	$arResult['SAME'][] =  $same;
}

if (!empty($arResult['PROPERTIES']['LEFT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['LEFT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {
		if($left_link['IBLOCK_ID'] == 1){
			$arResult['PROPERTIES']['LEFT_LINK']['VALUE'] = '/'.$left_link['DETAIL_PAGE_URL'];
		}else{
			$arResult['PROPERTIES']['LEFT_LINK']['VALUE'] = $left_link['DETAIL_PAGE_URL'];
		}		  
	}
}
if (!empty($arResult['PROPERTIES']['RIGHT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['RIGHT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {
		if($left_link['IBLOCK_ID'] == 1){
			$arResult['PROPERTIES']['RIGHT_LINK']['VALUE'] = '/'.$left_link['DETAIL_PAGE_URL'];
		}else{
			$arResult['PROPERTIES']['RIGHT_LINK']['VALUE'] = $left_link['DETAIL_PAGE_URL'];
		}		  
	}
}
  
$cp = $this->__component; // объект компонента
if (is_object($cp))
	$cp->arResult['VIEW_COUNTER'] = $arResult['PROPERTIES']['VIEW_COUNTER']['VALUE'];
   	$cp->SetResultCacheKeys(array('TIMESTAMP_X','VIEW_COUNTER'));
?>