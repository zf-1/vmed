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
?>
<?
/*-------------------------------------------*/
echo '<pre>';
print_r($arResult);
echo '</pre><hr/>';
/*-------------------------------------------*/
exit;
?>

<div class="news-list">
	<?=$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
</div>
