<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$_pricecat = CIBlockSection::GetList(array('NAME'=>'ASC', 'SORT'=>'ASC'),array('IBLOCK_ID'=>13),false,array('ID','NAME'));
$arResult = array();
while ($pricecat = $_pricecat->GetNext()) {
	$_priceel = CIBlockElement::GetList(array('NAME'=>'ASC', 'SORT'=>'ASC'),array('IBLOCK_ID'=>13,'SECTION_ID'=>$pricecat['ID']),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
	$arResult[$pricecat['NAME']][0] = $pricecat['ID'];
	while ($priceel = $_priceel->GetNext()) {
		$arResult['PRICE_SERVICES'][$pricecat['NAME']][$priceel['NAME']][0] = $priceel['ID'];
		$arResult['PRICE_SERVICES'][$pricecat['NAME']][$priceel['NAME']]['премиум'] = $priceel['PROPERTY_PRICE_PREMIUM_VALUE'];
		$arResult['PRICE_SERVICES'][$pricecat['NAME']][$priceel['NAME']]['одинцово'] = $priceel['PROPERTY_PRICE_ODINTSOVO_VALUE'];
		$arResult['PRICE_SERVICES'][$pricecat['NAME']][$priceel['NAME']]['звенигород'] = $priceel['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
	}	
}

$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y','ID'=>$arParams['CLINIC_ID']),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','PREVIEW_PICTURE','PROPERTY_CLINIC_PHONE','PROPERTY_CLINIC_WORKTIME'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PIC'] = CFile::GetPath($clinic['PREVIEW_PICTURE']);		
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PHONE'] = $clinic['PROPERTY_CLINIC_PHONE_VALUE'];		
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['WORKTIME'] = $clinic['PROPERTY_CLINIC_WORKTIME_VALUE'];		
}
