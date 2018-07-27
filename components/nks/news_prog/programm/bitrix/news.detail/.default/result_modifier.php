<?
$arResult['CLINICS'] = array();
$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','PREVIEW_PICTURE','PROPERTY_CLINIC_PHONE','PROPERTY_CLINIC_WORKTIME'));
while ($clinic = $_clinic->GetNext()) {
	if ( in_array($clinic['ID'],$arResult['PROPERTIES']['PG_IN_CLINIC']['VALUE']) ) {
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PIC'] = CFile::GetPath($clinic['PREVIEW_PICTURE']);		
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PHONE'] = $clinic['PROPERTY_CLINIC_PHONE_VALUE'];		
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['WORKTIME'] = $clinic['PROPERTY_CLINIC_WORKTIME_VALUE'];		
		$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['SHORTNAME'] = mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE']);		
	}
	$arResult['F_CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
}

if (is_array($arResult['DETAIL_PICTURE'])) {
  	$arResult['BG'] = 'style="background:url('.$arResult['DETAIL_PICTURE']['SRC'].') no-repeat scroll center top / cover"';
}else{
	$arResult['BG'] = '';
}

if (is_array($arResult['PROPERTIES']['PG_P_PHOTO']['VALUE'])) {
	$preim = array();
	for ($i=0; $i < count($arResult['PROPERTIES']['PG_P_PHOTO']['VALUE']); $i++) {
		$preim[$i]['IMG'] = CFile::GetPath($arResult['PROPERTIES']['PG_P_PHOTO']['VALUE'][$i]);
		if ($arResult['PROPERTIES']['PG_P_HEAD']['VALUE'][$i]) {
			$preim[$i]['HEAD'] = $arResult['PROPERTIES']['PG_P_HEAD']['VALUE'][$i];
		}
		if ($arResult['PROPERTIES']['PG_P_TEXT']['VALUE'][$i]) {
			$preim[$i]['TEXT'] = $arResult['PROPERTIES']['PG_P_TEXT']['VALUE'][$i];
		}
	}
	$arResult['PREIM'] = $preim;
}


if(!empty($arResult["PROPERTIES"]["PG_P_LIST_OD"]["VALUE"])) {
	/*$serv = array();
	$_elems = CIBlockElement::GetList(array('NAME'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PG_P_LIST_OD"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_odintsovo'));
	while ($elem = $_elems->GetNext()) {
		$serv[$elem['NAME']] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
	}*/
	$arResult['CLINICS']['одинцово']['PRICELIST'] = $arResult["PROPERTIES"]["PG_P_LIST_OD"]["~VALUE"];
	$arResult['CLINICS']['одинцово']['PRICE'] = $arResult["PROPERTIES"]["PG_P_PRICE_OD"]["VALUE"];
}
if(!empty($arResult["PROPERTIES"]["PG_P_LIST_PR"]["VALUE"])) {
	/*$serv = array();
	$_elems = CIBlockElement::GetList(array('NAME'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PG_P_LIST_PR"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium'));
	while ($elem = $_elems->GetNext()) {
		$serv[$elem['NAME']] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
	}*/
	$arResult['CLINICS']['премиум']['PRICELIST'] = $arResult["PROPERTIES"]["PG_P_LIST_PR"]["~VALUE"];
	$arResult['CLINICS']['премиум']['PRICE'] = $arResult["PROPERTIES"]["PG_P_PRICE_PR"]["VALUE"];
}
if(!empty($arResult["PROPERTIES"]["PG_P_LIST_ZV"]["VALUE"])) {
	/*$serv = array();
	$_elems = CIBlockElement::GetList(array('NAME'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PG_P_LIST_ZV"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_zvenigorod'));
	while ($elem = $_elems->GetNext()) {
		$serv[$elem['NAME']] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
	}*/
	$arResult['CLINICS']['звенигород']['PRICELIST'] = $arResult["PROPERTIES"]["PG_P_LIST_ZV"]["~VALUE"];
	$arResult['CLINICS']['звенигород']['PRICE'] = $arResult["PROPERTIES"]["PG_P_PRICE_ZV"]["VALUE"];
}

if(!empty($arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"]) || !empty($arResult["PROPERTIES"]["PG_SPEC"]["VALUE"])) {
	$arSpecFilter = array('IBLOCK_ID'=>2,'ACTIVE'=>'Y');
	if(!empty($arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"]) && empty($arResult["PROPERTIES"]["PG_SPEC"]["VALUE"])) {
		$arSpecFilter['SECTION_ID'] = $arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"];
	}elseif (empty($arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"]) && !empty($arResult["PROPERTIES"]["PG_SPEC"]["VALUE"])) {
		$arSpecFilter['ID'] = $arResult["PROPERTIES"]["PG_SPEC"]["VALUE"];
	}elseif (!empty($arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"]) && !empty($arResult["PROPERTIES"]["PG_SPEC"]["VALUE"])) {
		$arSpecFilter[] = array(
	        "LOGIC" => "OR",
	        array("SECTION_ID" => $arResult["PROPERTIES"]["PG_SPEC_SECT"]["VALUE"]),
	        array("ID" => $arResult["PROPERTIES"]["PG_SPEC"]["VALUE"]),
	    );
	}

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


$_new_progs = CIBlockElement::GetList(array('created_date'=>'desc'),array('IBLOCK_ID'=>10,'!ID' => $arResult['ID'],'ACTIVE'=>'Y'),false,array('nTopCount'=>7),array('ID','IBLOCK_ID','NAME','DETAIL_PAGE_URL','PREVIEW_PICTURE','PROPERTY_PG_SLIDE_TEXT','PROPERTY_PG_SLIDE_PRICE','PROPERTY_PG_SLIDE_TAGS_ICONS','PROPERTY_PG_SLIDE_TAGS'));
while ($new_progs = $_new_progs->GetNext()) {	  
	$arResult['NEW_PROGS'][$new_progs['ID']]['NAME'] = $new_progs['NAME'];
	$arResult['NEW_PROGS'][$new_progs['ID']]['URL'] = $new_progs['DETAIL_PAGE_URL'];
	$arResult['NEW_PROGS'][$new_progs['ID']]['PRICE'] = $new_progs['PROPERTY_PG_SLIDE_PRICE_VALUE'];
	if (is_array($new_progs['PROPERTY_PG_SLIDE_TAGS_ICONS_VALUE'])) {
		for ($i=0; $i < count($new_progs['PROPERTY_PG_SLIDE_TAGS_ICONS_VALUE']); $i++) { 
			$arResult['NEW_PROGS'][$new_progs['ID']]['TAGS'][$i]['NAME'] = $new_progs['PROPERTY_PG_SLIDE_TAGS_VALUE'][$i];
			if (!empty($new_progs['PROPERTY_PG_SLIDE_TAGS_ICONS_VALUE'][$i])) {
				$arResult['NEW_PROGS'][$new_progs['ID']]['TAGS'][$i]['IMG'] = CFile::GetPath($new_progs['PROPERTY_PG_SLIDE_TAGS_ICONS_VALUE'][$i]);
			}else{
				$arResult['NEW_PROGS'][$new_progs['ID']]['TAGS'][$i]['IMG'] = '';
			}
		}
	}
	$arResult['NEW_PROGS'][$new_progs['ID']]['PREIM'] = $new_progs['PROPERTY_PG_SLIDE_TEXT_VALUE'];
	$arResult['NEW_PROGS'][$new_progs['ID']]['IMG'] = CFile::GetPath($new_progs['PREVIEW_PICTURE']);
}  

if (!empty($arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'])  && is_int(1*$arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {
		if($left_link['IBLOCK_ID'] == 1){
			$arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'] = '/'.$left_link['DETAIL_PAGE_URL'];
		}else{
			$arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'] = $left_link['DETAIL_PAGE_URL'];
		}		  
	}
}
if (!empty($arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE']) && is_int(1*$arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {
		if($left_link['IBLOCK_ID'] == 1){
			$arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'] = '/'.$left_link['DETAIL_PAGE_URL'];
		}else{
			$arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'] = $left_link['DETAIL_PAGE_URL'];
		}		  
	}
}

$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));

?>