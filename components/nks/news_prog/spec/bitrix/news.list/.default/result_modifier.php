<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','NAME','PROPERTY_CLINIC_SHORTNAME','PROPERTY_CLINIC_ADDRES','PREVIEW_PICTURE','PROPERTY_CLINIC_PHONE','PROPERTY_CLINIC_WORKTIME'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['NAME'] = $clinic['NAME'];	  
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['ADDR'] = $clinic['PROPERTY_CLINIC_ADDRES_VALUE'];
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PIC'] = CFile::GetPath($clinic['PREVIEW_PICTURE']);		
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['PHONE'] = $clinic['PROPERTY_CLINIC_PHONE_VALUE'];		
	$arResult['CLINICS'][mb_strtolower($clinic['PROPERTY_CLINIC_SHORTNAME_VALUE'])]['WORKTIME'] = $clinic['PROPERTY_CLINIC_WORKTIME_VALUE'];		
}

$all_times = array();
$otzyvy_names = array();
$clinics = array();
foreach($arResult["ITEMS"] as $key => $arElement)
{	  
	$all_times[] = MakeTimeStamp($arElement['TIMESTAMP_X'], "DD.MM.YYYY HH:MI:SS");
    $file=CFile::ResizeImageGet($arElement["DETAIL_PICTURE"]["ID"],array('width'=>96, 'height'=>96),BX_RESIZE_IMAGE_EXACT,true);
	$arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]=$file["src"];

	$otzyvy_names[$arElement['NAME']]['PIC'] = $file["src"];
	$otzyvy_names[$arElement['NAME']]['SPEC'] = $arElement['PROPERTIES']['osnovnaya_specializaciya']["VALUE"];
	$clinics = array_merge($clinics,$arElement['PROPERTIES']['centr']["VALUE"]);
}
$clinics = array_unique($clinics);
$arResult['WHERE'] = array_map('mb_strtolower', $clinics);

  

/*__nks{ сео блок }*/
  
$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["ID"]."_SECTION",$arResult['SECTION']['PATH']['0']['ID'],"UF_MY_FIELD");
$arResult['UF'] = $arUF;
/*echo '<pre>';
print_r($arResult['UF']);
echo '</pre><hr/>';*/

if(!empty($arResult["UF"]["UF_SPEC_PRICE"]["VALUE"])) {
	$serv = array();
	$_elems = CIBlockElement::GetList(array('IBLOCK_SECTION_ID'=>'ASC'),array('IBLOCK_ID'=>13,'SECTION_ID'=>$arResult["UF"]["UF_SPEC_PRICE"]["VALUE"],'ACTIVE'=>'Y'),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
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
$left_link = array();
if ($arUF["UF_LEFTLINK_NAME"]["VALUE"] != "") {
	$left_link['NAME'] = $arUF["UF_LEFTLINK_NAME"]["VALUE"];
	$left_link['SECT'] = $arUF["UF_LEFTLINK_SECT"]["VALUE"];
	$left_link['URL'] = $arUF["UF_LEFTLINK_URL"]["VALUE"];
}
$right_link = array();
if ($arUF["UF_LEFTLINK_NAME"]["VALUE"] != "") {
	$right_link['NAME'] = $arUF["UF_RIGHTLINK_NAME"]["VALUE"];
	$right_link['SECT'] = $arUF["UF_RIGHTLINK_SECT"]["VALUE"];
	$right_link['URL'] = $arUF["UF_RIGHTLINK_URL"]["VALUE"];
}
$arResult['LEFTLINK'] = $left_link;
$arResult['RIGHTLINK'] = $right_link;

if($arUF["UF_BOTTOM_TEXT"]["VALUE"] != ""){
        $arResult["SECTION"]['PATH']['0']["UF_BOTTOM_TEXT"] = $arUF["UF_BOTTOM_TEXT"]["VALUE"];
}
if($arUF["UF_TOP_DESC"]["VALUE"] != ""){
        $arResult["UF_TOP_DESC"] = $arUF["UF_TOP_DESC"]["VALUE"];
}

$arResult['LAST_MOD'] = max($all_times);


/*__nks{ отзывы }*/

$arResult['OTZYVY_NAMES'] = array_keys($otzyvy_names);
/*$_otzyvy = CIBlockElement::GetList(array('created'=>'DESC'),array('IBLOCK_ID'=>14,'PROPERTY_FEEDBACK_ABOUT' => array_keys($otzyvy_names),'ACTIVE'=>'Y'),false,array('nTopCount'=>7),array('ID','IBLOCK_ID','NAME','PREVIEW_TEXT','DATE_CREATE','PROPERTY_FEEDBACK_ABOUT'));
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

	$arResult['OTZYVY'][$otzyv['ID']]['MAIN_SPEC'] = $otzyvy_names[$otzyv['PROPERTY_FEEDBACK_ABOUT_VALUE']]['SPEC'];	
	$arResult['OTZYVY'][$otzyv['ID']]['PIC'] = $otzyvy_names[$otzyv['PROPERTY_FEEDBACK_ABOUT_VALUE']]['PIC'];	
	$d_initials = explode(' ',$otzyv['PROPERTY_FEEDBACK_ABOUT_VALUE']);
	$arResult['OTZYVY'][$otzyv['ID']]['INITIALS'] = $d_initials[0].' '.mb_substr($d_initials[1],0,1).'.'.mb_substr($d_initials[2],0,1).'.';
	$arResult['OTZYVY'][$otzyv['ID']]['DOC_FIRST_NAME'] = $d_initials[0];
	$arResult['OTZYVY'][$otzyv['ID']]['DOC_SECOND_NAME'] = $d_initials[1].' '.$d_initials[2];
}
*/
    

$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));

?>