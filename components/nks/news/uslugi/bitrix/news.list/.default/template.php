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
<div class="page-category-services">
	<div class="head">
		<div class="container">
			<h1 class="title"><?=$h1;?></h1>
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
				<a class="item" href="<?=$item['DETAIL_PAGE_URL'];?>">
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
	<?php if ($arResult["SECTION"]['PATH']['0']['UF_QUOTE']['VALUE']): ?>
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult["SECTION"]['PATH']['0']['UF_QUOTE']['VALUE'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (!empty($arResult['SECTION']['PATH']['0']['DESCRIPTION'])): ?>		
	<div class="simple-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1 seo-text">
					<?=$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (isset($arResult['PRICE_SERVICES']) && is_array($arResult['PRICE_SERVICES']) && count($arResult['PRICE_SERVICES'])): ?>
	<div class="price-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="block-head">
						<h2 class="title">Прайс на услуги</h2>
						<div class="tabs">
							<ul>
								<?php 
								$i = 0;
								foreach ($arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"]['VALUE'] as $centr): ?>
									<li class="<?if($i==0){ echo 'active';}?>"><?=$arResult['CLINICS'][$centr]['NAME'];?></li>
								<?php 
								$i++;
								endforeach ?>
							</ul>
						</div>
					</div>
					<div class="services">
						<? $open = (count($arResult['PRICE_SERVICES'])<=3) ? true: false; ?>
						<?php foreach ($arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"]['VALUE'] as $centr): ?>
						<div class="list">
							<ul>
								<?php foreach ($arResult['PRICE_SERVICES'] as $sect => $services): ?>
								<li <?=($open)?'class="open"':'';?>>
									<div><span><?=$sect;?></span></div>
									<ul <?=($open)?'style="display:block"':'';?>>
										<?php foreach ($services as $service => $price): ?>
										<li><span><?=$service;?></span><span><?=$price[$centr];?> Р</span></li>
										<?php endforeach ?>
									</ul>
								</li>
								<?php endforeach ?>															
							</ul>
						</div>
						<? endforeach ?>
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
	<?php endif ?>

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
							$addr = mb_strimwidth($arResult['CLINICS'][mb_strtolower(current($spec['PROPERTY_CENTR_VALUE']))]['ADDR'],0,24,' ...');
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


	<?php if (isset($arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"]['VALUE']) && count($arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"]['VALUE'])): ?>
	<?
		$APPLICATION->IncludeComponent(
			'nks:nks.clinics',
			'',
			Array(
				'TITLE' =>	'',
				'ID' => $arResult["SECTION"]['PATH']['0']["UF_IN_CLINIC"]['VALUE'],
			),
			false
		);
	?>
	<?endif?>
	
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

	<?php if (!empty($arResult['SEOBLOCK']) ): ?>
	<div class="seo-text tc">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult['SEOBLOCK'];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>
<!-- END_PAGE -->
</div>
