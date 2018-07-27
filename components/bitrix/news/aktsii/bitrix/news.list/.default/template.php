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
<div class="page-all-skidka">
	<div class="head">
		<div class="container">
			<h1 class="title"><?$APPLICATION->ShowProperty("title")?></h1>
			<div class="grid">
				<div class="cell-10 shift-1">
					<p>
						<?$APPLICATION->IncludeComponent(
							"bitrix:main.include",
							"",
							Array(
								"AREA_FILE_SHOW" => "file",
								"AREA_FILE_SUFFIX" => "inc",
								"EDIT_TEMPLATE" => "",
								"PATH" => "/inc/all_act.php"
							)
						);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="all-skidka">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">
					<div class="filter">
						<div class="group">
							<form>
								<div class="cell">
									<select name="clinic">
										<option value="Клиника">Выбрать клинику</option>
										<option value="7189">ВЕРАМЕД Премиум</option>
										<option value="7190">ВЕРАМЕД Одинцово</option>
										<option value="7191">ВЕРАМЕД Звенигород</option>
									</select>
								</div>
								<div class="cell switcher-place">
								</div>
								<div class="cell">
									<div class="button ac_filter_sub"><span>Поиск</span></div>
								</div>
							</form>
						</div>
					</div>
					<div class="skidka-result-place">
						<? 
						$cnt = 0;
						foreach($arResult["ITEMS"] as $key => $arElement){ ?>
							<div data-clinic="<?=implode(',',$arElement['PROPERTIES']['AC_IN_CLINIC']['VALUE']);?>" class="item <?if($cnt >= 5){?>vis_more<?}?>" style="background-image: <?=$arElement['BG'];?>">
								<div class="level-0">Акции</div>
								<div class="level-1">
									<div class="name"><a href="<?=$arElement['DETAIL_PAGE_URL'];?>"><?=$arElement['NAME'];?></a></div>
									<div class="date">
										с <?=$arElement['FROM'];?> 
										<?if(!empty($arElement['TO'])){?>
											по <br><?=$arElement['TO'];?> 								
										<?}?>
									</div>
								</div>
								<div class="level-2">
									<div class="points">
										<? foreach($arElement['PROPERTIES']['AC_IN_CLINIC']['VALUE'] as $c_id){?>										
										<div class="point">
											<span><?=$arResult['CLINICS'][$c_id]['NAME'];?></span>
										</div>
										<?}?>
									</div>
									<div class="more">
										<a href="<?=$arElement['DETAIL_PAGE_URL'];?>">Подробнее</a>
									</div>
								</div>
							</div>
						<? $cnt++;}?>
					</div>
					<?if($cnt > 5){?>
					<?
						$all_cnt = count($arResult['ITEMS']);						  
						$actions = 'акций';
						if (($all_cnt-5) == 1) {
							$actions = 'акцию';
						}elseif (($all_cnt-5)>1 && ($all_cnt-5)<5) {
							$actions = 'акции';
						}
						if( ($all_cnt-5) > 5){
							$more = 5;
						}else{
							$more = $all_cnt - 5;
						}
					?>	
					<div class="show-more ac_more">
						<div class="button">Показать еще <?=$more;?> <?=$actions;?></div>
					</div>
					<?}?>
					<div class="paginator">
						<div class="to-start ac_tostart">
							<span>В начало</span>
						</div>
					</div>
				</div>
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

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/all_ac_links.php"
		)
	);?>

	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/all_ac_seo.php"
		)
	);?>

<!-- END_PAGE -->
</div>



