<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$el = new CIBlockElement;
/*__nks{ СПИСКИ ДЛЯ ОТЗЫВА }*/

if ($_POST['type']) {
	$res = '<select name="feedback_about" data-require="1">';
	switch ($_POST['type']) {
		case 'doc':
			$_doc = $el->GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>2,'ACTIVE'=>'Y'),false,false,array('NAME'));
			while ($doc = $_doc->Fetch()) {
				$res .= '<option value="'.$doc['NAME'].'">'.$doc['NAME'].'</option>';				  
			}
			break;	
		case 'serv':
			$_doc = $el->GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>1,'ACTIVE'=>'Y'),false,false,array('NAME'));
			$f_res = array();
			while ($doc = $_doc->Fetch()) {
				$f_res[] = $doc['NAME'];
			}
			$_sct = CIBlockSection::GetList(array('NAME'=>'ASC'),array('IBLOCK_ID'=>1,'ACTIVE'=>'Y'),false,array('NAME'));
			while ($sct = $_sct->Fetch()) {
				$f_res[] = $sct['NAME'];
			}
			sort($f_res);
			foreach ($f_res as $item) {
				$res .= '<option value="'.$item.'">'.$item.'</option>';
			}
			break;		
		case 'clin':
			$res .= '<option value="ВЕРАМЕД Одинцово">ВЕРАМЕД Одинцово</option>';	
			$res .= '<option value="ВЕРАМЕД Звенигород">ВЕРАМЕД Звенигород</option>';	
			$res .= '<option value="ВЕРАМЕД ПРЕМИУМ">ВЕРАМЕД ПРЕМИУМ</option>';	
			break;
		case 'control':
			$res .= '<option value="Благодарность">Благодарность</option>';	
			$res .= '<option value="Качество лечения">Качество лечения</option>';	
			$res .= '<option value="Качество услуги">Качество услуги</option>';	
			$res .= '<option value="Качество обслуживания call-центра">Качество обслуживания call-центра</option>';	
			$res .= '<option value="Качество обслуживания администраторов ресепшен">Качество обслуживания администраторов ресепшен</option>';	
			$res .= '<option value="Предложения">Предложения</option>';	
			$res .= '<option value="Другое">Другое</option>';	
			break;

	}
	$res .= '</select>';
	echo $res;	  
}

/*__nks{ ОТЗЫВЫ }*/

if ($_POST['feedback_about']) {

	$PROP = array();
	$PROP['FEEDBACK_PHONE'] = $_POST['feedback_phone'];
	$PROP['FEEDBACK_EMAIL'] = $_POST['feedback_email'];
	$PROP['FEEDBACK_ABOUT'] = $_POST['feedback_about'];
	  
	switch ($_POST['feedback_type']) {
		case 'doc':
			$PROP['FEEDBACK_TYPE'] = 'о враче';
			break;
		case 'serv':
			$PROP['FEEDBACK_TYPE'] = 'об услуге';
			break;
		case 'clin':
			$PROP['FEEDBACK_TYPE'] = 'о клинике';
			break;
		case 'control':
			$PROP['FEEDBACK_TYPE'] = 'обращение в отдел контроля качества';
			break;
	}

	$arLoadProductArray = array(
	  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
	  "IBLOCK_ID"      => 14,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => $_POST['feedback_name'],
	  "ACTIVE"         => "N",            // активен
	  "PREVIEW_TEXT"   => $_POST['feedback_comment']
	  );

	if($PRODUCT_ID = $el->Add($arLoadProductArray)){
		$TEXT='<b>ФИО</b><br>'.$_POST['feedback_name'].'<br>';
        $TEXT.='<b>Отзыв '.$PROP['FEEDBACK_TYPE'].'</b><br>'.$_POST['feedback_about'].'<br>';
        $TEXT.='<b>Контактный телефон</b><br>'.$_POST['feedback_phone'].'<br>';
        $TEXT.='<b>Электронная почта</b><br>'.$_POST['feedback_email'].'<br>';
        $TEXT.='<b>Текст отзыва</b><br>'.$_POST['feedback_comment'].'<br>';
        $NAME= 'Новый отзыв '.$PROP['FEEDBACK_TYPE'].' от '.$_POST['feedback_name']; 
        $arEventFields = array(
            "TITLE" => $NAME,
            "TEXT" => $TEXT,
            "MAIL" => 'control@veramed.ru'
        );
        CEvent::Send("WF_NEW_LID", "s1", $arEventFields,"N","");

        //----nks{ отправляем в портал }
        /*
		claim_requestor_name - ФИО пациента
		claim_requestor_phone - Контактный телефон
		claim_requestor_email - Электронная почта
		claim_subject - Тематика обращения
		content - Повод обращения
		subject - ФИО, название клиники или услуги
        */

        $arClaimSubj = array(
        	'Отзыв' => 1,
			'Благодарность' => 2,
			'Качество лечения' => 3,
			'Качество услуги' => 4,
			'Качество обслуживания call-центра ' => 5,
			'Качество обслуживания администраторов ресепшен' => 6,
			'Предложения' => 7,
			'Другое' => 11
        );

        $post = array();
        $post['claim_requestor_name'] = trim($_POST['feedback_name']);
        $post['claim_requestor_phone'] = trim($_POST['feedback_phone']);
        $post['claim_requestor_email'] = trim($_POST['feedback_email']);

        if ($_POST['feedback_type'] == 'control') {
        	$post['claim_subject'] = $arClaimSubj[$_POST['feedback_about']];
		}else{
			$post['claim_subject'] = 1;
			$post['subject'] = 'Отзыв '.$PROP['FEEDBACK_TYPE'].': '.$_POST['feedback_about'];
		}	

		/*
		$input = $request->all();
		$secret = 'AB33SL0OXA2D1HJO';
		$input[] = $secret;
		$hash = md5(implode($input));
		*/

		$_logtext = $el->GetList(array(),array('IBLOCK_ID'=>22,'ID'=>17650),false,false,array('DETAIL_TEXT'));
		while ($logtext = $_logtext->GetNext()) {
			$log = $logtext['DETAIL_TEXT'];
		}

		$s_post = $post;
		$secret = 'AB33SL0OXA2D1HJO';
		$s_post[] = $secret;
		$tmp = implode($s_post);

		#file_put_contents(__DIR__.'/log.txt',$tmp,FILE_APPEND);

		$hash = md5(implode($s_post));
		$post['content'] = trim($_POST['feedback_comment']);
		$post['hash'] = $hash;
		$header = array('Accept: application/json');
		$log .= "\r\n---------------------------\r\n";
		$log .= "Дата: ".date('Y-m-d H:i:s')."\r\n";
		$log .= "Отправляю: \r\n";
		ob_start();
		echo "<pre>";
		print_r($post);
		echo "</pre>\r\n";
		$log .= ob_get_clean();

		$rs = sendPost('http://212.15.111.234:30910/api/tickets/claim',$post,$header);
		
		$log .= "Получен ответ: \r\n";
		ob_start();
		echo "<pre>";
		print_r(json_decode($rs));
		echo "</pre>\r\n\r\n";
		$log .= ob_get_clean();
		$log = html_entity_decode($log);
		#file_put_contents(__DIR__.'/log.txt',$log,FILE_APPEND);
		$arLog = array(
			"IBLOCK_SECTION_ID" => false,
			"IBLOCK_ID"      => 22,
			"DETAIL_TEXT_TYPE"   => 'html',
			"DETAIL_TEXT"   => $log
		);
		$el->Update(17650,$arLog);
		unset($log);

	}else{	
		$log = "\r\n---------------------------\r\n";
		ob_start();
		echo "Дата: ".date('Y-m-d H:i:s')."\r\n";
	  	echo "Возникла ошибка: ".$el->LAST_ERROR."\r\n";
	  	$log .= ob_get_clean();
	  	$log = html_entity_decode($log);
	  	#file_put_contents(__DIR__.'/log.txt',$log,FILE_APPEND);
	  	$arLog = array(
			"IBLOCK_SECTION_ID" => false,
			"DETAIL_TEXT_TYPE"   => 'html',
			"IBLOCK_ID"      => 22,
			"DETAIL_TEXT"   => $log
		);
		$el->Update(17650,$arLog);
	  	unset($log);
	}
	  
}

/*__nks{ СЧЕТЧИК ПРОСМОТРОВ }*/

if ($_POST['view_counter_id']) {
	$db_props = $el->GetProperty($_POST['iblock'], $_POST['view_counter_id'], array("sort" => "asc"), array("CODE"=>"VIEW_COUNTER"));
	if ($prop = $db_props->Fetch()) {
		$el->SetPropertyValues($_POST['view_counter_id'], $_POST['iblock'], ++$prop['VALUE'], 'VIEW_COUNTER');	
	}	  
}
  
