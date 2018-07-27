<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>
<div class="page-search">
	<div class="head">
		<div class="container">
			<h1 class="title">Поиск</h1>
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
								"PATH" => "/inc/search.php"
							)
						);?>
					</p>
				</div>
			</div>
		</div>
	</div>

	<div class="search-place">
		<div class="container">
			<div class="grid">
				<div class="cell-10 shift-1">
					<div class="search">
						<form action="" method="get">
							<input type="text" placeholder="Поиск по сайту" name="q" value="<?=$arResult["REQUEST"]["QUERY"]?>" />
							<!--input type="submit" value="<?=GetMessage("SEARCH_GO")?>" class="btn btn-success" /-->
							<input type="hidden" name="how" value="<?echo $arResult["REQUEST"]["HOW"]=="d"? "d": "r"?>" />
						</form>
						<?if(isset($arResult["REQUEST"]["ORIGINAL_QUERY"])):?>
							<div class="search-language-guess">
								<?echo GetMessage("CT_BSP_KEYBOARD_WARNING", array("#query#"=>'<a href="'.$arResult["ORIGINAL_QUERY_URL"].'">'.$arResult["REQUEST"]["ORIGINAL_QUERY"].'</a>'))?>
							</div>
						<?endif;?>
					</div>
					<div class="request">
						<div class="list">
						<?if(count($arResult["SEARCH"])>0):?>
							<?foreach($arResult["SEARCH"] as $arItem){
								if (substr($arItem["URL"],0,1) != '/') {
									$arItem["URL"] = '/'.$arItem["URL"];
								}
							?>
							<div class="item">
								<div class="name"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a></div>
								<div class="description"><?echo $arItem["BODY_FORMATED"]?></div>
								<div class="more"><a href="<?echo $arItem["URL"]?>">Подробнее</a></div>
							</div>
							<?}?>
						<?else:?>
							К сожалению, поиск ничего не нашел по Вашему запросу<br> Попробуйте уточнить поисковый запрос или позвоните нам - мы поможем найти то, что Вам нужно<br>
						<?endif;?>
						</div>
						<!-- <div class="show-more">
							<span class="button">Показать еще</span>
						</div> -->
					</div>
					<?if($arParams["DISPLAY_BOTTOM_PAGER"] != "N") echo $arResult["NAV_STRING"]?>
				</div>
			</div>
		</div>
	</div>
</div>
