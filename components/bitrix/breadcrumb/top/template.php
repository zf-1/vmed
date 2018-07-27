<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


if(empty($arResult)) return "";
if (count($arResult)>1)
{
    global $APPLICATION;
    $strReturn = '<ul class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
    $url=$APPLICATION->GetCurDir();
    $active='';
    for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
    {
    	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    	if($arResult[$index]["LINK"] <> "")
        {
           /* if (strstr($arResult[$index]["LINK"],"/uslugi/") || strstr($arResult[$index]["LINK"],"/spetsialisty/") || strstr($arResult[$index]["LINK"],"/programmy/"))
            {*/
                $uri='<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url"><span itemprop="title">'.$title.'</span></a>';
            /*}
            else
            {
                $uri='<a hashstring="'.md5($arResult[$index]["LINK"]).'" hashtype="href" href="#" title="'.$title.'" itemprop="url"><span itemprop="title">'.$title.'</span></a>';
            }*/

            if ($url==$arResult[$index]["LINK"] && !strstr($_SERVER['REQUEST_URI'],'.html')) {
                $strReturn .= '<li class="active">'.$title.'</li>';
            }
            else
            {
                $strReturn .= '<li>'.$uri.'</li>';
            }
        }
    	else
        {
    		$strReturn .= '<li>'.$title.'</li>';
        }
    }
    $strReturn .= '</ul>';

}
return $strReturn;
?>