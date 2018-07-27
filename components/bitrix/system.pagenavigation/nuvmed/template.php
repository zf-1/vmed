<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

//echo "<pre>"; print_r($arResult);echo "</pre>";

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");

$arResult["sUrlPath"]=str_replace("/index.php","/",$arResult["sUrlPath"]);
$arResult["sUrlPathParams"]=str_replace("/index.php","/",$arResult["sUrlPathParams"]);
?>

<div class="paginator">
	<div class="pag">
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if($arResult["bSavePage"]):?>
			<?/*<div><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a></div>*/?>
            <? if ($arResult["NavPageNomer"]-1==1):?>
			    <div><a href="<?=$arResult["sUrlPath"]?>"><?=GetMessage("nav_prev")?></a></div>
            <?else:?>
                <div><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></div>
            <?endif?>
		<?else:?>
			<?if ($arResult["NavPageNomer"] > 2):?>
			<div class="prev"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a></div>
			<?else:?>
			<div class="prev"><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" rel="prev"></a></div>
			<?endif?>
		<?endif?>
	<?else:?>
		<?/*<div class="disabled"><a href="#"><?=GetMessage("nav_begin")?></a></div><div class="disabled"><a href="#"><?=GetMessage("nav_prev")?></a></div>*/?>
	<?endif?>
	<ul>
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="active"><a class="current" href="javscript:void(0)"><?=$arResult["nStartPage"]?></a></li>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" rel="prev"><?=$arResult["nStartPage"]?></a></li>
		<?else:?>
            <? if ($arResult["nStartPage"]==1): ?>
                <li><a href="<?=$arResult["sUrlPath"]?>" <? if ($arResult["NavPageNomer"]>$arResult["nStartPage"]) { ?>rel="prev"<? } else { ?>rel="next"<? } ?>><?=$arResult["nStartPage"]?></a></li>
            <?else:?>
			    <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" <? if ($arResult["NavPageNomer"]>$arResult["nStartPage"]) { ?>rel="prev"<? } else { ?>rel="next"<? } ?>><?=$arResult["nStartPage"]?></a></li>
            <?endif?>
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
	</ul>
	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<div class="next"><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" rel="next"></a></div>
		<?/*<div><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" rel="next"><?=GetMessage("nav_end")?></a></div>*/?>
	<?else:?>
		<div class="disabled next"><a href="#"></a></div>
	<?endif?>
	</div>
</div>