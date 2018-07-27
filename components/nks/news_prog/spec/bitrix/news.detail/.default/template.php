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
//print_r($arResult);
?>
<div class="page-one-specs">
	<div class="head">
		<div class="container">
			<h1 class="title"><?echo $arResult["INITIALS"];?></h1>
			
		</div>
	</div>
	<? 
	if (!isset($arResult["PREVIEW_PICTURE"]["SRC"]) || $arResult["PREVIEW_PICTURE"]["SRC"]==false){
		$arResult["PREVIEW_PICTURE"]["SRC"]="/local/templates/veramed/assets/img/no_name_big2.png";
	} 
	?>
	<div class="doctor-card">
		<div class="container">
			<div class="grid">
				<div class="cell-3 image">
					
					<div class="img" style="background-image: url(<?=$arResult["PREVIEW_PICTURE"]["SRC"];?>);"></div>
					<div class="button">
						<div class="btn red get-register">Записаться на прием</div>
					</div>
				</div>
				<div class="cell-6 info">
					<div class="level-0">
						<div class="group">
							<div class="cell name">
								<div><?echo $arResult["FIRST_NAME"];?></div>
								<div><?echo $arResult["SECOND_NAME"];?></div>
							</div>
							<div class="cell skills">
								<?if($arResult["PROPERTIES"]["PRIYOM_VZROSLYH"]["VALUE"] == "Да") {?>
								<div class="skill">
									<div>
										<i class="icons-doctor-1"></i>
									</div>
									<div>Прием <br>взрослых</div>
								</div>
								<?}?>
								<?if($arResult["PROPERTIES"]["vedet_priyom_detey"]["VALUE"] == "Да") {?>
								<div class="skill">
									<div>
										<i class="icons-doctor-2"></i>
									</div>
									<div>Прием детей <br><?=$arResult["PROPERTIES"]["s_kakogo_vozrasta"]["VALUE"];?></div>
								</div>
								<?}?>

							</div>
						</div>
					</div>
					<div class="level-1">
						<?if($arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"] != "") {?>					  
						<div class="spez main">
							<p>Основная специализация: </p>
							<ul>
								<li><a href="<?=$arResult['MAIN_SPEC'];?>"><?=$arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"];?></a></li>
							</ul>
						</div>
						<?}?>
						<? if(isset($arResult['DOP_SPEC'])){?>
						<div class="spez">
							<p>Дополнительная специализация: </p>
							<ul>
								<?php foreach ($arResult['DOP_SPEC'] as $dops): ?>
									<li>
										<a href="<?=$dops['LINK'];?>"><?=$dops['NAME'];?></a>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
						<?}?>
						<div class="more-info">

							<?if($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"] != "") {
								$date = new DateTime($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"]); ?>							
							<p>
								<strong>Общий медицинский стаж:</strong>
								<span><? echo 'С '.$date->format('Y').' ('.FormatDate("Q", MakeTimeStamp($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"])).')';?></span>
							</p>
							<?}?>
							<?if($arResult["PROPERTIES"]["uchenaya_stepen"]["VALUE"] != "") {?>
							<p>
								<strong>Ученая степень/категория:</strong>
								<span><? echo implode(", ",$arResult["PROPERTIES"]["uchenaya_stepen"]["VALUE"]);?></span>
							</p>
							<?}?>
						</div>
					</div>
				</div>
				<div class="cell-3 where">
					<p>Где ведет прием:</p>
					<?
					foreach ($arResult["DISPLAY_PROPERTIES"]['centr']['VALUE'] as $k => $v)
					{
						echo '<a data-name="'.$arResult['CLINICS'][mb_strtolower($v)]['ADDR'].'" href="'.$arResult['CLINICS'][mb_strtolower($v)]['LINK'].'">'.$arResult['CLINICS'][mb_strtolower($v)]['NAME'].', <br>'.$arResult['CLINICS'][mb_strtolower($v)]['ADDR'].'</a>';						
					}
					?>
				</div>
			</div>
		</div>
	</div>

	<?
	$arEdu = array(
			"obrazovanie",
			"spec_diplom",
			"ordinatura",
			"aspirantura"
			);
	$edu = ($arResult['PROPERTIES']['obrazovanie']['VALUE'] != '' || $arResult['PROPERTIES']['spec_diplom']['VALUE'] != '' || $arResult['PROPERTIES']['ordinatura']['VALUE'] != '' || $arResult['PROPERTIES']['aspirantura']['VALUE'] != '')?true:false;
	$arProp = array(
			"prof_dostizh",
			"osn_zabolev",
			"operacii",
			"kursi",
			"seminari",
			"statti",
			"sertifikati",
			"det_info",
			);
	?>

	<div class="about-doctor">
		<div class="container">
			<h2 class="title">О враче</h2>
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="tabs">
						<ul>
							<?php 
							$in = 0;
							if ($edu): ?>								
							<li data-open="<?=$in;?>">Образование</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['prof_dostizh']['~VALUE']['TEXT'])): 
							$in++;
							?>								
							<li data-open="<?=$in;?>">Достижения</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['osn_zabolev']['~VALUE']['TEXT'])): 
							$in++;?>								
							<li data-open="<?=$in;?>">Заболевания</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['operacii']['~VALUE']['TEXT'])): 
							$in++;?>		
							<li data-open="<?=$in;?>">Манипуляции</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['kursi']['~VALUE']['TEXT'])): 
							$in++;?>
								<li data-open="<?=$in;?>">Курсы</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['seminari']['~VALUE']['TEXT'])): 
							$in++;?>
								<li data-open="<?=$in;?>">События</li>
							<?php endif ?>							
							<?php if (!empty($arResult['PROPERTIES']['statti']['~VALUE']['TEXT'])): 
							$in++;?>
								<li data-open="<?=$in;?>">Публикации</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['sertifikati']['~VALUE']['TEXT'])): 
							$in++;?>
								<li data-open="<?=$in;?>">Изобретения</li>
							<?php endif ?>
							<?php if (!empty($arResult['PROPERTIES']['det_info']['~VALUE']['TEXT'])): 
							$in++;?>
								<li data-open="<?=$in;?>">Дополнительно</li>
							<?php endif ?>

						</ul>
					</div>
					<div class="hidden-blocks-slider" data-current-slide="0">
						<?php if ($edu): ?>	
						<div class="item">
							<div class="list">
							<?php foreach ($arEdu as $edu_name): 
								if($arResult['PROPERTIES'][$edu_name]['VALUE'] == '' ){
									continue;
								}
							?>							
								<div class="element">
									<div><?=$arResult['PROPERTIES'][$edu_name]['NAME'];?></div>
									<div><?=$arResult['PROPERTIES'][$edu_name]['VALUE'];?></div>	
								</div>
							<?php endforeach ?>
							</div>
						</div>
						<?php endif ?>
						<?php foreach ($arProp as $info): 
							if(empty($arResult['PROPERTIES'][$info]['~VALUE']['TEXT'])){ continue; }
						?>
						<div class="item">
							<div class="list">
								<div class="element">
									<div><?=$arResult['PROPERTIES'][$info]['NAME'];?></div>
									<div><?=$arResult['PROPERTIES'][$info]['~VALUE']['TEXT'];?></div>
								</div>
							</div>
						</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?
	if($arResult["PROPERTIES"]["foto_speca"]["VALUE"] != "") {?>
	<div class="certificates">
		<h2 class="title">Фото специалиста</h2>
		<div class="level-0">
			<div class="container">
				<div class="certificates-slider-one">
					<?foreach($arResult["PROPERTIES"]["foto_speca"]["VALUE"] as $key => $foto){?>
					<div class="item">
						<a href="<?=$foto;?>" class="fancybox" rel="spec" data-title="<?=$arResult["PROPERTIES"]["foto_speca"]["DESCRIPTION"][$key];?>">
							<img src="<?=$foto;?>">
						</a>
					</div>
					<?}?>

				</div>
			</div>
		</div>				
	</div>
	<?}?>

	<?
	if($arResult["PROPERTIES"]["documents"]["VALUE"] != "") {?>
	<div class="certificates">
		<h2 class="title">Сертификаты</h2>
		<div class="level-0">
			<div class="container">
				<div class="certificates-slider-one">
					<?foreach($arResult["PROPERTIES"]["documents"]["VALUE"] as $key => $foto){?>
					<div class="item">
						<a href="<?=$foto;?>" class="fancybox" rel="docs" data-title="<?=$arResult["PROPERTIES"]["documents"]["DESCRIPTION"][$key];?>">
							<img src="<?=$foto;?>">
						</a>
					</div>
					<?}?>

				</div>
			</div>
		</div>				
	</div>
	<?}?>
	
	<?if($arResult["PROPERTIES"]["video"]["VALUE"]["path"] != "") {?>
	<div class="seo-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<h2 class="title">Видео</h2>
					<iframe width="100%" height="405" src="<?=$arResult["PROPERTIES"]["video"]["VALUE"]["path"];?>" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
	<?}?>

	<?
		$APPLICATION->IncludeComponent(
			"nks:nks.reviews",
			"",
			Array(
				"NAME" =>	$arResult['NAME'],
			),
			false
		);
	?>
	  
	
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
								foreach ($arResult["DISPLAY_PROPERTIES"]['centr']['VALUE'] as $centr): ?>
									<li class="<?if($i==0){ echo 'active';}?>"><?=$arResult['CLINICS'][mb_strtolower($centr)]['NAME'];?></li>
								<?php 
								$i++;
								endforeach ?>
							</ul>
						</div>
					</div>
					<div class="services">
						<? $open = (count($arResult['PRICE_SERVICES'])<=3) ? true: false; ?>
						<?php foreach ($arResult["DISPLAY_PROPERTIES"]['centr']['VALUE'] as $centr): ?>
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

	<?php if ($arResult['SAME']):?>
	<div class="doctors-block">
		<div class="container">
			<h2 class="title">Похожие специалисты</h2>
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="doctors-slider">
						<?php foreach ($arResult['SAME'] as $same): 
							if (empty($same['MINIPIC'])) {
								$same['MINIPIC'] = "/local/templates/veramed/assets/img/no_name_big2.png";
							}
							$addr = mb_strimwidth($arResult['CLINICS'][mb_strtolower(current($same['PROPERTY_CENTR_VALUE']))]['ADDR'],0,24,' ...');
						?>							
						<div class="item">
							<a href="<?=$same['DETAIL_PAGE_URL'];?>">
								<div class="avatar" style="background-image: url(<?=$same['MINIPIC'];?>);"></div>
								<div class="profession">
									<?=$same['PROPERTY_OSNOVNAYA_SPECIALIZACIYA_VALUE'];?>
									<?php if (!empty($same['PROPERTY_DOP_SPECIALIZACIYA_VALUE'])){
										$prof = mb_strimwidth(implode(', ',$same['PROPERTY_DOP_SPECIALIZACIYA_VALUE']),0,28,' ...');
										echo '<br>'.$prof; 
									} ?>
								</div>
								<div class="name">
									<b><?=$same['LAST_NAME'];?></b>
									<span><?=$same['FIRST_NAME'];?></span>
									<span><?=$same['SECOND_NAME'];?></span>
								</div>
								<div class="adress">
									<span><?=$addr;?> ( <?=count($same['PROPERTY_CENTR_VALUE']);?> )</span>
								</div>
							</a>
						</div>
						<?php endforeach ?>						
					</div>
				</div>
			</div>
		</div>
	</div>		
	<?php endif ?>

	<?php if (!empty($arResult['PROPERTIES']['LEFT_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['LEFT_LINK']['VALUE'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(!empty($arResult['PROPERTIES']['LEFT_LINK']['VALUE'])){?>
					<div class="prev">
						<a href="<?=$arResult['PROPERTIES']['LEFT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['LEFT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['LEFT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
					<? if(!empty($arResult['PROPERTIES']['RIGHT_LINK']['VALUE'])){?>
					<div class="next">
						<a href="<?=$arResult['PROPERTIES']['RIGHT_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['RIGHT_LINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['RIGHT_LINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
				</div>						
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (!empty($arResult['PROPERTIES']['SEO_BLOCK']['~VALUE']['TEXT']) ): ?>
	<div class="seo-text">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<?=$arResult['PROPERTIES']['SEO_BLOCK']['~VALUE']['TEXT'];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>
</div>

<script type="text/javascript">
	var $ = jQuery;
	$(function(){
		var id = <?=$arResult['ID'];?>;
		var iblock = <?=$arResult['IBLOCK_ID'];?>;
		$.post('<?=SITE_TEMPLATE_PATH;?>/nks/ajax.php','view_counter_id='+id+'&iblock='+iblock,function(data){
			//console.log(data);
		})	

		var li = $('<li/>', {
			id:     'back_to_spec',
		});	
		var a = $('<a/>', {
			html:  '&#8592; Назад',
			href: '<?=$arResult['SECTION']['PATH'][0]['SECTION_PAGE_URL'];?>'
		}).appendTo(li);
		$('.bx-breadcrumb-item').eq(0).before(li);
	})
</script>
<?if (count($arResult["PROPERTIES"]["documents"]["VALUE"])>5) {?>
<script type="text/javascript">
	var $ = jQuery;
	$(function(){
		$('.certificates').find('.owl-page').addClass('floatleft');
	})
</script>
<? };?>	