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
<div class="page-all-programming">
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
								"PATH" => "/inc/all_prog.php"
							)
						);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="all-programs">
		<div class="container">
			<div class="grid">
				<div class="cell-8 shift-2">	
					<div class="filter">
						<div class="group">
							<form name="prog_filter">
								<div class="cell">
									<select name="clinic">
										<option value="Клиника">Клиника</option>
										<option value="7189">ВЕРАМЕД Премиум</option>
										<option value="7190">ВЕРАМЕД Одинцово</option>
										<option value="7191">ВЕРАМЕД Звенигород</option>
									</select>
								</div>
								<div class="cell">
									<div class="switcher off"></div>
									<span>Детская программа</span>
									<input type="hidden" name="forchild" value="">
								</div>
								<div class="cell">
									<div class="button prog_filter_sub"><span>Поиск</span></div>
								</div>
							</form>
						</div>
					</div>			
					<div class="programs-place programs-result">
						<? 
						$cnt = 0;
						foreach ($arResult['ITEMS'] as $item) { ?>
						<div class="item <?if($cnt >= 5){?>vis_more<?}?>" data-clinic="<?=implode(',',$item['CLINICS']);?>" data-forchild="<?=$item['FOR_CHILD'];?>">
							<div class="img" style="background-image: url(<?=$item['IMG'];?>);">
								<a href="<?=$item['DETAIL_PAGE_URL'];?>"></a>
							</div>
							<div class="place">
								<div class="level-0">Программа</div>
								<div class="level-1">
									<div><a href="<?=$item['DETAIL_PAGE_URL'];?>"><?=$item['NAME'];?></a></div>
									<div>
										<span><?=$item['PRICE'];?></span>
									</div>
								</div>
								<?if(is_array($item['PREIM'])){?>						
								<div class="level-2">
									<ul>
										<?php foreach ($item['PREIM'] as $preim): ?>									
										<li><span><?=mb_strimwidth($preim,0,45,'..');?></span></li>
										<?php endforeach ?>
									</ul>
								</div>
								<?}?>
								<div class="level-3">
									<div class="more"><a href="<?=$item['DETAIL_PAGE_URL'];?>">Подробнее</a></div>
									<?if(is_array($item['TAGS'])){?>
									<div class="tags">
										<?php foreach ($item['TAGS'] as $tag): ?>									
										<div class="tag">
											<?if($tag['IMG']){?>									
											<img src="<?=$tag['IMG'];?>">
											<?}?>
											<span><?=$tag['NAME'];?></span>
										</div>
										<?php endforeach ?>
									</div>
									<?}?>
								</div>
							</div>
						</div>
						<? $cnt++;}?>
					</div>
					<?
					$all_cnt = count($arResult['ITEMS']);						  
					$progs = 'программ';
					if (($all_cnt-5) == 1) {
						$progs = 'программу';
					}elseif (($all_cnt-5)>1 && ($all_cnt-5)<5) {
						$progs = 'программы';
					}
					if( ($all_cnt-5) > 5){
						$more = 5;
					}else{
						$more = $all_cnt - 5;
					}
					if($cnt > 5){?>	
					<div class="show-more prog_serv">
						<div class="button">Показать ещё программы</div>
					</div>
					<?}?>
					<div class="paginator">
						<div class="to-start prog_sect_tostart">
							<span>В начало</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<div class="programs-block">
		<div class="container">
			<h2 class="title">Выбор программы стал удобнее</h2>
			<div class="programs-place">
				<? foreach($arResult['SECTIONS'] as $section){?>
				<a href="<?=$section['URL'];?>" class="item">
					<div class="place" style="background-image: url(<?=$section['IMG'];?>);">
						<div class="level-0">Программы</div>
						<div class="level-1"><?=$section['NAME'];?></div>
						<div class="level-2"><?=$section['PREVIEW_TEXT'];?></div>
						<div class="level-3"><span>Подробнее</span></div>
					</div>
				</a>				
				<?}?>				
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
			"PATH" => "/inc/all_prog_timeline.php"
		)
	);?>

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
			"PATH" => "/inc/all_prog_links.php"
		)
	);?>

	<!-- END_PAGE -->
</div>
