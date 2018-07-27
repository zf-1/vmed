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
<div class="all-news-slider">
	<div class="container">
		<h2 class="title">Новости</h2>
		<div class="list">
			<? foreach ($arResult['ITEMS'] as $news) { ?>
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