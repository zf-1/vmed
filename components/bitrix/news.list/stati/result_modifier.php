<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
foreach($arResult["ITEMS"] as $key => $arElement)
{
    $file=CFile::ResizeImageGet($arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["ID"],array('width'=>100, 'height'=>67),BX_RESIZE_IMAGE_EXACT,true);
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]=$file["src"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];
}
?>