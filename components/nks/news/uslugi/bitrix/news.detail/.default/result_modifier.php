<?

if(!empty($arResult["PROPERTIES"]["PRICE_LINK"]["VALUE"])) {
	$serv = array();
	if (!in_array('для юридических лиц',$arResult['PROPERTIES']['SERVICE_TYPE']['VALUE'])) {
		$_elems = CIBlockElement::GetList(array('IBLOCK_SECTION_ID'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PRICE_LINK"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
		while ($elem = $_elems->GetNext()) {
			$_sect = CIBlockElement::GetElementGroups($elem['ID'], true,array('NAME','ID'));
			if ($sect = $_sect->GetNext()) {
				$serv[$sect['NAME']][$elem['NAME']]['одинцово'] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
				$serv[$sect['NAME']][$elem['NAME']]['звенигород'] = $elem['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
				$serv[$sect['NAME']][$elem['NAME']]['премиум'] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
			}
		}
	} else {
		$_elems = CIBlockElement::GetList(array('NAME'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["PRICE_LINK"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
		while ($elem = $_elems->GetNext()) {
			$serv[$elem['NAME']]['одинцово'] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
			$serv[$elem['NAME']]['звенигород'] = $elem['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
			$serv[$elem['NAME']]['премиум'] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
		}
	}
	$arResult['PRICE_SERVICES'] = $serv;
}
  
$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];	  
}

if(!empty($arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"]) || !empty($arResult["PROPERTIES"]["specialisty"]["VALUE"])) {
	$arSpecFilter = array('IBLOCK_ID'=>2,'ACTIVE'=>'Y');
	if(!empty($arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"]) && empty($arResult["PROPERTIES"]["specialisty"]["VALUE"])) {
		$arSpecFilter['SECTION_ID'] = $arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"];
	}elseif (empty($arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"]) && !empty($arResult["PROPERTIES"]["specialisty"]["VALUE"])) {
		$arSpecFilter['ID'] = $arResult["PROPERTIES"]["specialisty"]["VALUE"];
	}elseif (!empty($arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"]) && !empty($arResult["PROPERTIES"]["specialisty"]["VALUE"])) {
		$arSpecFilter[] = array(
	        "LOGIC" => "OR",
	        array("SECTION_ID" => $arResult["PROPERTIES"]["ALL_SECT_SPEC"]["VALUE"]),
	        array("ID" => $arResult["PROPERTIES"]["specialisty"]["VALUE"]),
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

if (!empty($arResult['PROPERTIES']['LEFT_LINK']['VALUE']) && is_int(1*$arResult['PROPERTIES']['LEFT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['LEFT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {		
		$tmp_link = '/'.$left_link['DETAIL_PAGE_URL'];
		$arResult['PROPERTIES']['LEFT_LINK']['VALUE'] = str_replace('//', '/', $tmp_link);  
	}
}
if (!empty($arResult['PROPERTIES']['RIGHT_LINK']['VALUE']) && is_int(1*$arResult['PROPERTIES']['RIGHT_LINK']['VALUE'])) {
	$_left_link = CIBlockElement::GetByID($arResult['PROPERTIES']['RIGHT_LINK']['VALUE']);
	if ($left_link = $_left_link->GetNext()) {
		$tmp_link = '/'.$left_link['DETAIL_PAGE_URL'];
		$arResult['PROPERTIES']['RIGHT_LINK']['VALUE'] = str_replace('//', '/', $tmp_link);  	  
	}
}

if (is_array($arResult['PROPERTIES']['UR_P_PHOTO']['VALUE'])) {
	$preim = array();
	for ($i=0; $i < count($arResult['PROPERTIES']['UR_P_PHOTO']['VALUE']); $i++) {
		$preim[$i]['IMG'] = CFile::GetPath($arResult['PROPERTIES']['UR_P_PHOTO']['VALUE'][$i]);
		if ($arResult['PROPERTIES']['UR_P_HEAD']['VALUE'][$i]) {
			$preim[$i]['HEAD'] = $arResult['PROPERTIES']['UR_P_HEAD']['VALUE'][$i];
		}
		if ($arResult['PROPERTIES']['UR_P_TEXT']['VALUE'][$i]) {
			$preim[$i]['TEXT'] = $arResult['PROPERTIES']['UR_P_TEXT']['VALUE'][$i];
		}
	}
	$arResult['PREIM'] = $preim;
}
  
if (is_array($arResult['PROPERTIES']['UR_T_PHOTO']['VALUE'])) {
	$timeline = array();
	for ($i=0; $i < count($arResult['PROPERTIES']['UR_T_PHOTO']['VALUE']); $i++) {
		$timeline[$i]['IMG'] = CFile::GetPath($arResult['PROPERTIES']['UR_T_PHOTO']['VALUE'][$i]);
		if ($arResult['PROPERTIES']['UR_T_HEAD']['VALUE'][$i]) {
			$timeline[$i]['HEAD'] = $arResult['PROPERTIES']['UR_T_HEAD']['VALUE'][$i];
		}
		if ($arResult['PROPERTIES']['UR_T_TEXT']['VALUE'][$i]) {
			$timeline[$i]['TEXT'] = $arResult['PROPERTIES']['UR_T_TEXT']['VALUE'][$i];
		}
	}
	$arResult['TIMELINE'] = $timeline;
}

if (!empty($arResult['PROPERTIES']['UR_BG']['VALUE'])) {
	$bg = CFile::ResizeImageGet($arResult['PROPERTIES']['UR_BG']['VALUE'],array("width" => 1920, "height" => 1920),BX_RESIZE_IMAGE_PROPORTIONAL);
	$arResult['UR_BG'] = $bg['src'];
}
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));
?>