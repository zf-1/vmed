<?
$arResult['USER_FIELDS'] = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["ID"]."_SECTION",$arResult['SECTION']['PATH']['0']['ID']);
usort($arResult['ITEMS'], function($a, $b){
    return ($b['SHOW_COUNTER'] - $a['SHOW_COUNTER']);
});
foreach ($arResult['ITEMS'] as $key => $item) {	  
	$arResult['ITEMS'][$key]['PRICE'] = $item['PROPERTY_97'];
	if (is_array($item['PROPERTY_98'])) {
		for ($i=0; $i < count($item['PROPERTY_98']); $i++) { 
			$arResult['ITEMS'][$key]['TAGS'][$i]['NAME'] = $item['PROPERTY_99'][$i];
			if (!empty($item['PROPERTY_98'][$i])) {
				$arResult['ITEMS'][$key]['TAGS'][$i]['IMG'] = CFile::GetPath($item['PROPERTY_98'][$i]);
			}else{
				$arResult['ITEMS'][$key]['TAGS'][$i]['IMG'] = '';
			}
		}
	}
	$arResult['ITEMS'][$key]['PREIM'] = $item['PROPERTY_96'];
	$arResult['ITEMS'][$key]['IMG'] = $item['PREVIEW_PICTURE']['SRC'];
}
  
$_new_progs = CIBlockElement::GetList(array('created_date'=>'desc'),array('IBLOCK_ID'=>10,'!ID' => $arResult['ID']),false,array('nTopCount'=>7),array('ID','IBLOCK_ID','NAME','DETAIL_PAGE_URL','PREVIEW_PICTURE','PROPERTY_PG_SLIDE_TEXT','PROPERTY_PG_SLIDE_PRICE','PROPERTY_PG_SLIDE_TAGS_ICONS','PROPERTY_PG_SLIDE_TAGS'));
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
  
$left_link = array();
if ($arResult['USER_FIELDS']["UF_PG_LEFTLINK_NAME"]["VALUE"] != "") {
	$left_link['NAME'] = $arResult['USER_FIELDS']["UF_PG_LEFTLINK_NAME"]["VALUE"];
	$left_link['SECT'] = $arResult['USER_FIELDS']["UF_PG_LEFTLINK_SECT"]["VALUE"];
	$left_link['URL'] = $arResult['USER_FIELDS']["UF_PG_LEFTLINK_URL"]["VALUE"];
}
$right_link = array();
if ($arResult['USER_FIELDS']["UF_PG_LEFTLINK_NAME"]["VALUE"] != "") {
	$right_link['NAME'] = $arResult['USER_FIELDS']["UF_PG_RIGHTLINK_NAME"]["VALUE"];
	$right_link['SECT'] = $arResult['USER_FIELDS']["UF_PG_RIGHTLINK_SECT"]["VALUE"];
	$right_link['URL'] = $arResult['USER_FIELDS']["UF_PG_RIGHTLINK_URL"]["VALUE"];
}
$arResult['LEFTLINK'] = $left_link;
$arResult['RIGHTLINK'] = $right_link; 

  
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('TIMESTAMP_X'));

?>