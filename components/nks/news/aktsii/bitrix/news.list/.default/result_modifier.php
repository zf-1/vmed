<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key => $arElement)
{
    $file=CFile::ResizeImageGet($arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["ID"],array('width'=>100, 'height'=>67),BX_RESIZE_IMAGE_EXACT,true);
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]=$file["src"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];

$db_props = CIBlockElement::GetProperty($arResult["ITEMS"][$key]["IBLOCK_ID"], $arResult["ITEMS"][$key]["ID"], array("sort" => "asc"), Array("CODE"=>"HideInSection"));
if($ar_props = $db_props->Fetch())
    $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["HideInSection"] = $ar_props["VALUE_XML_ID"];
else
    $arResult["ITEMS"][$key]["DISPLAY_PROPERTIES"]["HideInSection"] = "NO";
}
?>