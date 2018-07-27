<div class="page-one-services">
	<div class="head">
		<div class="container">
			<h1 class="title"><?=$h1?></h1>
			<div class="grid">
				<div class="cell-10 shift-1">
					<?echo $arResult["PREVIEW_TEXT"];?>
				</div>
			</div>
		</div>
	</div>
	  
	<?php if (!empty($arResult['PROPERTIES']['QUOTE']['VALUE']['TEXT'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['PROPERTIES']['QUOTE']['~VALUE']['TEXT'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<div class="simple-text">
		<div class="container">			
			<div class="grid">
				<div class="cell-10 shift-1 service_main_cont">
					<?= $arResult["DETAIL_TEXT"];?>
				</div>
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
					<div class="services">
						<? $open = (count($arResult['PRICE_SERVICES'])<=3) ? true: false; ?>
						<?php foreach ($arResult['CLINICS'] as $sname => $centr): ?>
						<div class="list">
							<ul>
								<?php foreach ($arResult['PRICE_SERVICES'] as $sect => $services): ?>
								<li <?=($open)?'class="open"':'';?>>
									<div><span><?=$sect;?></span></div>
									<ul <?=($open)?'style="display:block"':'';?>>
										<?php foreach ($services as $service => $price): ?>
										<li><span><?=$service;?></span><span><?=$price[$sname];?> Р</span></li>
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
<!-- END_PAGE -->
</div>