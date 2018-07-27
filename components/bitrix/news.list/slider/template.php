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
<div class="slider">
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner" role="listbox">
			<? $i=0; ?>
			<? shuffle($arResult["ITEMS"]); ?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
			<div class="item <? if ($i==0) {?>active<? $i=1; } ?>">
				<a hashstring="<?=md5($arItem["DISPLAY_PROPERTIES"]['URL']['VALUE']);?>" hashtype="href" href="<?=$arItem["DISPLAY_PROPERTIES"]['URL']['VALUE']?>"><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>"></a>
			</div>
			<?endforeach;?>
		</div>
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>