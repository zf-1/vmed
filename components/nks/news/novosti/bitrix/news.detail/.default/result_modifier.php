<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$file=CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"],array('width'=>300, 'height'=>300),BX_RESIZE_IMAGE_PROPORTIONAL,true);
$arResult["DETAIL_PICTURE"]["SRC"]=$file["src"];
$arResult["DETAIL_PICTURE"]["HEIGHT"]=$file["height"];
$arResult["DETAIL_PICTURE"]["WIDTH"]=$file["width"];

?>