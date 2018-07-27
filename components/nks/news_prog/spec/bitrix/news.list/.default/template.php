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

<div class="page-category-spec">
	<div class="head">
		<div class="container">
			<h1 class="title"><?=$arResult['SECTION']['PATH']['0']['NAME']?></h1>
			<div class="grid">
				<div class="cell-10 shift-1">
					<p>
					<?php if ($arResult["UF_TOP_DESC"]): ?>
						<?=$arResult["UF_TOP_DESC"];?>
					<?php endif ?>
					</p>
				</div>
			</div>
			<? if(!count($arResult["ITEMS"])){ ?>			
			<div class="grid">
				<div class="cell-10 shift-1">
					<p style="color: #DD3439">
						В данный момент этот специалист не ведет прием в наших центрах.
					</p>
				</div>
			</div>
			<?}?>
		</div>
	</div>
	
	<div class="doctors-list">
		<div class="container">
			<div class="place">
				<?foreach($arResult["ITEMS"] as $arItem){
					if (!isset($arItem["PREVIEW_PICTURE"]["SRC"]) || $arItem["PREVIEW_PICTURE"]["SRC"]==false){
						$arItem["PREVIEW_PICTURE"]["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
					}
					$doc_name = explode(' ', $arItem["NAME"]);
					$addr = mb_strimwidth($arResult['CLINICS'][mb_strtolower(current($arItem["PROPERTIES"]["centr"]["VALUE"]))]['ADDR'],0,24,' ...');
				?>
				<div class="item">
					<a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
						<div class="avatar" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"];?>);"></div>
						<div class="profession">
							<?=$arItem["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"];?>
							<?
								if (!empty($arItem["PROPERTIES"]["dop_specializaciya"]["VALUE"])) {
									echo ', '.implode(', ',$arItem["PROPERTIES"]["dop_specializaciya"]["VALUE"]);
								}
							?>
						</div>
						<div class="name">
							<b><?=$doc_name[0];?></b>
							<span><?=$doc_name[1];?></span>
							<span><?=$doc_name[2];?></span>
						</div>
						<div class="adress">
							<span><?=$addr;?> ( <?=count($arItem["PROPERTIES"]["centr"]["VALUE"]);?> )</span>
						</div>
					</a>
				</div>
				<?}?>
			</div>
		</div>
	</div>

	<?php if (isset($arResult['PRICE_SERVICES']) && is_array($arResult['PRICE_SERVICES'])): ?>
	<div class="price-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="block-head">
						<h2 class="title">Прайс на услуги</h2>
						<p>Опубликованный на сайте прайс-лист не является публичным договором оферты. Предоставление услуг осуществляется на основании договора об оказании медицинских услуг. Уточняйте цены по телефону <a href="tel:84951500303">8(495)150-03-03</a>.</p>
						<div class="tabs">
							<ul>
								<?php 
								$i = 0;
								foreach ($arResult['CLINICS'] as $cname => $centr): ?>
									<li class="<?if($i==0){ echo 'active';}?>"><?=$arResult['CLINICS'][$cname]['NAME'];?></li>
								<?php 
								$i++;
								endforeach ?>
							</ul>
						</div>
					</div>
					<div class="services">
						<? $open = (count($arResult['PRICE_SERVICES'])<=3) ? true: false; ?>
						<?php foreach ($arResult['CLINICS'] as $cname =>  $centr): ?>
						<div class="list">
							<ul>
								<?php foreach ($arResult['PRICE_SERVICES'] as $sect => $services): ?>
								<li <?=($open)?'class="open"':'';?>>
									<div><span><?=$sect;?></span></div>
									<ul <?=($open)?'style="display:block"':'';?>>
										<?php foreach ($services as $service => $price): ?>
										<li>
											<span><?=$service;?></span>
											<span><?=$price[$cname];?><? if($price[$cname] != 'нет'){?> Р<?}?></span></li>
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

	<?php if (!empty($arResult['SECTION']['PATH']['0']['DESCRIPTION'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (isset($arResult["SECTION"]['PATH']['0']["UF_BOTTOM_TEXT"])): ?>		
	<div class="seo-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult["SECTION"]['PATH']['0']["UF_BOTTOM_TEXT"];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	
	<?
	$otz_head = 'Отзывы';
	
	if (!empty($arResult['UF']['UF_PREDL_PAD_M']['VALUE'])) {
		$arLett = array('а','о','у','э','и');
		$about = 'о';
		if (in_array(mb_substr($arResult['UF']['UF_PREDL_PAD_M']['VALUE'],0,1),$arLett)) {
			$about .= 'б';
		}
		$otz_head .= ' '.$about.' '.$arResult['UF']['UF_PREDL_PAD_M']['VALUE'].' Одинцово и Звенигорода';
	}
	$APPLICATION->IncludeComponent(
			'nks:nks.reviews',
			'',
			Array(
				'NAME' => $arResult['OTZYVY_NAMES'],
				'SORT' => array('created'=>'DESC'),
				'HEAD' => $otz_head
			),
			false
		);
	?>

	
<?
	$APPLICATION->IncludeComponent(
		'nks:nks.clinics',
		'',
		Array(
			'TITLE' =>	'',
			'ID' => '',
			'NAMES' => $arResult['WHERE'],
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

</div>
<!-- !!!!!!!!!!!!!!!!!!!!! -->
