<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


  

$arSelect = Array("ID", "NAME", "DETAIL_PAGE_URL","PREVIEW_PICTURE","SHOW_COUNTER");
$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], /*"!IBLOCK_SECTION_ID"=>$arParams["IBLOCK_SECTION_ID"], */"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$rsElements = CIBlockElement::GetList(Array("SHOW_COUNTER"=>"DESC", "NAME"=>"ASC"), $arFilter, false, false, $arSelect);
while($arElements = $rsElements->GetNextElement())
{
	$arElement = $arElements->GetFields();
	$arElementProp = $arElements->GetProperties();
	$arElement["PROPERTIES"] = $arElementProp;
	$pic = $arElement["PREVIEW_PICTURE"];
	$arElement["PREVIEW_PICTURE"] = array( "ID" => $pic, );
	if(in_array($arResult["SECTION"]["PATH"]["0"]["NAME"], $arElementProp["dop_specializaciya"]["VALUE"])
			&& !in_array($arResult["ITEMS"], $arElement["ID"]))
		array_push($arResult["ITEMS"], $arElement);
}

foreach($arResult["ITEMS"] as $key => $arElement)
{
	if(in_array($arResult["ITEMS"][$key]["NAME"], $ar_result))
		unset($arResult["ITEMS"][$key]);
	else{
	$ar_result[] = $arResult["ITEMS"][$key]["NAME"];

    $file=CFile::ResizeImageGet($arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["ID"],array('width'=>167, 'height'=>200),BX_RESIZE_IMAGE_EXACT,true);
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["SRC"]=$file["src"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["HEIGHT"]=$file["height"];
    $arResult["ITEMS"][$key]["PREVIEW_PICTURE"]["WIDTH"]=$file["width"];
	}
}

$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["ID"]."_SECTION",$arResult['SECTION']['PATH']['0']['ID'],"UF_MY_FIELD");
if($arUF["UF_BOTTOM_TEXT"]["VALUE"] != ""){
        $arResult["SECTION"]['PATH']['0']["UF_BOTTOM_TEXT"] = $arUF["UF_BOTTOM_TEXT"]["VALUE"];
}
?>