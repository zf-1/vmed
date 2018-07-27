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
if (empty($arResult['DETAIL_PICTURE'])) {
	$arResult['DETAIL_PICTURE']['SRC'] = SITE_TEMPLATE_PATH.'/project/images/bg/one-article-bg.jpg';
}

if(!empty($arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"]) || !empty($arResult["PROPERTIES"]["ART_SPEC"]["VALUE"])) {
	$arSpecFilter = array('IBLOCK_ID'=>2,'ACTIVE'=>'Y');
	if(!empty($arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"]) && empty($arResult["PROPERTIES"]["ART_SPEC"]["VALUE"])) {
		$arSpecFilter['SECTION_ID'] = $arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"];
	}elseif (empty($arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"]) && !empty($arResult["PROPERTIES"]["ART_SPEC"]["VALUE"])) {
		$arSpecFilter['ID'] = $arResult["PROPERTIES"]["ART_SPEC"]["VALUE"];
	}elseif (!empty($arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"]) && !empty($arResult["PROPERTIES"]["ART_SPEC"]["VALUE"])) {
		$arSpecFilter[] = array(
	        "LOGIC" => "OR",
	        array("SECTION_ID" => $arResult["PROPERTIES"]["ART_SECT_SPEC"]["VALUE"]),
	        array("ID" => $arResult["PROPERTIES"]["ART_SPEC"]["VALUE"]),
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

$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];	  
}

if(!empty($arResult["PROPERTIES"]["ART_PRICE_LINK"]["VALUE"])) {
	$serv = array();
	$_elems = CIBlockElement::GetList(array('IBLOCK_SECTION_ID'=>'ASC'),array('ID'=>$arResult["PROPERTIES"]["ART_PRICE_LINK"]["VALUE"]),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
	while ($elem = $_elems->GetNext()) {
		$_sect = CIBlockElement::GetElementGroups($elem['ID'], true,array('NAME','ID'));
		if ($sect = $_sect->GetNext()) {
			$serv[$sect['NAME']][$elem['NAME']]['одинцово'] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['звенигород'] = $elem['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['премиум'] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
		}
	}
	$arResult['PRICE_SERVICES'] = $serv;
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

$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));

?>