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

<div style="display: none;">
	<? //print_r($arResult); ?>
</div>

<script>
	$('div.c-cols.right').prepend('<div id="uslugi"></div>');
</script>

<style>
	#uslugi p:last-child{
		margin-bottom: 20px;
	}
	#uslugi p{
		margin: 0px;
	}
	#uslugi a{
		color: #da262f;
		font-size: 14px;
		text-decoration: underline;
	}
</style>

<? 
foreach($arResult["BLOCKS"] as $arBlock) {
	$blocks = '<p><a href=\''.$arBlock["DETAIL_PAGE_URL"].'\'>'.$arBlock["NAME"].'</a></p>';

	print_r('<script>$("div#uslugi").append("'.$blocks.'")</script>');
}
?>

<div class="news-list">
	<?=$arResult['SECTION']['PATH']['0']['DESCRIPTION'];?>
</div>

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
		$overlay.css("cursor", "pointer");
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

	$('#extract').click(function(event) {
		event.preventDefault();
		$(this).parent().parent().find('span.content').toggle();
		if($(this).hasClass("expanded"))
			$(this).removeClass("expanded");
		else
			$(this).addClass("expanded");
	});
</script>

<? if($arResult["PRICELIST"]["SECTIONS"]) { ?>
<hr>
	<h2>Услуги и цены:</h2>
	<div class="pricelist">
		<? foreach($arResult["PRICELIST"]["SECTIONS"] as $arSection) {
			if($arSection["ITEMS"]) { ?>
			<div class="row">
				<div class="header">
					<div><a href="#" id="extract"><?=$arSection["NAME"]?></a></div>
					<div>ПРЕМИУМ</div>
					<div>Любы Новоселовой</div>
					<div>Звенигород</div>
				<? foreach($arSection["ITEMS"] as $arElement) { ?>
					<span class="content">
						<div><?=$arElement["NAME"]?></div>
						<? foreach($arElement["PROPERTIES"] as $property) { ?>
							<div><?=$property["VALUE"]?></div>
						<? } ?>
						<div>руб.</div>
					</span>
				<? } ?>
				</div>
			</div>
		<? } } ?>

		<? foreach($arResult["PRICELIST"]["ITEMS"] as $arItem) { ?>
		<div class="row">
			<div class="header">
				<span class="items">
					<div><?=$arItem["NAME"]?></div>
					<? foreach($arItem["PROPERTIES"] as $property) { ?>
						<div><?=$property["VALUE"]?></div>
					<? } ?>
					<div>руб.</div>
				</span>
			</div>
		</div>
		<? } ?>
	</div>
<? } ?>
<hr>
	<h2>Запись на прием:</h2>
	<div class="priem">Записаться на консультацию вы можете по телефону: <a href="/kontakty/#callc">
		<div class="callcenter" style="float: right;"> 
<span class="call_phone_2"> 
<a href="tel:+74951503497" style="color: #da262f;">8(495)150-34-97</a> 
</span> 
</div></a> или через специальную форму записи, нажав кнопку ниже.</div>
	<div class="zapis"><a href="#" data-id="<?=$arResult['SECTION']['PATH']['0']["NAME"]?>" class="btn btn-sm btn-success btn-block">Записаться на прием</a></div>

<? if(count($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"])) { ?>
<noindex><hr>
<h2>Наши врачи:</h2>
<div class="spec-list">
	<? 
$count = 0;
foreach ($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"] as $kI=>$vI) { 


	//foreach($k as $vI) {
if($vI['NAME'] != "" && $vI['DETAIL_PAGE_URL'] != 'Y'){
?>
		<div class="media">
		<div class="media-left">
			<div class="hover-area">
			<div class="overlay"></div>
			<a href="<?=$vI['DETAIL_PAGE_URL'];?>" title="<?=$vI['NAME'];?>">
			<? if (isset($vI['IMG'])) {?>
				<img class="media-object" src="<?=$vI['IMG']["SRC"];?>" width="<?=$vI["IMG"]["WIDTH"]?>" height="<?=$vI["IMG"]["HEIGHT"]?>">
			<?}?>
			</a>
			</div>
			<div class="media-heading"><h4><a class="heading" href="<?=$vI['DETAIL_PAGE_URL'];?>" title="<?=$vI['NAME'];?>"><?=$vI['NAME'];?></a></h4></div>
				<?
			if($vI["PROPERTIES"]["uchenaya_stepen"]["VALUE"])
				echo implode(', ', $vI["PROPERTIES"]["uchenaya_stepen"]["VALUE"]);

			if($vI["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"])
				echo '<br />',$vI["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"];

			if($vI["PROPERTIES"]["dop_specializaciya"]["VALUE"])
				echo '<br />',implode(', ', $vI["PROPERTIES"]["dop_specializaciya"]["VALUE"]);

			echo '<div class="centr">';
			foreach ($vI["PROPERTIES"]['centr']['VALUE'] as $k => $v)
			{
				switch($v)
				{
					case "Одинцово": $url_name = "#od"; break;
					case "Звенигород": $url_name = "#zv"; break;
					default: $url_name = ""; break;
				}
				echo '<a href="/kontakty/'.$url_name.'"><img src="/local/templates/veramed/assets/img/favicon.png" style="float: left;"> ','ВЕРАМЕД ',$v,'</a><br />';
			}
			echo '</div>';
			?>
		</div>
		</div>
	<? } /*}*/ }
if($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["HAS_MORE"] == "Y")
{
	echo '<a data-section="'.$arResult["SECTION"]['PATH']['0']["ID"].'" href="#" class="btn btn-sm btn-success btn-block" id="show-more-link">ПОКАЗАТЬ ВСЕХ СПЕЦИАЛИСТОВ</a>';
}

if($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["HAS_MORE_S"] == "Y")
{
	echo '<a data-section="'.$arResult["SECTION"]['PATH']['0']["ID"].'" href="#" class="btn btn-sm btn-success btn-block" id="show-all-spec">ПОКАЗАТЬ ВСЕХ СПЕЦИАЛИСТОВ</a>';
}
?>
</div>
<noindex>
<hr>
<? } ?>

<div class="bottom">
	Опубликованный на сайте прайс-лист не является публичным договором оферты.<br />
	Предоставление услуг осуществляется на основании договора об оказании медицинских услуг.<br />
	Просим Вас заранее уточнять стоимость услуг, а также график работы врачей-специалистов у медицинских консультантов клиник в разделе <a href="/kontakty/">контактов</a>. Прием ведется по предварительной записи.
</div>

<div class="clearfix"></div>

<script>
$('a#show-more-link').click(function(event) {
	var id = $('a#show-more-link').data("section");
	var path = "/local/templates/veramed/components/bitrix/news/uslugi/bitrix/news.list/.default/ajax_load.php?id="+id;
	event.preventDefault();
	$.get(path, function(data){
		$(".spec-list").append(data);
	});

	$(this).hide();
});

$('a#show-all-spec').click(function(event) {
	var mod = $('a#show-all-spec').data("section");
	var path = "/local/templates/veramed/components/bitrix/news/uslugi/bitrix/news.list/.default/ajax_load.php?mod="+mod;
	event.preventDefault();
	$.get(path, function(data){
		$(".spec-list").append(data);
	});

	$(this).hide();
});

</script>