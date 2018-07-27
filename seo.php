<?
if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != ''){
    $clear_uri = stristr($_SERVER['REQUEST_URI'],'?'.$_SERVER['QUERY_STRING'],true);
}else{
    $clear_uri = $_SERVER['REQUEST_URI'];
}

if($clear_uri != strtolower($clear_uri)){
    if(isset($_SERVER['QUERY_STRING'])  && $_SERVER['QUERY_STRING'] != ''){
        header('Location: http://'.$_SERVER['HTTP_HOST'].strtolower($clear_uri).'?'.$_SERVER['QUERY_STRING'], true, 301);
    }else{
        header('Location: http://'.$_SERVER['HTTP_HOST'].strtolower($_SERVER['REQUEST_URI']), true, 301);
    }
    exit();
}
?>