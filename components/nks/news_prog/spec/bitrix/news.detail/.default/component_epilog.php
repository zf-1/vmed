<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$link = explode('/',trim($APPLICATION->GetCurPage(false),'/'));
if ($link[1] != $arResult['SECTION']['PATH'][0]['CODE']) {
	$link[1] = $arResult['SECTION']['PATH'][0]['CODE'];
	$url = '/'.implode('/',$link).'/';
	LocalRedirect($url,false,'301 Moved permanently');
	exit;
}

$LastModified_unix = MakeTimeStamp($arResult['TIMESTAMP_X'], "DD.MM.YYYY HH:MI:SS");
$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;
if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
	$IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
	$IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));
if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
}else{
	header('Last-Modified: '. $LastModified);
}

/*echo '<pre style="display:none">';
var_dump($LastModified);
echo '<hr/></pre>';*/


?> 
