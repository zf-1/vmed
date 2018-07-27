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
<div class="index-slider-place" style="background: #<?=$arResult['ITEMS'][0]['PROPERTIES']['BANNER_BG']['VALUE'];?>">
	<div class="container">
		<div class="index-slider">
			<?php foreach ($arResult['ITEMS'] as $item): ?>				
			<div class="item" data-bg="<?=$item['PROPERTIES']['BANNER_BG']['VALUE'];?>">
				<div class="slide slide-1">
					<img src="<?=$item['DETAIL_PICTURE']['SRC']?>" class="img">
					<div class="text" <? if(mb_strlen(strip_tags($item['PREVIEW_TEXT']))>35){echo 'style="padding-top:1em"';}?>><?=$item['PREVIEW_TEXT']?></div>
					<div class="more"><a href="<?=$item['PROPERTIES']['BANNER_URL']['VALUE'];?>" class="btn">Подробнее</a></div>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>
