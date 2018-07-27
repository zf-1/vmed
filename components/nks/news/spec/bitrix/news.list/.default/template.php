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
<div class="content">
<? if ($arResult['SECTION']['PATH']['0']['DESCRIPTION']==true) {?>
	<div class="desc">
		<?=$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
	</div>
<?}?>

<script>
$(document).ready(function() {
	$('.hover-area').on('mouseenter', function() {
		var $area_w = $(this).find('img').width();
		var $area_h = $(this).find('img').height();
		var $area_m = $(this).find('img').css("margin");
		var $overlay = $(this).find('.overlay');

		$overlay.width($area_w);
		$overlay.height($area_h);
		$overlay.css("margin", $area_m);
		$overlay.stop().fadeIn('fast');
	});

	$('.hover-area').on('mouseleave', function() {
		var $overlay = $(this).find('.overlay');

		$overlay.stop().fadeOut('fast');
	});

	$('.hover-area').click(function() {
		var url = $(this).find("a").attr("href");
		window.location.href = url;
	});
});
</script>

<div class="spec-list">
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="media">
		<div class="media-left">
			<? if (!isset($arItem["PREVIEW_PICTURE"]["SRC"]) || $arItem["PREVIEW_PICTURE"]["SRC"]==false)
				$arItem["PREVIEW_PICTURE"]["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
			?>
			<div class="hover-area">
				<div class="overlay"></div>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">

					<img class="media-object" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
				</a>			</div>

			<div class="media-heading"><h4><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h4></div>
			<?if($arItem["PROPERTIES"]["uchenaya_stepen"]["VALUE"]){
				foreach($arItem["PROPERTIES"]["uchenaya_stepen"]["VALUE"] as $arUchStepen)
					$result[] = $arUchStepen;
				echo implode(', ', $result);
				$result = "";
			};

			if($arItem["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"])
				echo "<br />",$arItem["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"];

			if($arItem["PROPERTIES"]["dop_specializaciya"]["VALUE"]){
				foreach($arItem["PROPERTIES"]["dop_specializaciya"]["VALUE"] as $arDopStepen)
					$vResult[] = $arDopStepen;
				echo "<br />",implode(', ', $vResult);
				$vResult = "";
			};

			echo '<div class="centr">';
			foreach ($arItem["PROPERTIES"]['centr']['VALUE'] as $k => $v){
				switch($v)
				{
					case "Одинцово": $url_name = "#od"; break;
					case "Звенигород": $url_name = "#zv"; break;
					default: $url_name = ""; break;
				}
				echo '<a href="/kontakty/'.$url_name.'"><img src="/local/templates/veramed/assets/img/favicon.png" style="float: left;"> ','ВЕРАМЕД ',$v,'</a><br />';
			};
			echo '</div>';
			?>
		</div>
	</div>
<?endforeach;?>
	<div class="zapis"><a href="#" data-id="<?=$arResult['SECTION']['PATH']['0']["NAME"]?>" class="btn btn-sm btn-success btn-block">Записаться на прием</a></div>
</div>

	<? if ($arResult['SECTION']['PATH']['0']['UF_BOTTOM_TEXT']==true) {?>
		<div class="desc">
			<?=nl2br($arResult['SECTION']['PATH']['0']['UF_BOTTOM_TEXT']);?>
		</div>
	<?}?>
</div>
