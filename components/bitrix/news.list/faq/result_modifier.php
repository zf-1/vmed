<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$_sect = CIBlockSection::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>17,'ACTIVE'=>'Y'),false,array('ID','NAME'));
while ($sect = $_sect->GetNext()) {
	$arResult['SECT'][$sect['ID']] = $sect['NAME'];	  
}
