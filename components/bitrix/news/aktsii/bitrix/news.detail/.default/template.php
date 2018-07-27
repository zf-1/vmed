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
<div class="page-one-skidka">
	<div class="one-skidka-head" style="background:url(<?=$arResult['BG'];?>)">
		<div class="head">
			<div class="container">
				<h1 class="title"><?=$h1;?></h1>
				<div class="grid">
					<div class="cell-10 shift-1">
						<div class="group">
							<form>
								<div class="cell date">
									<div><span class="t">с</span> <span class="n"><?=$arResult['FROM']['D'];?></span> <span class="d"><?=$arResult['FROM']['M'];?></span></div>
									<?if(is_array($arResult['TO'])){?>								
									<div><span class="t">по</span> <span class="n"><?=$arResult['TO']['D'];?></span> <span class="d"><?=$arResult['TO']['M'];?></span></div>
									<?}?>
								</div>
								<div class="cell">
									<select name="clinic">
										<option>Выбрать клинику</option>
										<?php foreach ($arResult['CLINICS'] as $clinic): ?>
											<option value="<?=$clinic['NAME'];?>"><?=$clinic['NAME'];?></option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="cell">
									<div class="button">
										<span class="btn red ac_call_sub">Записаться</span>
									</div>
								</div>
							</form>
						</div>
						<p><?=$arResult['PREVIEW_TEXT'];?></p>
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

	<?php if (!empty($arResult['PROPERTIES']['AC_QUOTE']['VALUE']['TEXT'])): ?>		
	<div class="quote">
		<div class="container">
			<div class="place">
				<?=$arResult['PROPERTIES']['AC_QUOTE']['~VALUE']['TEXT'];?>
			</div>
		</div>
	</div>
	<?php endif ?>

	<?if($arResult['GALLERY']){?>
	<div class="certificates">
		<div class="level-0">
			<div class="container">
				<div class="certificates-slider-one">
					<? foreach($arResult['GALLERY'] as $photo){?>					
					<div class="item">
						<img src="<?=$photo;?>">
					</div>
					<?}?>
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

	<? if(!empty($arResult['PROPERTIES']['AC_IN_CLINIC']['VALUE'])){ ?>
		<?
			$APPLICATION->IncludeComponent(
				'nks:nks.clinics',
				'',
				Array(
					'TITLE' =>	'',
					'ID' => $arResult['PROPERTIES']['AC_IN_CLINIC']['VALUE'],
					'NAMES' => '',
				),
				false
			);
		?>
	<?}?>

	<?if($arResult["NEW_AC"]){?>	
	<div class="actions-block">
		<div class="container">
			<h2 class="title">Последние акции</h2>
			<div class="grid">
				<div class="cell-8 shift-2">
					<div class="slider-actions-block">
						<? foreach ($arResult["NEW_AC"] as $ac) { ?>
						<div class="item" style="background-image: <?=$ac['BG'];?>">
							<div class="level-0">Акции</div>
							<div class="level-1">
								<div class="name"><a href="<?=$ac['LINK'];?>"><?=$ac['NAME'];?></a></div>
								<div class="date">
									с <?=$ac['FROM'];?> 
									<?if(!empty($ac['TO'])){?>
										по <?=$ac['TO'];?>
									<?}?>
								</div>
								
							</div>
							<div class="level-2">
								<div class="points">
									<?if(is_array($ac['CLINICS'])){?>
										<? foreach($ac['CLINICS'] as $c_id){?>
										<div class="point">
											<span><?=$arResult['AC_CLINICS'][$c_id]['NAME'];?></span>
										</div>
										<?}?>									
									<?}?>
								</div>
								<div class="more">
									<a href="<?=$ac['LINK'];?>">Подробнее</a>
								</div>
							</div>
						</div>						
						<?}?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?}?>


	<?php if (!empty($arResult['PROPERTIES']['AC_LEFTLINK_LINK']['VALUE']) || !empty($arResult['PROPERTIES']['AC_RIGHTLINK_LINK']['VALUE'])): ?>
	<div class="page-navigation">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<? if(!empty($arResult['PROPERTIES']['AC_LEFTLINK_LINK']['VALUE'])){?>
					<div class="prev">
						<a href="<?=$arResult['PROPERTIES']['AC_LEFTLINK_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['AC_LEFTLINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['AC_LEFTLINK_NAME']['VALUE'];?></b>
						</a>
					</div>
					<?}?>
					<? if(!empty($arResult['PROPERTIES']['AC_RIGHTLINK_LINK']['VALUE'])){?>
					<div class="next">
						<a href="<?=$arResult['PROPERTIES']['AC_RIGHTLINK_LINK']['VALUE'];?>">
							<span><?=$arResult['PROPERTIES']['AC_RIGHTLINK_SECT']['VALUE'];?></span>
							<b><?=$arResult['PROPERTIES']['AC_RIGHTLINK_NAME']['VALUE'];?></b>
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