<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','PREVIEW_PICTURE','PROPERTY_CLINIC_PHONE','PROPERTY_CLINIC_WORKTIME'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][$clinic['ID']]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][$clinic['ID']]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
	$arResult['CLINICS'][$clinic['ID']]['PIC'] = CFile::GetPath($clinic['PREVIEW_PICTURE']);		
	$arResult['CLINICS'][$clinic['ID']]['PHONE'] = $clinic['PROPERTY_CLINIC_PHONE_VALUE'];		
	$arResult['CLINICS'][$clinic['ID']]['WORKTIME'] = $clinic['PROPERTY_CLINIC_WORKTIME_VALUE'];		
	$arResult['CLINICS'][$clinic['ID']]['SHORTNAME'] = mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE']);
}
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
	$all_times[] = MakeTimeStamp($arElement['TIMESTAMP_X'], "DD.MM.YYYY HH:MI:SS");
	if (is_array($arElement['DETAIL_PICTURE'])) {
		$arResult["ITEMS"][$key]['BG'] = 'url('.$arElement['DETAIL_PICTURE']['SRC'].')';
	} else {
		$arResult["ITEMS"][$key]['BG'] = 'linear-gradient(to top,#777,#777)';
	}
	$from = substr($arElement['DATE_ACTIVE_FROM'],0,10);
	$data_from = explode('.',$from);
	$arResult["ITEMS"][$key]['FROM'] = $data_from[0].' '.mb_strtolower($arMonth[$data_from[1]]);
	if (!empty($arElement['DATE_ACTIVE_TO'])) {
		$to = substr($arElement['DATE_ACTIVE_TO'],0,10);
		$data_to = explode('.',$to);
		$arResult["ITEMS"][$key]['TO'] = $data_to[0].' '.mb_strtolower($arMonth[$data_to[1]]);		  
	}else{
		$arResult["ITEMS"][$key]['TO'] = '';
	}
	
}

$arResult['LAST_MOD'] = max($all_times);
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));



?>