<? 
$pth = parse_url($_SERVER["REQUEST_URI"]);
if(isset($_REQUEST['PAGEN_1']) && intval($_REQUEST['PAGEN_1'])>0) {?>
<link rel="canonical" href="https://veramed-clinic.ru<?=$pth["path"]; ?>?PAGEN_1=<?=$_REQUEST['PAGEN_1']?>" />
<? } else { 
	if($pth["path"] == '/spetsialisty/girudoterapevt/voropanova-elena-borisovna/'){?>
	<link rel="canonical" href="https://veramed-clinic.ru/spetsialisty/nevrolog/voropanova-elena-borisovna/" />
	<?}else{?>
	<link rel="canonical" href="https://veramed-clinic.ru<?=$pth["path"]; ?>" />
	<?}?>
<? } ?>