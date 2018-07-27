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
<?if($arResult["ITEMS"]){?>	
<div class="actions-block main_action_block">
	<div class="container">
		<h2 class="title">Последние акции</h2>
		<div class="grid">
			<div class="cell-8 shift-2">
				<div class="slider-actions-block">
					<? foreach ($arResult["ITEMS"] as $ac) { ?>
					<div class="item" style="background-image: <?=$ac['BG'];?>">
						<div class="level-0">Акции</div>
						<div class="level-1">
							<div class="name"><a href="<?=$ac['DETAIL_PAGE_URL'];?>"><?=$ac['NAME'];?></a></div>
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