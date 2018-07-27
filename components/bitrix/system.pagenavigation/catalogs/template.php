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
<div class="pagination-centered">
    <ul class="pagination pagination-sm">
	<?if ($arResult["NavPageNomer"] > 1):?>
		<?if($arResult["bSavePage"]):?>
			<?/*<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a></li>*/?>
            <? if ($arResult["NavPageNomer"]-1==1):?>
			    <li><a href="<?=$arResult["sUrlPath"]?>"><?=GetMessage("nav_prev")?></a></li>
            <?else:?>
                <li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
            <?endif?>
		<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" rel="prev"><?=GetMessage("nav_begin")?></a></li>
			<?if ($arResult["NavPageNomer"] > 2):?>
			<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"><?=GetMessage("nav_prev")?></a></li>
			<?else:?>
			<li><a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" rel="prev"><?=GetMessage("nav_prev")?></a></li>
			<?endif?>
		<?endif?>
	<?else:?>
		<?/*<li class="disabled"><a href="#"><?=GetMessage("nav_begin")?></a></li><li class="disabled"><a href="#"><?=GetMessage("nav_prev")?></a></li>*/?>
	<?endif?>
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>
		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
            <li class="active"><a href="#"><?=$arResult["nStartPage"]?></a></li>
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
	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" rel="next"><?=GetMessage("nav_next")?></a></li>
		<?/*<li><a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>" rel="next"><?=GetMessage("nav_end")?></a></li>*/?>
	<?else:?>
		<li class="disabled"><a href="#"><?=GetMessage("nav_next")?></a></li><li class="disabled"><a href="#"><?=GetMessage("nav_end")?></a></li>
	<?endif?>
    </ul>
</div>