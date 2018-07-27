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
<div class="news-list">
	<h3>Новости клиники</h3>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="media">
		<div class="media-left">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img class="media-object" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"></a>
		</div>
		<div class="media-body">
            <div class="media-date"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></div>
			<div class="media-heading"><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></div>
			<?=$arItem["PREVIEW_TEXT"];?>
		</div>
	</div>
<?endforeach;?>
</div>
