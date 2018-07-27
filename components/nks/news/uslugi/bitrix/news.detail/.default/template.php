<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$h1 = (!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']))?$arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']:$arResult['NAME'];
?>
<? if (in_array('для юридических лиц',$arResult['PROPERTIES']['SERVICE_TYPE']['VALUE'])){
		require('corporate.php');
	}else{
		require('simple.php');
	}
?>

