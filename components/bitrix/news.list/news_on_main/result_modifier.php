<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arMonth = array(
        "01" => "Января",
        "02" => "Февраля",
        "03" => "Марта",
        "04" => "Апреля",
        "05" => "Мая",
        "06" => "Июня",
        "07" => "Июля",
        "08" => "Августа",
        "09" => "Сентября",
        "10" => "Октября",
        "11" => "Ноября",
        "12" => "Декабря"
    );
$n_arr = array();
$last_mod = 0;
foreach ($arResult['ITEMS'] as $key => $item) {
    if (stristr($item['DATE_ACTIVE_FROM'],' ') != false) {
        $unix_time = MakeTimeStamp($item['DATE_ACTIVE_FROM'], "DD.MM.YYYY HH:MI:SS");
    }else{
        $unix_time = MakeTimeStamp($item['DATE_ACTIVE_FROM'], "DD.MM.YYYY");
    }
    if ($unix_time > $last_mod) {
        $last_mod = $unix_time;
    }
    $format_date = date('j',$unix_time).' '.$arMonth[date('m',$unix_time)].' '.date('Y',$unix_time).', '.date('H:i',$unix_time);
    $format_name = mb_strimwidth($item['NAME'],0,50,' ...');
    $format_text = mb_strimwidth(trim(strip_tags($item['PREVIEW_TEXT'])),0,100,' ...');
    $n_arr[$key]['NAME'] = $format_name;
    $n_arr[$key]['PREVIEW_TEXT'] = $format_text;
    $n_arr[$key]['DATE'] = $format_date;
    $n_arr[$key]['LINK'] = $item['DETAIL_PAGE_URL'];
}
$arResult['ITEMS'] = $n_arr;
$arResult['LAST_MOD'] = $last_mod;
$cp = $this->__component; // объект компонента
if (is_object($cp))
   $cp->SetResultCacheKeys(array('LAST_MOD'));
