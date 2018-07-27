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

$h1 = (!empty($arParams['HEAD']))?$arParams['HEAD']:'Популярные услуги';
?>
<? if(count($arResult['ITEMS'])){?>
<div class="page-category-services pop_serv_list">
	<div class="head">
		<div class="container">
			<h2 class="title"><?=$h1;?></h2>
			<div class="grid">
				<div class="cell-10 shift-1">
					<?php if ($arResult["SECTION"]['PATH']['0']['UF_SERVICE_DESC']['VALUE']): ?>
					<?=$arResult["SECTION"]['PATH']['0']['UF_SERVICE_DESC']['VALUE'];?>	
					<?php endif ?>
					
				</div>
			</div>
		</div>
	</div>
	<!-- / -->
	<div class="category-services-list">
		<div class="container">
			<div class="list">
				<? foreach ($arResult['ITEMS'] as $item) { ?>
				<a target="_blank" class="item" href="<?=$item['DETAIL_PAGE_URL'];?>">
					<div class="place">
						<div class="level-0"><?=$h1;?></div>
						<div class="level-1"><?=$item['NAME'];?></div>
						<div class="level-2"><span>Подробнее</span></div>
					</div>
				</a>
				<?}?>
			</div>
		</div>
	</div>

<!-- END_PAGE -->
</div>
<?}?>
