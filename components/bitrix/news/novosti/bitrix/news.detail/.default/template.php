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
$h1 = $arResult['NAME'];
?>

<div class="page-one-news">
	<div class="one-news-head">
		<div class="head">
			<div class="container">
				<div class="grid">
					<div class="cell-8 shift-2">
						<div class="date"><?=$arResult['DISPLAY_ACTIVE_FROM'];?> г</div>
						<h1 class="title"><?=$h1;?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="info-text-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="text-block block-1">
						<?=$arResult['DETAIL_TEXT'];?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="all-news-slider">
		<div class="container">
			<h2 class="title">Новости</h2>
			<div class="list">
				<? foreach ($arResult['NEWS'] as $news) { ?>
				<div class="item">
					<div class="place">
						<div class="level-0"><?=$news['DATE'];?></div>
						<div class="level-1"><a href="<?=$news['LINK'];?>"><?=$news['NAME'];?></a></div>
						<div class="level-2"><?=$news['PREVIEW_TEXT'];?></div>
						<div class="level-3"><a href="<?=$news['LINK'];?>">Подробнее</a></div>
					</div>
				</div>
				<?}?>
			</div>			
		</div>
	</div>

	<?php if (!empty($arResult['PROPERTIES']['NS_LEFT_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['NS_LEFT_LINK']['VALUE'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(!empty($arResult['PROPERTIES']['NS_LEFT_LINK']['VALUE'])){?>
					<div class="prev">
						<a href="<?=$arResult['PROPERTIES']['NS_LEFT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['NS_LEFT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['NS_LEFT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
					<? if(!empty($arResult['PROPERTIES']['NS_RIGHT_LINK']['VALUE'])){?>
					<div class="next">
						<a href="<?=$arResult['PROPERTIES']['NS_RIGHT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['NS_RIGHT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['NS_RIGHT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
				</div>						
			</div>
		</div>
	</div>
	<?php endif ?>

	<!-- END_PAGE -->
</div>



