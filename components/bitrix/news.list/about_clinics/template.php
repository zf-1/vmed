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

<div class="page-all-clinic">
	<div class="head">
		<div class="container">
			<h1 class="title">Наши центры</h1>
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
								"PATH" => "/inc/all_clinic.php"
							)
						);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="place-card">
		<? foreach($arResult['ITEMS'] as $item){ ?>
		<div class="container">
			<div class="grid">
				<div class="cell-3 image">
					<div class="img" style="background-image: url(<?=$item['PREVIEW_PICTURE']['SRC'];?>);">
						<a href="<?=$item['DETAIL_PAGE_URL'];?>"></a>
					</div>
				</div>
				<div class="cell-6 info">
					<h2><a href="<?=$item['DETAIL_PAGE_URL'];?>"><?=$item['NAME'];?></a></h2>
					<?=$item['PREVIEW_TEXT'];?>
				</div>
				<div class="cell-3 contacts">
					<h2>Контакты</h2>
					<div class="location">
						<i class="icons-where-home"></i>
						<span><?=$item['PROPERTIES']['CLINIC_ADDRES']['VALUE'];?></span>
					</div>
					<div class="phone">
						<i class="icons-where-phone"></i>
						<span><a href="tel:<?=$item['PROPERTIES']['CLINIC_PHONE']['VALUE'];?>"><?=$item['PROPERTIES']['CLINIC_PHONE']['VALUE'];?></a></span>
					</div>
					<div class="time">
						<i class="icons-where-time"></i>
						<div>
							<?if(stristr($item['PROPERTIES']['CLINIC_WORKTIME']['VALUE'],';') ){
								$wt = explode(';', $item['PROPERTIES']['CLINIC_WORKTIME']['VALUE']);
								$wt = array_map('trim', $wt);												  
								$wt1_name = stristr($wt[0],' ',1);
								$wt1_val = stristr($wt[0],' ');
								$wt2_name = stristr($wt[1],' ',1);
								$wt2_val = stristr($wt[1],' ');?>
								<p><span class="d"><?=$wt1_name;?></span> <span class="t"><?=$wt1_val;?></span></p>
								<p><span class="d"><?=$wt2_name;?></span> <span class="t"><?=$wt2_val;?></span></p>
							<?}else{
								$wt1_name = stristr($item['PROPERTIES']['CLINIC_WORKTIME']['VALUE'],' ',1);
								$wt1_val = stristr($item['PROPERTIES']['CLINIC_WORKTIME']['VALUE'],' ');
								?>
								<p><span class="d"><?=$wt1_name;?></span> <span class="t"><?=$wt1_val;?></span></p>
							<?}?>
						</div>
					</div>
					<div class="i-place">						
						<? if($item['PROPERTIES']['CLINIC_MAPLINK']['VALUE']){?>						
						<a  title="Построить маршрут" target="_blank" href="<?=$item['PROPERTIES']['CLINIC_MAPLINK']['VALUE'];?>"><i class="icons-d-nav"></i></a>
						<?}?>
						<? if($item['PDF']){?>						
						<a target="_blank" href="<?=$item['PDF'];?>"><i class="icons-d-scheme"></i></a>
						<?}?>
						<? if($item['PROPERTIES']['CLINIC_360']['VALUE']){?>						
						<a title="Смотреть 3Д тур" target="_blank" href="<?=$item['PROPERTIES']['CLINIC_360']['VALUE'];?>"><i class="icons-d-360"></i></a>
						<?}?>
					</div>
				</div>
			</div>
		</div>
		<?}?>
	</div>
	<!-- END_PAGE -->
</div>