<div class="page-corporative-serv">
	<div class="corporative-serv-head" <?if($arResult['UR_BG']){?>style="background:url(<?=$arResult['UR_BG']?>) no-repeat scroll center 100% / cover"<?}?>>
		<div class="head">
			<div class="container">
				<h1 class="title"><?=$h1;?></h1>
				<div class="grid">
					<div class="cell-10 shift-1">
						<div class="button">
							<span class="btn red2">Записаться</span>
						</div>
						<?php if (!empty($arResult['PREVIEW_TEXT'])): ?>							
						<p><?=$arResult['PREVIEW_TEXT'];?></p>
						<?php endif ?>
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
	<?php if (!empty($arResult["DETAIL_TEXT"])): ?>		
	<div class="simple-text">
		<div class="container">			
			<div class="grid">
				<div class="cell-10 shift-1 service_main_cont">
					<?= $arResult["DETAIL_TEXT"];?>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>
	
	<?php if ($arResult['TIMELINE']): ?>
	<div class="timeline">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">
					<h2 class="title">Таймлайн</h2>
					<div class="place">
						<?php 
						$i = 1;
						foreach ($arResult['TIMELINE'] as $tl): ?>
						<div class="section <?=($i%2 == 0)?'left':'right';?>">
							<div><?=$tl['HEAD'];?></div>
							<div><?=$tl['TEXT'];?></div>
							<img src="<?=$tl['IMG'];?>">
						</div>
						<?php 
						$i++;
						endforeach; ?>						
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?php if (!empty($arResult['PROPERTIES']['QUOTE']['VALUE']['TEXT'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['PROPERTIES']['QUOTE']['~VALUE']['TEXT'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

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
	<?php if ($arResult['PRICE_SERVICES']): ?>
	<div class="price-type-2">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">
					<h2 class="title">Прайс на услуги</h2>
					<div class="select">
						<select name="" id="clinic_select">
							<?php 
							$i = 0;
							foreach ($arResult['CLINICS'] as $sname => $centr): ?>
							<option value="<?=$i;?>"><?=$centr['NAME'];?></option>
							<?php 
							$i++;
							endforeach ?>	
						</select>
					</div>
					<?php foreach ($arResult['CLINICS'] as $sname => $centr): ?>
					<div class="list">
						<ul>
							<?php foreach ($arResult['PRICE_SERVICES'] as $service => $price): ?>
							<?php if ($price[$sname] != ''): ?>								
								<li><span><?=$service;?></span><span><?=$price[$sname];?> Р</span></li>
							<?php endif ?>

							<?php endforeach ?>	

						</ul>
					</div>
					<? endforeach ?>
					<div class="show-more-price">
						<span class="btn">Раскрыть прайс-лист</span>
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