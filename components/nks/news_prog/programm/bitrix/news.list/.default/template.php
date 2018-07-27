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
$h1 = (!empty($arResult['SECTION']['PATH']['0']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']))?$arResult['SECTION']['PATH']['0']['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']:$arResult['SECTION']['PATH']['0']['NAME'];
?>
<div class="page-all-programming">
	<div class="head">
		<div class="container">
			<h1 class="title"><?=$h1;?></h1>
			<div class="grid">
				<div class="cell-10 shift-1">
					<p>
						<?if(!empty($arResult['USER_FIELDS']['UF_PG_PREVIEW_TEXT']['VALUE'])){?>
						<?=$arResult['USER_FIELDS']['UF_PG_PREVIEW_TEXT']['VALUE'];?>
						<?}?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="all-programs">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">				
					<div class="programs-place">
						<? 
						$cnt = 0;
						foreach ($arResult['ITEMS'] as $item) { ?>
						<div class="item <?if($cnt >= 5){?>vis_more<?}?>">
							<div class="img" style="background-image: url(<?=$item['IMG'];?>);">
								<a href="<?=$item['DETAIL_PAGE_URL'];?>"></a>
							</div>
							<div class="place">
								<div class="level-0">Программа</div>
								<div class="level-1">
									<div><a href="<?=$item['DETAIL_PAGE_URL'];?>"><?=$item['NAME'];?></a></div>
									<div>
										<span><?=$item['PRICE'];?></span>
									</div>
								</div>
								<?if(is_array($item['PREIM'])){?>						
								<div class="level-2">
									<ul>
										<?php foreach ($item['PREIM'] as $preim): ?>									
										<li><span><?=mb_strimwidth($preim,0,45,'..');?></span></li>
										<?php endforeach ?>
									</ul>
								</div>
								<?}?>
								<div class="level-3">
									<div class="more"><a href="<?=$item['DETAIL_PAGE_URL'];?>">Подробнее</a></div>
									<?if(is_array($item['TAGS'])){?>
									<div class="tags">
										<?php foreach ($item['TAGS'] as $tag): ?>									
										<div class="tag">
											<?if($tag['IMG']){?>									
											<img src="<?=$tag['IMG'];?>">
											<?}?>
											<span><?=$tag['NAME'];?></span>
										</div>
										<?php endforeach ?>
									</div>
									<?}?>
								</div>
							</div>
						</div>
						<? $cnt++;}?>
					</div>
					<?if($cnt > 5){?>	
					<div class="show-more prog_serv">
						<div class="button">Показать больше</div>
					</div>
					<?}?>
					<div class="paginator">
						<div class="to-start prog_sect_tostart">
							<span>В начало</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php if (!empty($arResult['USER_FIELDS']['UF_PG_QUOTE']['VALUE'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['USER_FIELDS']['UF_PG_QUOTE']['VALUE'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (isset($arResult["SECTION"]['PATH']['0']["DESCRIPTION"])): ?>		
	<div class="seo-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult["SECTION"]['PATH']['0']["DESCRIPTION"];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?if($arResult['NEW_PROGS']){?>
	<div class="new-programs">
		<div class="container">
			<h2 class="title">Новые программы</h2>
			<div class="slider-new-programs">
				<? foreach ($arResult['NEW_PROGS'] as $new_prog) { ?>
				<div class="item">
					<div class="img" style="background-image: url(<?=$new_prog['IMG'];?>);">
						<a href="<?=$new_prog['URL'];?>"></a>
					</div>
					<div class="place">
						<div class="level-0">Программа</div>
						<div class="level-1">
							<div><a href="<?=$new_prog['URL'];?>"><?=$new_prog['NAME'];?></a></div>
							<div>
								<span><?=$new_prog['PRICE'];?></span>
							</div>
						</div>
						<?if(is_array($new_prog['PREIM'])){?>						
						<div class="level-2">
							<ul>
								<?php foreach ($new_prog['PREIM'] as $preim): ?>									
								<li><span><?=mb_strimwidth($preim,0,45,'..');?></span></li>
								<?php endforeach ?>
							</ul>
						</div>
						<?}?>
						<div class="level-3">
							<div class="more"><a href="<?=$new_prog['URL'];?>">Подробнее</a></div>
							<?if(is_array($new_prog['TAGS'])){?>
							<div class="tags">
								<?php foreach ($new_prog['TAGS'] as $tag): ?>									
								<div class="tag">
									<?if($tag['IMG']){?>									
									<img src="<?=$tag['IMG'];?>">
									<?}?>
									<span><?=$tag['NAME'];?></span>
								</div>
								<?php endforeach ?>
							</div>
							<?}?>
						</div>
					</div>
				</div>
				<?}?>
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

	<?
	$APPLICATION->IncludeComponent(
			'nks:nks.reviews',
			'',
			Array(
				'NAME' =>	'',
			),
			false
		);
	?>

	<?php if (count($arResult['LEFTLINK']) || count($arResult['RIGHTLINK'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(count($arResult['LEFTLINK'])){?>
					<div class="prev">
						<a href="<?=$arResult['LEFTLINK']['URL'];?>">
							<span><?=$arResult['LEFTLINK']['SECT'];?></span>
							<b><?=$arResult['LEFTLINK']['NAME'];?></b>
						</a>
					</div>
					<?}?>
					<? if(count($arResult['RIGHTLINK'])){?>
					<div class="next">
						<a href="<?=$arResult['RIGHTLINK']['URL'];?>">
							<span><?=$arResult['RIGHTLINK']['SECT'];?></span>
							<b><?=$arResult['RIGHTLINK']['NAME'];?></b>
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

<div class="news-list">
	<?//$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
</div>
