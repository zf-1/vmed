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

<div class="news-detail">
    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"];?>" class="pull-left img">
	<?echo $arResult["DETAIL_TEXT"];?>
    <hr />
    <div class="text-right"><div class="date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div></div>
</div>