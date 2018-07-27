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
<div class="page-faq">
	<div class="head">
		<div class="container">
			<h1 class="title">Помощь</h1>
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
							"PATH" => "/inc/faq.php"
						)
					);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="faq">
		<div class="container">
			<div class="big-list-block">
				<div class="alphabet">
					
					<div class="search">
						<input type="text" class="f_search" placeholder="Искать ответ...">
					</div>
					<div class="place">
						<div class="list scrollbar-outer">
							<ul class="faq_sect">
								<? foreach($arResult['SECT'] as $id => $name){ ?>								
								<li><span data-id="<?=$id;?>"><?=$name;?></span></li>
								<?}?>
							</ul>
						</div>
					</div>
				</div>
				<div class="faq-place">
					<div class="select-place">
						<select class="faq_select" name="faq_select">
							<option value="">Категория вопроса</option>
							<? foreach($arResult['SECT'] as $id => $name){ ?>								
							<option value="<?=$id;?>"><?=$name;?></option>
							<?}?>
						</select>
					</div>
					<div class="search">
						<input type="text" class="f_search" placeholder="Искать ответ">
					</div>
					<ul class="res_ul">
						<? 
						$n=1;
						foreach($arResult['ITEMS'] as $qa){ ?>						
						<li <? if($n > 10){ ?>class="vis_more"<?}?> data-sect="<?=$qa['IBLOCK_SECTION_ID'];?>">
							<div class="question"><span class="f_num"><?=$n;?></span>. <span class="set_q"><?=$qa['NAME'];?></span></div>
							<div class="original_q"><?=$qa['NAME'];?></div>
							<div class="answer">
								<?=$qa['PREVIEW_TEXT'];?>
							</div>
							<div class="original_a"><?=$qa['PREVIEW_TEXT'];?></div>
						</li>
						<? $n++;}?>

					</ul>
					<? if(count($arResult['ITEMS'])>10){ ?>						
					<div class="more faq_more">
						<span>Показать больше</span>
					</div>
					<?}?>
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
			"PATH" => "/inc/faq_seo.php"
		)
	);?>
</div>
