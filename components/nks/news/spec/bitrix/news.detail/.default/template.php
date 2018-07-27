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
//print_r($arResult);
?>
<div class="spec-detail">
	<div class="container-fluid">
		<div class="row" style="margin:0;">
			<div class="col-xs-4">
				<? if (!isset($arResult["PREVIEW_PICTURE"]["SRC"]) || $arResult["PREVIEW_PICTURE"]["SRC"]==false)
				{
					$arResult["PREVIEW_PICTURE"]["SRC"]="/local/templates/veramed/assets/img/no_name_big2.png";
				} else {
					$arResult["PREVIEW_PICTURE"]["SRC"]="/upload/".$arResult["PREVIEW_PICTURE"]["SUBDIR"].'/'.$arResult["PREVIEW_PICTURE"]["FILE_NAME"];
				}
				?>
				<?if(is_array($arResult["PREVIEW_PICTURE"])):?>
					<img
						class="photo"
						src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>"
						alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arResult["PREVIEW_PICTURE"]["TITLE"]?>"
						/>
				<?endif?>
			</div>
			<? if ($arResult["DETAIL_TEXT"]==false) { $arResult["DETAIL_TEXT"] = $arResult["PREVIEW_TEXT"]; } ?>
			<div class="col-xs-8">
				<h1><?echo $arResult["NAME"];?></h1>
				<div class="section">

				<?if($arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"] != "") { 
					echo '<div class="section_item"><b>'.$arResult["PROPERTIES"]["osnovnaya_specializaciya"]["NAME"].': </b>'; 
					$res = CIBlockSection::GetByID(($arResult["IBLOCK_SECTION_ID"]));
					if($ar_res = $res->GetNext())
						$page_url = $ar_res["SECTION_PAGE_URL"];
					if($page_url)
						echo '<a href="'.$page_url.'">'.$arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"].'</a><br />';
					else
						echo $arResult["PROPERTIES"]["osnovnaya_specializaciya"]["VALUE"],'<br />'; 
					echo '</div>';
				} ?>

				<?if($arResult["PROPERTIES"]["dop_specializaciya"]["VALUE"]) { 
				echo '<div class="section_item"><b>'.$arResult["PROPERTIES"]["dop_specializaciya"]["NAME"].': </b>';
				foreach($arResult["PROPERTIES"]["dop_specializaciya"]["VALUE"] as $arDop)
				{
					$arSelect = Array('NAME', 'SECTION_PAGE_URL');
					$arFilter = Array("NAME" => $arDop);
					$res = CIBlockSection::GetList(Array('SORT'=>'ASC'), $arFilter, false, $arSelect);
					if($ob = $res->GetNext())
					{
						$page_url_dop = $ob["SECTION_PAGE_URL"];
						$result[] = '<a href="'.$page_url_dop.'">'.$arDop.'</a>';
					} else {
						$result[] = $arDop;
					}
				}
					echo implode(", ", $result),'</div>';
				} ?>


				<?if($arResult["PROPERTIES"]["uchenaya_stepen"]["VALUE"] != "") {
					echo '<div class="section_item"><b>'.$arResult["PROPERTIES"]["uchenaya_stepen"]["NAME"].': </b>';
					foreach($arResult["PROPERTIES"]["uchenaya_stepen"]["VALUE"] as $arUchStepen)
						$stepen[] = $arUchStepen;
					echo implode(", ",$stepen),'</div>';
				} ?>

				<?if($arResult["PROPERTIES"]["vedet_priyom_detey"]["VALUE"] != "") {
					echo '<div class="section_item"><b>'.$arResult["PROPERTIES"]["vedet_priyom_detey"]["NAME"].': </b>';
					echo $arResult["PROPERTIES"]["vedet_priyom_detey"]["VALUE"];
					if($arResult["PROPERTIES"]["vedet_priyom_detey"]["VALUE"] == "Да") 
						echo ', '.$arResult["PROPERTIES"]["s_kakogo_vozrasta"]["VALUE"];
					echo '</div>';
				} ?>

				<?if($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"] != "") {
					echo '<div class="section_item"><b>'.$arResult["PROPERTIES"]["stazh_raboty"]["NAME"].': </b>';
					$date = new DateTime($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"]);
					echo 'С '.$date->format('Y').' ('.FormatDate("Q", MakeTimeStamp($arResult["PROPERTIES"]["stazh_raboty"]["VALUE"])).')', '</div>'; 
				} ?>

				<div id="centr">
					<?
					foreach ($arResult["DISPLAY_PROPERTIES"]['centr']['VALUE'] as $k => $v)
					{
						switch($v)
						{
							case "Одинцово": $url_name = "#od"; break;
							case "Звенигород": $url_name = "#zv"; break;
							default: $url_name = ""; break;
						}
						echo '<a href="/kontakty/'.$url_name.'"><img src="/local/templates/veramed/assets/img/favicon.png" style="float: left;"> ','ВЕРАМЕД ',$v,'</a><br />';
					}
					?>
				</div>
				</div>
				<div class="zapis" style="width: 215px;"><a href="#" data-id="<?=$arResult["NAME"]?>" class="btn btn-sm btn-success btn-block">Записаться на прием</a></div>
			</div>
		</div>
		<hr>
			<?$arProp = array(
				"obrazovanie",
				"spec_diplom",
				"ordinatura",
				"aspirantura",
				"prof_dostizh",
				"kursi",
				"seminari",
				"statti",
				"operacii",
				"osn_zabolev",
				"sertifikati",
				"det_info",
				);
			foreach($arResult["PROPERTIES"] as $key => $prop) {
				if(in_array($prop["CODE"], $arProp) && $prop["~VALUE"] != ""){
			?>
				<div class="row">
					<div class="section_left"><?=$prop["NAME"]?>:</div>
					<div class="section_right">
					<?if(is_array($prop["~VALUE"]))
						echo $prop["~VALUE"]["TEXT"];
					else
						echo $prop["~VALUE"];
					?></div>
				</div>
					<? } ?>
			<? } ?>
		<hr>
		<?
		if($arResult["PROPERTIES"]["foto_speca"]["VALUE"] != "") {
			echo '<div class="section_item big"><p>'.$arResult["PROPERTIES"]["foto_speca"]["NAME"].'</p>';
			foreach($arResult["PROPERTIES"]["foto_speca"]["VALUE"] as $key => $foto)
				echo '<a href="'.$foto.'" data-lightbox="image-foto" data-title="'.$arResult["PROPERTIES"]["foto_speca"]["DESCRIPTION"][$key].'"><img src="'.$foto.'"></a>';
			echo '</div>';
		}
		?>

		<? if($arResult["PROPERTIES"]["documents"]["VALUE"] != "") {
			echo '<div class="section_item big"><p>'.$arResult["PROPERTIES"]["documents"]["NAME"].'</p>';
			foreach($arResult["PROPERTIES"]["documents"]["VALUE"] as $key => $foto)
				echo '<a href="'.$foto.'" data-lightbox="image-docs" data-title="'.$arResult["PROPERTIES"]["foto_speca"]["DESCRIPTION"][$key].'"><img src="'.$foto.'"></a>';
			echo '</div>';
		}
		?>

		<?if($arResult["PROPERTIES"]["video"]["VALUE"]["path"] != "") {
			echo '<div class="section_item big"><p>'.$arResult["PROPERTIES"]["video"]["NAME"].'</p>';
			$video_width = $arResult["PROPERTIES"]["video"]["VALUE"]["width"];
			$video_heighth = $arResult["PROPERTIES"]["video"]["VALUE"]["height"];
			$video_path = $arResult["PROPERTIES"]["video"]["VALUE"]["path"];
			echo '<iframe width="'.$video_width.'" height="'.$video_heighth.'" src="'.$video_path.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
		} ?>
		<div class="disclaimer">Сведения на данной странице размещены с согласия специалиста.</div>
	</div>
</div>