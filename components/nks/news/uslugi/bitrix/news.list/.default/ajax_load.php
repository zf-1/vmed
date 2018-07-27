<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?//if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$section = $_GET["id"];
$mod = $_GET["mod"];

if($section != ""){
	$APPLICATION->IncludeComponent("bitrix:news.list", "uslugi", array(
	  "IBLOCK_TYPE" => "news",
	  "IBLOCK_ID" => 1,
	  "NEWS_COUNT" => "6",
	  "SORT_BY1" => "ID",
	  "SORT_ORDER1" => "DESC",
	  "SORT_BY2" => "SORT",
	  "SORT_ORDER2" => "ASC",
	  "FILTER_NAME" => "",
	  "FIELD_CODE" => array(
		0 => "",
	  ),
	  "PROPERTY_CODE" => array(
		0 => "",
	  ),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "N",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"PARENT_SECTION" => $section,
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	  ),
	  false
	); 
}

if($mod != ""){
if(CModule::IncludeModule("iblock")){

function array_orderby()
{
    $args = func_get_args();
    $data = array_shift($args);
    foreach ($args as $n => $field) {
        if (is_string($field)) {
            $tmp = array();
            foreach ($data as $key => $row)
                $tmp[$key] = $row[$field];
            $args[$n] = $tmp;
            }
    }
    $args[] = &$data;
    call_user_func_array('array_multisort', $args);
    return array_pop($args);
}

	$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_1_SECTION",$mod,"UF_MY_FIELD");
	$count_s = 0;
	if($arUF["UF_SPECS"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_SPECS"] = $arUF["UF_SPECS"];

	foreach($arUF["UF_SPECS"]["VALUE"] as $specID)
	{
		$arSpec = CIBlockElement::GetList(Array("SHOW_COUNTER"=>"DESC","SORT"=>"ASC"), Array("ID"=>$specID, "ACTIVE"=>"Y"), false, false, Array());
		if($spec = $arSpec->GetNextElement())
		{
			$arElement = $spec->GetFields();
			$arElementProp = $spec->GetProperties();

			$arTemp[$arElement["ID"]] = $arElement;
			$arTemp[$arElement["ID"]]["PROPERTIES"] = $arElementProp;

			if (isset($arElement["PREVIEW_PICTURE"]))
				{
					$file=CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"],array('width'=>167, 'height'=>200),BX_RESIZE_IMAGE_EXACT,true);
					$arTemp[$arElement["ID"]]["IMG"]["SRC"]=$file["src"];
					$arTemp[$arElement["ID"]]["IMG"]["HEIGHT"]=$file["height"];
					$arTemp[$arElement["ID"]]["IMG"]["WIDTH"]=$file["width"];
				}else{
					$arTemp[$arElement["ID"]]["IMG"]["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
				}

			$arTemp = array_orderby($arTemp, 'SHOW_COUNTER', SORT_DESC);
		}
	}

	foreach($arTemp as $arT){
		if($count_s >= 6)
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][] = $arT;
		$count_s++;
	}

foreach ($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"] as $kI=>$vI) { 

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
	<? } } 
}
}
}
?>