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

$arFilter = Array("IBLOCK_ID"=>"13", "NAME"=>$arResult['SECTION']['PATH']['0']["NAME"]);

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
		$arResult["PRICELIST"]["SECTIONS"][$sec_res["ID"]] = $sec_res;
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

		$items = CIBlockElement::GetList(Array("SORT"=>"ASC"), Array("SECTION_ID"=>$ar_res["ID"]), false, false, Array());
		while($item = $items->GetNextElement())
		{
			$arFields = $item->GetFields();
			$arProps = $item->GetProperties();
			$arResult["PRICELIST"]["ITEMS"][$arFields["ID"]] = $arFields;
			$arResult["PRICELIST"]["ITEMS"][$arFields["ID"]]["PROPERTIES"] = $arProps;
		}
	}
}

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

$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("IBLOCK_".$arResult["ID"]."_SECTION",$arResult['SECTION']['PATH']['0']['ID'],"UF_MY_FIELD");
if($arUF["UF_SPECS"] != ""){
	$arResult["SECTION"]['PATH']['0']["UF_SPECS"] = $arUF["UF_SPECS"];

		
		  

	foreach($arUF["UF_SPECS"]["VALUE"] as $specID)
	{
		$arSpec = CIBlockElement::GetList(Array("SHOW_COUNTER"=>"DESC","SORT"=>"ASC"), Array("ID"=>$specID, "ACTIVE"=>"Y"), false, false, Array());
		if($spec = $arSpec->GetNextElement())
		{

			$arElement = $spec->GetFields();
			$arElementProp = $spec->GetProperties();

			$arTemp[$arElement["ID"]] = $arElement;
			$arTemp[$arElement["ID"]]["PROPERTIES"] = $arElementProp;

			if (isset($arElement["PREVIEW_PICTURE"]))
				{
					$file=CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"],array('width'=>167, 'height'=>200),BX_RESIZE_IMAGE_EXACT,true);
					$arTemp[$arElement["ID"]]["IMG"]["SRC"]=$file["src"];
					$arTemp[$arElement["ID"]]["IMG"]["HEIGHT"]=$file["height"];
					$arTemp[$arElement["ID"]]["IMG"]["WIDTH"]=$file["width"];
				}else{
					$arTemp[$arElement["ID"]]["IMG"]["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
				}

			//$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]] = $arElement;
			//$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]][$arElement["ID"]]["PROPERTIES"] = $arElementProp;
			$arTemp = array_orderby($arTemp, 'SHOW_COUNTER', SORT_DESC);
			//$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]] = array_orderby($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]], 'SHOW_COUNTER', SORT_DESC);
		}
	}
	//$count_s = 0;
	foreach($arTemp as $arT){
		if($count_s == 6)
		{
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["HAS_MORE_S"] = "Y";
			break;
		}
		$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][] = $arT;
		$count_s++;
	}

}


if(strpos(parse_url($_SERVER["REQUEST_URI"]["path"]), '/detskaya-polikliinika/') > 0)
{
$arResult["SECTION"]['PATH']['0']["UF_SPECS"] = "";
$count = 0;
$el = CIBlockElement::GetList(Array("SHOW_COUNTER"=>"DESC","SORT"=>"ASC"), Array("IBLOCK_ID"=>"2", "ACTIVE"=>"Y"), false, false, false);
while($element = $el->GetNextElement())
	{
		if($count == 6)
		{
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"]["HAS_MORE"] = "Y";
			break;
		}

		$arFields = $element->GetFields();
		$arProps = $element->GetProperties();
		if($arProps["vedet_priyom_detey"]["VALUE"] == "Да")
		{
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]] = $arFields;
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]]["PROPERTIES"] = $arProps;

		if (isset($arFields["PREVIEW_PICTURE"]))
		{
			$file=CFile::ResizeImageGet($arFields["PREVIEW_PICTURE"],array('width'=>167, 'height'=>200),BX_RESIZE_IMAGE_EXACT,true);
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]]["IMG"]["SRC"]=$file["src"];
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]]["IMG"]["HEIGHT"]=$file["height"];
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]]["IMG"]["WIDTH"]=$file["width"];
		}else{
			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arFields["ID"]]["IMG"]["SRC"]="/local/templates/veramed/assets/img/no_name_big.png";
		}

			$arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]] = array_orderby($arResult["SECTION"]['PATH']['0']["UF_SPECS"]["ITEMS"][$arUF["UF_SPECS"]["ID"]], 'SHOW_COUNTER', SORT_DESC);
			$count++;
		}
	}
}

?>