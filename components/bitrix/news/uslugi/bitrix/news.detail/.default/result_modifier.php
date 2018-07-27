<?

$arBlockSectionFilter = Array("IBLOCK_ID"=>"1", "NAME"=>$arResult['SECTION']['PATH']['0']["NAME"]);
$arBlockSectionres = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arBlockSectionFilter, false, Array(), false);
if($arBlockSection_res = $arBlockSectionres->GetNext())
{
	$arBlockSections = CIBlockElement::GetList(Array("NAME"=>"ASC"), Array("SECTION_ID"=>$arBlockSection_res["ID"]), false, false, Array());
	while($arBlockSection = $arBlockSections->GetNextElement())
	{
		$arSectionFields = $arBlockSection->GetFields();
		$arResult["BLOCKS"][] = $arSectionFields;
	}
}

$arFilter = Array("IBLOCK_ID"=>"13", "NAME"=>$arResult["SECTION"]["PATH"]["0"]["NAME"]);

//Получение верхнего уровня
$res = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array(), false);
$key = 0;
$arKey = 0;
if($ar_res = $res->GetNext())
{
	//Получение групп блока
	$section = CIBlockSection::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$ar_res["ID"]), false, Array(), false);
	while($sec_res = $section->GetNext())
	{
		if($sec_res["NAME"] == $arResult["NAME"]) 
		{
			$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]] = $sec_res;

			$rsParentSection = CIBlockSection::GetByID($sec_res["ID"]);
			if ($arParentSection = $rsParentSection->GetNext())
			{
			   $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
			   $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
			   while ($arSect = $rsSect->GetNext())
			   {
				   $arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]]["SECTIONS"][$arSect["ID"]] = $arSect;

					$elements = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$arSect["ID"]), false, false, Array());
					while($element = $elements->GetNextElement())
					{
						$arFields = $element->GetFields();
						$arProps = $element->GetProperties();
						$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]]["SECTIONS"][$arSect["ID"]]["ITEMS"][$arFields["ID"]] = $arFields;
						$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]]["SECTIONS"][$arSect["ID"]]["ITEMS"][$arFields["ID"]]["PROPERTIES"] = $arProps;
					}
			   }
			}

			//Получение элементов группы
			$elements = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$sec_res["ID"]), false, false, Array());
			while($element = $elements->GetNextElement())
			{
				$arFields = $element->GetFields();
				$arProps = $element->GetProperties();
				$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]]["ITEMS"][$arFields["ID"]] = $arFields;
				$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]]["ITEMS"][$arFields["ID"]]["PROPERTIES"] = $arProps;
			}
			$key++;
			$arKey++;
	

		}
	}
			$items = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$ar_res["ID"]), false, false, Array());
			while($item = $items->GetNextElement())
			{
				$arFields = $item->GetFields();
				$arProps = $item->GetProperties();
				$arResult["PRICELIST"]["ITEMS"][$arFields["ID"]] = $arFields;
				$arResult["PRICELIST"]["ITEMS"][$arFields["ID"]]["PROPERTIES"] = $arProps;
			}
}

$arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arResult['IBLOCK_ID'], "ID"=>$arResult["ID"]);
$dbRes = CIBlockElement::GetList(array('SORT'=>'ASC'), $arFilter, false, false, Array());
while ($arRes = $dbRes->GetNextElement())
{
	$arElement = $arRes->GetFields();
	$arElementProp = $arRes->GetProperties();
	$arResult["SECTION"]['PATH']['0']["UF_SPECS"] = $arElementProp["specialisty"]["VALUE"];
}

	foreach($arResult["SECTION"]['PATH']['0']["UF_SPECS"] as $specID)
	{
		$arSpec = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("ID"=>$specID, "ACTIVE"=>"Y"), false, false, Array());
		if($spec = $arSpec->GetNextElement())
		{
			$arElement = $spec->GetFields();
			$arElementProp = $spec->GetProperties();
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]] = $arElement;
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]]["PROPERTIES"] = $arElementProp;
		}
	}

/*$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["IBLOCK_ID"]."_SECTION",$arResult['ID']);
if($arUF["UF_SPECS"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_SPECS"] = $arUF["UF_SPECS"];

	foreach($arUF["UF_SPECS"]["VALUE"] as $specID)
	{
		$arSpec = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("ID"=>$specID), false, false, Array());
		if($spec = $arSpec->GetNextElement())
		{
			$arElement = $spec->GetFields();
			$arElementProp = $spec->GetProperties();
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]] = $arElement;
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]]["PROPERTIES"] = $arElementProp;
		}
	}
}*/
?>