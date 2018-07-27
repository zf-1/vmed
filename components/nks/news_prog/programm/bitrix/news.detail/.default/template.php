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
$h1 = (!empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']))?$arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']:$arResult['NAME'];

?>

<div class="page-one-programming">
	<div class="one-programming-head" <?=$arResult['BG'];?>>

		<div class="head">
			<div class="container">
				<h1 class="title prog_title"><?=$h1;?></h1>
				<div class="grid">
					<div class="cell-10 shift-1">
						<div class="group">
							<div class="cell price">
								<?if(!empty($arResult['PROPERTIES']['PG_DEFAULT_PRICE']['VALUE'])){?>
								<span><?=$arResult['PROPERTIES']['PG_DEFAULT_PRICE']['VALUE'];?></span>								
								<?}?>
							</div>
							<div class="cell">
								<select name="p_select_clinic">
									<option data-price="<?=$arResult['PROPERTIES']['PG_DEFAULT_PRICE']['VALUE'];?>" value="Выбрать клинику">Выбрать клинику</option>
									<?php foreach ($arResult['CLINICS'] as $clinic): ?>
										<option data-price="<?=$clinic['PRICE'];?>" value="<?=$clinic['NAME'];?>"><?=$clinic['NAME'];?></option>
									<?php endforeach ?>
								</select>
							</div>
							<div class="cell">
								<div class="button reg_to_prog">
									<span class="btn blue">Записаться</span>
								</div>
							</div>
						</div>
						<p>
							<?if(!empty($arResult['PREVIEW_TEXT'])){?>
								<?=$arResult['PREVIEW_TEXT'];?>
							<?}?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php if ($arResult['PREIM']): ?>			
		<div class="benefit">
			<div class="container">
				<h2 class="title">Преимущества</h2>
				<div class="grid">
					<?php foreach ($arResult['PREIM'] as $preim): ?>						
					<div class="cell-4">
						<img src="<?=$preim['IMG'];?>">
						<div>
							<span><?=$preim['HEAD'];?></span>
							<span><?=$preim['TEXT'];?></span>
						</div>
					</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<?php endif ?>
	</div>

	<?if(is_array($arResult["PROPERTIES"]["PG_TAB_NAME"]["VALUE"])){?>
	<div class="info-text-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<h2 class="title">О программе</h2>
					<div class="tabs">
						<ul>
							<?for ($i=0; $i < count($arResult["PROPERTIES"]["PG_TAB_NAME"]["VALUE"]); $i++) {
								$cc = $i+1;
								?>
								<li data-open="<?=$cc;?>" <?if($cc == 1){?>class="active"<?}?>><?=$arResult["PROPERTIES"]["PG_TAB_NAME"]["VALUE"][$i];?></li>
							<?}?>
						</ul>
					</div>
					<?for ($i=0; $i < count($arResult["PROPERTIES"]["PG_TAB_CONTENT"]["VALUE"]); $i++) {
						$cc = $i+1;
						?>
						<div class="text-block block-<?=$cc;?>">
							<?=$arResult["PROPERTIES"]["PG_TAB_CONTENT"]["~VALUE"][$i]['TEXT'];?>
						</div>
					<?}?>
				</div>
			</div>
		</div>
	</div>
	<?}?>
	
	<? if($clinic['PRICELIST']){?>	
	<div class="price-block type-two">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="block-head">
						<h2 class="title">Состав программы</h2>
						<p>Опубликованный на сайте прайс-лист не является публичным договором оферты. Предоставление услуг осуществляется на основании договора об оказании медицинских услуг.</p>
						<div class="tabs">
							<ul>
								<? foreach($arResult['CLINICS'] as $clinic){?>								
								<li <?if(!$z){?>class="active"<? $z = 1;}?>><?=$clinic['NAME'];?></li>
								<?}?>
							</ul>
						</div>
					</div>
					<div class="services">
						<? foreach($arResult['CLINICS'] as $clinic){?>						
						<div class="list">
							<ul>
								<? 
								$cnt = 0;
								foreach($clinic['PRICELIST'] as $service => $price){?>								
								<li <?if($cnt >= 6){?>class="vis_more"<?}?>>
									<div><span><?=$price;?></span></div>
								</li>
								<? $cnt++;}?>
							</ul>
							<?if($cnt > 6){?>						
								<div class="show-more prog_serv">
									<div class="btn">Показать все услуги</div>
								</div>
							<?}?>
							<div class="final-price">
								<span>Стоимость программы:</span>
								<span><?=$clinic['PRICE'];?></span>
							</div>
						</div>
						<?}?>

					</div>
				</div>
				<div class="cell-10 shift-1">
					<div class="price_discl">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/inc/to_price.php"
						)
					);?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?}?>

	<?php if (isset($arResult['SPECS']) && is_array($arResult['SPECS'])): ?>
	<div class="doctors-block">
		<div class="container">
			<h2 class="title">Прием ведут</h2>
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="doctors-slider">
						<?php foreach ($arResult['SPECS'] as $spec): 
							if (empty($spec['MINIPIC'])) {
								$spec['MINIPIC'] = "/local/templates/veramed/assets/img/no_name_big2.png";
							}
							$addr = mb_strimwidth($arResult['F_CLINICS'][mb_strtolower(current($spec['PROPERTY_CENTR_VALUE']))]['ADDR'],0,24,' ...');
						?>							
						<a class="item" href="<?=$spec['DETAIL_PAGE_URL'];?>">
							<div class="avatar" style="background-image: url(<?=$spec['MINIPIC'];?>);"></div>
							<div class="profession">
								<?=$spec['PROPERTY_OSNOVNAYA_SPECIALIZACIYA_VALUE'];?>
								<?php if (!empty($spec['PROPERTY_DOP_SPECIALIZACIYA_VALUE'])){
										$prof = mb_strimwidth(implode(', ',$spec['PROPERTY_DOP_SPECIALIZACIYA_VALUE']),0,28,' ...');
										echo '<br>'.$prof; 
									} ?>
							</div>
							<div class="name">
								<b><?=$spec['LAST_NAME'];?></b>
								<span><?=$spec['FIRST_NAME'];?></span>
								<span><?=$spec['SECOND_NAME'];?></span>
							</div>
							<div class="adress">
								<span><?=$addr;?> ( <?=count($spec['PROPERTY_CENTR_VALUE']);?> )</span>
							</div>
						</a>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<? if(!empty($arResult['PROPERTIES']['PG_IN_CLINIC']['VALUE'])){ ?>
		<?
			$APPLICATION->IncludeComponent(
				'nks:nks.clinics',
				'',
				Array(
					'TITLE' =>	'',
					'ID' => $arResult['PROPERTIES']['PG_IN_CLINIC']['VALUE'],
					'NAMES' => '',
				),
				false
			);
		?>
	<?}?>
	
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
	
	<?php if (!empty($arResult['PROPERTIES']['PG_SEO_BLOCK']['~VALUE']['TEXT']) ): ?>
	<div class="seo-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult['PROPERTIES']['PG_SEO_BLOCK']['~VALUE']['TEXT'];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (!empty($arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(!empty($arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'])){?>
					<div class="prev">
						<a href="<?=$arResult['PROPERTIES']['PG_LEFT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['PG_LEFT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['PG_LEFT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
					<? if(!empty($arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'])){?>
					<div class="next">
						<a href="<?=$arResult['PROPERTIES']['PG_RIGHT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['PG_RIGHT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['PG_RIGHT_LINK_NAME']['VALUE'];?></b>
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

