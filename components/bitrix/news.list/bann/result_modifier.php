<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("hseohide");
$arResult["seoLink"]=array();

foreach ($arResult['ITEMS'] as $k=>$v)
{
    $arResult["seoLink"][]=$v['PROPERTIES']['URL']['VALUE'];
}
SeoHide::addLink($arResult["seoLink"],"main.news.bann");
?>