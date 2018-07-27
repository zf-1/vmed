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

if (!empty($arResult['PROPERTIES']['AC_BG']['VALUE'])) {
	$arResult['BG'] = CFile::GetPath($arResult['PROPERTIES']['AC_BG']['VALUE']);
}else{
	$arResult['BG'] = SITE_TEMPLATE_PATH.'/project/images/bg/one-skidka-bg.jpg';
}


$from = substr($arResult['DATE_ACTIVE_FROM'],0,10);
$data_from = explode('.',$from);
$arResult['FROM']['D'] = $data_from[0];
$arResult['FROM']['M'] = mb_substr($arMonth[$data_from[1]],0,3);
if (!empty($arResult['DATE_ACTIVE_TO'])) {
	$to = substr($arResult['DATE_ACTIVE_TO'],0,10);
	$data_to = explode('.',$to);	  
	$arResult['TO']['D'] = $data_to[0];
	$arResult['TO']['M'] = mb_substr($arMonth[$data_to[1]],0,3);	
}else{
	$arResult['TO'] = '';
}

if (is_array($arResult['PROPERTIES']['AC_P_PHOTO']['VALUE'])) {
	$preim = array();
	for ($i=0; $i < count($arResult['PROPERTIES']['AC_P_PHOTO']['VALUE']); $i++) {
		$preim[$i]['IMG'] = CFile::GetPath($arResult['PROPERTIES']['AC_P_PHOTO']['VALUE'][$i]);
		if ($arResult['PROPERTIES']['AC_P_HEAD']['VALUE'][$i]) {
			$preim[$i]['HEAD'] = $arResult['PROPERTIES']['AC_P_HEAD']['VALUE'][$i];
		}
		if ($arResult['PROPERTIES']['AC_P_TEXT']['VALUE'][$i]) {
			$preim[$i]['TEXT'] = $arResult['PROPERTIES']['AC_P_TEXT']['VALUE'][$i];
		}
	}
	$arResult['PREIM'] = $preim;
}
if (is_array($arResult['PROPERTIES']['AC_PHOTO']['VALUE'])) {
	foreach ($arResult['PROPERTIES']['AC_PHOTO']['VALUE'] as $photo) {
		$arResult['GALLERY'][] = CFile::GetPath($photo);
	}
}

if(!empty($arResult["PROPERTIES"]["AC_SPECS"]["VALUE"])) {
	$arSpecFilter = array('IBLOCK_ID'=>2,'ACTIVE'=>'Y','ID'=>$arResult["PROPERTIES"]["AC_SPECS"]["VALUE"]);
	$_sect_spec = CIBlockElement::GetList(array('PROPERTY_VIEW_COUNTER'=>'DESC','NAME'=>'ASC'),$arSpecFilter,false,false,array('IBLOCK_ID','ID','NAME','PROPERTY_centr','PROPERTY_osnovnaya_specializaciya','PROPERTY_dop_specializaciya', 'DETAIL_PAGE_URL','DETAIL_PICTURE'));
	while ($sect_spec = $_sect_spec->GetNext()) {
		$sect_spec['MINIPIC'] = CFile::GetPath($sect_spec['DETAIL_PICTURE']);
		$s_initials = explode(' ',$sect_spec['NAME']);
		$sect_spec['LAST_NAME'] = $s_initials[0];
		$sect_spec['FIRST_NAME'] = $s_initials[1];
		$sect_spec['SECOND_NAME'] = $s_initials[2];
		$arResult['SPECS'][$sect_spec['ID']] =  $sect_spec;
	}	  
}

$_ac = CIBlockElement::GetList(array('created_date'=>'DESC'),array('IBLOCK_ID'=>4,'ACTIVE'=>'Y','ACTIVE_DATE'=>'Y'),false,array('nTopCount'=>7),array('IBLOCK_ID','ID','NAME','DETAIL_PICTURE','DETAIL_PAGE_URL','DATE_ACTIVE_FROM', 'DATE_ACTIVE_TO','PROPERTY_AC_IN_CLINIC'));

while($arElement = $_ac->GetNext())
{

	$arResult["NEW_AC"][$arElement['ID']]['NAME'] = $arElement['NAME'];
	$arResult["NEW_AC"][$arElement['ID']]['CLINICS'] = $arElement['PROPERTY_AC_IN_CLINIC_VALUE'];
	$arResult["NEW_AC"][$arElement['ID']]['LINK'] = $arElement['DETAIL_PAGE_URL'];
	if (!empty($arElement['DETAIL_PICTURE'])) {
		$bg = CFile::GetPath($arElement['DETAIL_PICTURE']);
		$arResult["NEW_AC"][$arElement['ID']]['BG'] = 'url('.$bg.')';
	} else {
		$arResult["NEW_AC"][$arElement['ID']]['BG'] = 'linear-gradient(to top,#777,#777)';
	}
	$from = substr($arElement['DATE_ACTIVE_FROM'],0,10);
	$data_from = explode('.',$from);
	$arResult["NEW_AC"][$arElement['ID']]['FROM'] = $data_from[0].' '.mb_strtolower($arMonth[$data_from[1]]);
	if (!empty($arElement['DATE_ACTIVE_TO'])) {
		$to = substr($arElement['DATE_ACTIVE_TO'],0,10);
		$data_to = explode('.',$to);
		$arResult["NEW_AC"][$arElement['ID']]['TO'] = $data_to[0].' '.mb_strtolower($arMonth[$data_to[1]]);		  
	}else{
		$arResult["NEW_AC"][$arElement['ID']]['TO'] = '';
	}
	
}
  
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));

?>