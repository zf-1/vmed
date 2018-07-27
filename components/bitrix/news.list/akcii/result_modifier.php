<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arMonth = array(
        "01" => "января",
        "02" => "февраля",
        "03" => "марта",
        "04" => "апреля",
        "05" => "мая",
        "06" => "июня",
        "07" => "июля",
        "08" => "августа",
        "09" => "сентября",
        "10" => "октября",
        "11" => "ноября",
        "12" => "декабря"
    );
$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','PREVIEW_PICTURE','PROPERTY_CLINIC_PHONE','PROPERTY_CLINIC_WORKTIME'));
while ($clinic = $_clinic->GetNext()) {
	if ( in_array($clinic['ID'],$arResult['PROPERTIES']['AC_IN_CLINIC']['VALUE']) ) {
		$arResult['CLINICS'][$clinic['ID']]['NAME'] = $clinic['NAME'];	  
		$arResult['CLINICS'][$clinic['ID']]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
		$arResult['CLINICS'][$clinic['ID']]['PIC'] = CFile::GetPath($clinic['PREVIEW_PICTURE']);		
		$arResult['CLINICS'][$clinic['ID']]['PHONE'] = $clinic['PROPERTY_CLINIC_PHONE_VALUE'];		
		$arResult['CLINICS'][$clinic['ID']]['WORKTIME'] = $clinic['PROPERTY_CLINIC_WORKTIME_VALUE'];		
		$arResult['CLINICS'][$clinic['ID']]['SHORTNAME'] = mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE']);		
	}
	$arResult['AC_CLINICS'][$clinic['ID']]['NAME'] = $clinic['NAME'];
	$arResult['F_CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
}

foreach ($arResult['ITEMS'] as $key => $item) {
	$arResult["ITEMS"][$key]['CLINICS'] = $item['PROPERTIES']['AC_IN_CLINIC']['VALUE'];
	$arResult["ITEMS"][$key]['LINK'] = $item['DETAIL_PAGE_URL'];
	if (!empty($item['DETAIL_PICTURE']['SRC'])) {
		$arResult["ITEMS"][$key]['BG'] = 'url('.$item['DETAIL_PICTURE']['SRC'].')';
	} else {
		$arResult["ITEMS"][$key]['BG'] = 'linear-gradient(to top,#777,#777)';
	}
	$from = substr($item['DATE_ACTIVE_FROM'],0,10);
	$data_from = explode('.',$from);
	$arResult["ITEMS"][$key]['FROM'] = $data_from[0].' '.mb_strtolower($arMonth[$data_from[1]]);
	if (!empty($item['DATE_ACTIVE_TO'])) {
		$to = substr($item['DATE_ACTIVE_TO'],0,10);
		$data_to = explode('.',$to);
		$arResult["ITEMS"][$key]['TO'] = $data_to[0].' '.mb_strtolower($arMonth[$data_to[1]]);		  
	}else{
		$arResult["ITEMS"][$key]['TO'] = '';
	}
}
