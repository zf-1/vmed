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
<div class="page-all-articles">
	<div class="head">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">
					<h1 class="title">Статьи</h1>
					<p>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/inc/all_articles.php"
							)
						);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="all-articles-list">
		<div class="filter">
			<div class="container">
				<div class="place">
					<div class="search">
						<select name="tags">
							<option value="0">Выберите тег</option>
							<? foreach($arResult['TAGS'] as $tname => $tag){?>
								<option value="<?=$tname;?>"><?=$tname;?></option>
							<?}?>
						</select>
					</div>
					<div class="popular-tags">
						<p>Популярные теги</p>
						<div class="tags">
							<ul>
								<?
								$i_tag = 0; 
								foreach($arResult['POP_TAGS'] as $tname => $tag){
									if($i_tag>=4){break;}
									?>
									<li><a href="#<?=$tname;?>"><?=$tname;?></a></li>
								<?
								$i_tag++;
								}?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="list">
			<div class="container">
				<div class="list-place">
					<?
					$i_items = 1;
					foreach($arResult["ITEMS"] as $item) { 						  
						$gr = ceil($i_items/6);						  
						?>
					<div class="item <? if($i_items>6){?>vis_more<?}?> group_<?=$gr;?>" data-tags="<?=implode('|',$item['PROPERTIES']['ART_TAGS']['VALUE']);?>">
						<div class="place">
							<div class="level-0" style="background-image: url(<?=$item["DETAIL_PICTURE"]["SRC"];?>);">
								<div class="type">Статьи</div>
								<div class="name"><a href="<?=$item["DETAIL_PAGE_URL"];?>"><?=$item["NAME"];?></a></div>
							</div>
							<div class="level-1"><?=$item["PREVIEW_TEXT"];?></div>
							<div class="level-2">
								<div class="tags">
									<?if(!empty($item['PROPERTIES']['ART_TAGS']['VALUE'])){?>									
									<ul>
										<? foreach($item['PROPERTIES']['ART_TAGS']['VALUE'] as $tag){?>										
										<li><?=$tag;?></li>
										<?}?>
									</ul>
									<?}?>

								</div>
							</div>
							<div class="level-3">
								<a href="<?=$item["DETAIL_PAGE_URL"];?>">Подробнее</a>
							</div>
						</div>
					</div>
					<? $i_items++;}?>
				</div>
				<? if(count($arResult["ITEMS"]>6)){ ?>				
					<div class="show-more art_more">
						<div class="button">Показать еще 6 статей</div>
					</div>
				<?}?>

				<div class="paginator">
					<div class="to-start art_tostart">
						<span>В начало</span>
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
			"PATH" => "/inc/all_art_links.php"
		)
	);?>

	<!-- END_PAGE -->
</div>