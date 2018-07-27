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
<div class="page-one-article">
	<div class="one-article-head" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC'];?>);">
		<div class="head">
			<div class="container">
				<h1 class="title"><?=$h1;?></h1>
				<div class="grid">
					<div class="cell-10 shift-1">
						<p><?=$arResult['PREVIEW_TEXT'];?></p>
						<?if(!empty($arResult['PROPERTIES']['ART_TAGS']['VALUE'])){?>
						<div class="tags">
							<ul>
								<? foreach($arResult['PROPERTIES']['ART_TAGS']['VALUE'] as $tag){?>								
								<li><a href="/o-nas/stati/#<?=$tag;?>"><?=$tag;?></a></li>
								<?}?>
							</ul>
						</div>
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="text-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult['DETAIL_TEXT'];?>
				</div>
			</div>
		</div>
	</div>

	<?php if (!empty($arResult['PROPERTIES']['ART_QUOTE']['VALUE']['TEXT'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['PROPERTIES']['ART_QUOTE']['~VALUE']['TEXT'];?>
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
	
	<?if(!empty($arResult['PRICE_SERVICES'])){?>
	<div class="price-block">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="block-head">
						<h2 class="title">Прайс на услуги "ВЕРАМЕД"</h2>
						<p>Уважаемые пациенты!<br>
		 На данной странице вы можете частично ознакомиться с ценами на услуги нашего медицинского центра. <br>
		 Опубликованный на сайте прайс-лист не является публичным договором оферты. <br>
		 Предоставление услуг осуществляется на основании договора об оказании медицинских услуг. <br>
		 Просим вас заранее уточнять стоимость услуг, а также график работы врачей специалистов у медицинских консультантов клиник по телефону 8(495)150-03-03. Прием ведется по предварительной записи.</p>
						<div class="tabs">
							<ul>
								<?php 
								$i = 0;
								foreach ($arResult['CLINICS'] as $centr): ?>
									<li class="<?if($i==0){ echo 'active';}?>"><?=$centr['NAME'];?></li>
								<?php 
								$i++;
								endforeach ?>
							</ul>
						</div>
					</div>
					<div class="search search_in_price_wrap">
						<input class="search_in_price" placeholder="Поиск услуг в прайсе" type="text">
					</div>
					<div class="services">
						<?php foreach ($arResult['CLINICS'] as $sname => $centr): ?>
						<div class="list">
							<ul>
								<?php 
								if (count($arResult['PRICE_SERVICES']) <= 3) {
									$show_open = true;
								} else {
									$show_open = false;
								}
								
								foreach ($arResult['PRICE_SERVICES'] as $sect => $services): ?>
								<li class="p_lvl_1 <? if($show_open){ ?>open<?}?>">
									<div><span class="sect_name"><?=$sect;?></span></div>
									<ul <? if($show_open){ ?>style="display:block"<?}?>>
										<?php foreach ($services as $service => $price): ?>
										<li class="p_lvl_2"><span><?=$service;?></span><span><?=$price[$sname];?> Р</span></li>
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
					<div class="price_discl">Опубликованный на сайте прайс-лист не является публичным договором оферты. Предоставление услуг осуществляется на основании договора об оказании медицинских услуг. Просим Вас заранее уточнять стоимость услуг, а также график работы врачей-специалистов у медицинских консультантов клиник. Прием ведется по предварительной записи.</div>
				</div>
			</div>
		</div>
	</div>
	<?}?>

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

	<?php if (!empty($arResult['PROPERTIES']['ART_LEFT_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['ART_LEFT_LINK']['VALUE'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(!empty($arResult['PROPERTIES']['ART_LEFT_LINK']['VALUE'])){?>
					<div class="prev">
						<a href="<?=$arResult['PROPERTIES']['ART_LEFT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['ART_LEFT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['ART_LEFT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
					<? if(!empty($arResult['PROPERTIES']['ART_RIGHT_LINK']['VALUE'])){?>
					<div class="next">
						<a href="<?=$arResult['PROPERTIES']['ART_RIGHT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['ART_RIGHT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['ART_RIGHT_LINK_NAME']['VALUE'];?></b>
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
