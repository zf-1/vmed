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
<div class="page-all-news">
	<div class="head">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">
					<h1 class="title">Новости</h1>
					<p><?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/inc/all_news.php"
						)
					);?></p>
				</div>
			</div>
		</div>
	</div>

	<div class="all-news-list">
		<div class="container">			
			<div class="list">
				<? 
				$i_items = 1;
				foreach ($arResult["ITEMS"] as $item) { 
					if ($i_items<12) {
						$gr = 1;
					} else {
						$gr = ceil($i_items/6);
					}
					?>
				<div class="item <? if($i_items>12){?>vis_more<?}?> group_<?=$gr;?>">
					<div class="place">
						<div class="level-0"><?=$item['DATE'];?></div>
						<div class="level-1"><a href="<?=$item['LINK'];?>"><?=$item['NAME'];?></a></div>
						<div class="level-2"><?=$item['PREVIEW_TEXT'];?></div>
						<div class="level-3"><a href="<?=$item['LINK'];?>">Подробнее</a></div>
					</div>
				</div>
				<? $i_items++;}?>
			</div>
			<div class="show-more an_more">
				<div class="button">Показать ещё 6 новостей</div>
			</div>
			<div class="paginator">
				<div class="to-start an_tostart">
					<span>В начало</span>
				</div>
			</div>
		</div>
	</div>

	<?if($arResult['ARTICLES']){?>
		<div class="articles">
			<div class="container">
				<h2 class="title">Статьи медицинских центров "ВЕРАМЕД"</h2>
				<div class="grid">
					<div class="cell-8 shift-2">
						<div class="articles-slider">
							<? foreach ($arResult['ARTICLES'] as $art) { ?>
							<div class="item">
								<div class="level-0" style="background-image: url(<?=$art['IMG'];?>);">
									<div class="type">Статьи</div>
									<div class="name"><a href="<?=$art['LINK'];?>"><?=$art['NAME'];?></a></div>
								</div>
								<div class="level-1"><?=$art['PREVIEW_TEXT'];?></div>
								<div class="level-2">
									<?if(!empty($art['TAGS'])){?>
									<div class="tags">
										<ul>
										<? foreach($art['TAGS'] as $tag){?>										
											<li><?=$tag;?></li>
										<?}?>
										</ul>
									</div>
									<?}?>
								</div>
								<div class="level-3">
									<a href="<?=$art['LINK'];?>">Подробнее</a>
								</div>
							</div>
							<?}?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?}?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/all_spec.php"
		)
	);?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/an_links.php"
		)
	);?>

	<!-- END_PAGE -->
</div>
