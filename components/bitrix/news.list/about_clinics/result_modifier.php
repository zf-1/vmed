<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach ($arResult['ITEMS'] as $key => $item) {
	if(!empty($item['PROPERTIES']['CLINIC_MAP_PDF']['VALUE'])){
		$arResult['ITEMS'][$key]['PDF'] = CFile::GetPath($item['PROPERTIES']['CLINIC_MAP_PDF']['VALUE']);
	}
}

