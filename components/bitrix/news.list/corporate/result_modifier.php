<?
$_clinic = CIBlockElement::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>15,'ACTIVE'=>'Y'),false,false,array('ID','NAME'));
while ($clinic = $_clinic->GetNext()) {
	$arResult['CLINICS'][$clinic['ID']]['NAME'] = $clinic['NAME'];
}

$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["ID"]."_SECTION",$arResult['SECTION']['PATH']['0']['ID'],"UF_MY_FIELD");

if($arUF["UF_SPECS"]['VALUE'] != ""){
	$arSpecFilter = array('IBLOCK_ID'=>2,'ACTIVE'=>'Y','SECTION_ID'=>$arUF["UF_SPECS"]['VALUE']);
	$_sect_spec = CIBlockElement::GetList(array('PROPERTY_VIEW_COUNTER'=>'DESC','NAME'=>'ASC'),$arSpecFilter,false,false,array('IBLOCK_ID','ID','IBLOCK_SECTION_ID','NAME','PROPERTY_centr','PROPERTY_osnovnaya_specializaciya','PROPERTY_dop_specializaciya', 'DETAIL_PAGE_URL','DETAIL_PICTURE'));
	while ($sect_spec = $_sect_spec->GetNext()) {
		$sect_spec['MINIPIC'] = CFile::GetPath($sect_spec['DETAIL_PICTURE']);
		$s_initials = explode(' ',$sect_spec['NAME']);
		$sect_spec['LAST_NAME'] = $s_initials[0];
		$sect_spec['FIRST_NAME'] = $s_initials[1];
		$sect_spec['SECOND_NAME'] = $s_initials[2];
		$arResult['SPECS'][$sect_spec['ID']] =  $sect_spec;
	}
}


if($arUF["UF_IN_CLINIC"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"] = $arUF["UF_IN_CLINIC"];
}

if($arUF["UF_SERVICE_DESC"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_SERVICE_DESC"] = $arUF["UF_SERVICE_DESC"];
}

if($arUF["UF_QUOTE"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_QUOTE"] = $arUF["UF_QUOTE"];
}

  
if(count($arUF["UF_PRICE_LINK_SECT"]['VALUE'])){
	  
	$serv = array();
	$_elems = CIBlockElement::GetList(array('IBLOCK_SECTION_ID'=>'ASC'),array('SECTION_ID'=>$arUF["UF_PRICE_LINK_SECT"]['VALUE'],'IBLOCK_ID'=>13),false,false,array('ID','IBLOCK_ID','SECTION_ID','NAME','PROPERTY_price_premium','PROPERTY_price_odintsovo','PROPERTY_price_zvenigorod'));
	while ($elem = $_elems->GetNext()) {		  
		$_sect = CIBlockElement::GetElementGroups($elem['ID'], true,array('NAME','ID'));
		if ($sect = $_sect->GetNext()) {
			$serv[$sect['NAME']][$elem['NAME']]['7190'] = $elem['PROPERTY_PRICE_ODINTSOVO_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['7191'] = $elem['PROPERTY_PRICE_ZVENIGOROD_VALUE'];
			$serv[$sect['NAME']][$elem['NAME']]['7189'] = $elem['PROPERTY_PRICE_PREMIUM_VALUE'];
		}
	}
	$arResult['PRICE_SERVICES'] = $serv;
}

$left_link = array();
if ($arUF["UF_S_LEFTLINK_NAME"]["VALUE"] != "") {
	$left_link['NAME'] = $arUF["UF_S_LEFTLINK_NAME"]["VALUE"];
	$left_link['SECT'] = $arUF["UF_S_LEFTLINK_SECT"]["VALUE"];
	$left_link['URL'] = $arUF["UF_S_LEFTLINK_URL"]["VALUE"];
}
$right_link = array();
if ($arUF["UF_S_LEFTLINK_NAME"]["VALUE"] != "") {
	$right_link['NAME'] = $arUF["UF_S_RIGHTLINK_NAME"]["VALUE"];
	$right_link['SECT'] = $arUF["UF_S_RIGHTLINK_SECT"]["VALUE"];
	$right_link['URL'] = $arUF["UF_S_RIGHTLINK_URL"]["VALUE"];
}
$arResult['LEFTLINK'] = $left_link;
$arResult['RIGHTLINK'] = $right_link;


$arResult["SEOBLOCK"] = '';
if($arUF["UF_S_SEOBLOCK"]["VALUE"] != ""){
	$arResult["SEOBLOCK"] = $arUF["UF_S_SEOBLOCK"]["VALUE"];
}	


$arResult['LAST_MOD'] = $arResult['SECTION']['PATH']['0']['TIMESTAMP_X'];
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));



function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}
?>