<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<? 
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

$count = 0;
$el = CIBlockElement::GetList(Array("SHOW_COUNTER"=>"DESC","SORT"=>"ASC"), Array("IBLOCK_ID"=>"2", "ACTIVE"=>"Y"), false, false, false);
while($element = $el->GetNextElement())
	{
		if($count > 7)
		{
			$arFields = $element->GetFields();
			$arProps = $element->GetProperties();
			if($arProps["vedet_priyom_detey"]["VALUE"] == "Да")
			{
				$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["ID"][$arFields["ID"]] = $arFields;
				$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["ID"][$arFields["ID"]]["PROPERTIES"] = $arProps;

				$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["ID"][$arUF["UF_SPECS"]["ID"]] = array_orderby($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["ID"][$arUF["UF_SPECS"]["ID"]], 'SHOW_COUNTER', SORT_DESC);
			}
		}
		$count++;
	}

foreach ($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"] as $kI=>$k) { 
		foreach($k as $vI) {
if($vI['NAME'] != "")
{
	if (isset($vI["PREVIEW_PICTURE"]["ID"]) || $vI["PREVIEW_PICTURE"]["SRC"] != false)
	{
		$file=CFile::ResizeImageGet($vI["PREVIEW_PICTURE"],array('width'=>167, 'height'=>200),BX_RESIZE_IMAGE_EXACT,true);
		$vI['IMG']["SRC"]=$file["src"];
		$vI['IMG']["HEIGHT"]=$file["height"];
		$vI['IMG']["WIDTH"]=$file["width"];
	}else{
		$vI['IMG']["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
	}
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
	<? } } } ?>