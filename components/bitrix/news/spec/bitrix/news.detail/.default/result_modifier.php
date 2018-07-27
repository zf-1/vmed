<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if (isset($arResult["PREVIEW_PICTURE"]["ID"]) && $arResult["PREVIEW_PICTURE"]["ID"]>0)
{
    $file=CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"],array('width'=>215, 'height'=>257),BX_RESIZE_IMAGE_EXACT,true);
    $arResult["PREVIEW_PICTURE"]["SRC"]=$file["src"];
    $arResult["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];
    $arResult["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];
}
?>