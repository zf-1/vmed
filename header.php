<? require_once('seo.php');
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?=$APPLICATION->ShowTitle()?><? if ($APPLICATION->GetCurDir()!="/") { ?> | Медицинский Центр «ВЕРАМЕД»<? } ?></title>
	<?=$APPLICATION->ShowMeta("keywords")?>
    <?=$APPLICATION->ShowMeta("description")?>
	<?=$APPLICATION->ShowHeadStrings()?>
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="icon" type="image/png" href="/favicon.png">
	
	<?include('canon.php');?>

	<? if($APPLICATION->GetCurPage(false) == '/dermablate_odintsovo/'){?>
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/nks/fw.css">
	<?}?>

	<!-- ввод значений OG -->
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?=$APPLICATION->ShowTitle("title",true)?>" />
    <meta property="og:description" content="<?=$APPLICATION->ShowTitle("description");?>" />
    <meta property="og:url" content="<? echo "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:image" content="https://veramed-clinic.ru/local/templates/veramed/assets/img/logo.png" />
    <meta property="og:site_name" content="<?php echo "Медицинский центр в Одинцово и Звенигороде 'Верамед'"; ?>" />
    <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/project/css/style.css">
    <script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery-1.12.4.min.js"></script>
</head>
<body>
	<?$APPLICATION->ShowPanel();?>
	<div class="darkness"></div>
	<div class="grid-mask">
		<div class="container">
			<div class="grid">
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
				<div class="cell-1"></div>
			</div>
		</div>
	</div>
	<div class="fixed-adaptive-block">
		<div class="logo">
			<!-- /project/images/other/big-logo.png -->
			<? if ($APPLICATION->GetCurDir()!="/") { ?> <a href="/"><?}?><img src="<?=SITE_TEMPLATE_PATH;?>/project/images/other/big-logo.png"><? if ($APPLICATION->GetCurDir()!="/") { ?></a><?}?>
		</div>
		<div class="right">
			<div class="sandwich">
				<i class="icons-sandwich"></i>
			</div>
		</div>
	</div>
	<div id="callback-form-place" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Заказать обратный звонок</div>
		</div>
		<div class="form-place">
			<form id="modal-callback-form" novalidate="novalidate">
				<input type="hidden" name="form-title" value="Обратный звонок">
				<input type="hidden" name="clinic" value="">
				<div class="field-name">
					<input type="text" placeholder="Ваше имя" name="name">
				</div>
				<div class="field-phone">
					<input type="text" placeholder="Ваш телефон" class="phone" name="phone">
				</div>      
				<div class="field-comment">
					<textarea name="comment" placeholder="Комментарий" class="valid"></textarea>
				</div>
				<div class="policy">нажимая кнопку отправить вы принимаете <a href="/o-nas/policy/">политику конфиденциальности</a></div>
				<div class="submit">
					<div class="btn">Отправить</div>
				</div>
			</form>
		</div>
	</div>

	<div id="dermablate" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>MCL 31 Dermablate</div>
		</div>
		<div class="form-place">
			<iframe width="100%" height="425" src="https://www.youtube.com/embed/yMCrm9ElQ3w?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
		</div>
	</div> 
	<div id="dermablate_text" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Эрбиевый лазер MCL31. Особенности клинического применения</div>
		</div>
		<div class="form-place">

			<h3 class="title">Эпидермальные и дермальные пятна</h3>

			Эрбиевый лазер MCL31 Dermablate позволяет проводить абляцию кожи с точность до микрона. Это дает возможность совершенно безопасно и мягко удалять широкий спектр пятен на уровне эпидермиса и дермы. При терапевтическом воздействии на небольшие пятна в проведении анестезии нет необходимости.

			<h3 class="title">Лечение рубцов</h3>

			Травмы и акне часто оставляют неизгладимые отметки на коже, создающие дискомфорт и уменьшающие качество жизни пациента. Использование лазер Dermablate в течении лишь нескольких минут удаляет шрамы и восстанавливает прежнюю гладкость и здоровый вид кожи.

			<h3 class="title">Фракционная и полная абляция кожи</h3>

			Эрбиевый лазер MCL31 Dermablate предлагает два режима омоложения кожи лица. Полное омоложение кожи (Full Skin Resurfacing) проводиться в режиме абляции и основывается на целом ряде длительных клинических исследований. Фракционная лазерная терапия осуществляется при помощи насадки MicroSpot. При этом режиме нет необходимости проведения анестезии, реабилитационный период значительно укорачивается, так что пациент может вернуться к привычной жизни через несколько дней.
		</div>
	</div>

	<div id="resume-form-place" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Связаться с отделом кадров</div>
		</div>
		<div class="form-place">
			<div id="loading">
			    <img src="/upload/nks/load.gif"> 
			</div>
			<form id="modal-resume-form" novalidate="novalidate" method="post" enctype="multipart/form-data">
				<input type="hidden" name="vac_name" value="">
				<div class="field-phone">
					<input type="text" placeholder="Телефон" class="phone" name="phone" required>
				</div>      
				<div class="field-name">
					<input type="text" placeholder="Имя" name="name" required>
				</div>
				<div class="field-comment">
					<textarea name="comment" placeholder="Комментарий" class="valid"></textarea>
				</div>
				<div class="add-resume">
					<label class="button">
						<input type="file" name="pict" id="pict" required>
						<span>Прикрепить резюме</span>
						<i class="icons-add-resume"></i>
					</label>
					<div class="k_notice"></div>
				</div>
				<div class="submit">
					<button class="btn">Отправить</button>
				</div>
			</form>
		</div>
	</div>

	<div id="register-form-place" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Записаться на прием</div>
		</div>
		<div class="form-place">
			<form id="modal-register-form" novalidate="novalidate">
				<input type="hidden" name="form-title" value="Обратный звонок">
				<div class="group">
					<div class="cell">
						<input type="text" placeholder="ФИО" name="name">
					</div>
					<div class="cell">
						<input type="text" placeholder="Контактный телефон" class="phone" name="phone">
					</div>
					<div class="cell mb1">
						<select name="clinic">
							<option value="Не определился">Не определился</option>
						</select>
					</div>
					<div class="cell">
						<textarea name="comment" placeholder="Повод обращения" class="valid"></textarea>
					</div>
				</div>	
				<div class="policy">нажимая кнопку отправить вы принимаете <a href="/o-nas/policy/">политику конфиденциальности</a></div>
				<div class="submit">
					<div class="btn zapis_sub">Отправить</div>
				</div>
			</form>
		</div>
	</div>
	<div id="register_to_prog-form-place" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Записаться на программу</div>
		</div>
		<div class="form-place">
			<form id="modal-register_to_prog-form" novalidate="novalidate">
				<input type="hidden" name="form-title" value="Записаться на программу">				
				<input type="text" name="prog_name" value="Выберите программу" disabled readonly>
				<select name="clinic">
					<option value="Не определился">Не определился</option>
				</select>
				<input type="text" placeholder="ФИО" name="name">					
				<div class="cell">
					<input type="text" placeholder="Контактный телефон" class="phone" name="phone">
				</div>
				<div class="cell">
					<input type="text" placeholder="Электронная почта" name="email">
				</div>
				<textarea name="comment" placeholder="Повод обращения" class="valid"></textarea>
				<div class="policy">нажимая кнопку отправить вы принимаете <a href="/o-nas/policy/">политику конфиденциальности</a></div>
				<div class="submit">
					<div class="btn zapis_to_prog_sub">Отправить</div>
				</div>
			</form>
		</div>
	</div>
	<div id="feedback-form-place" class="modal-window">
		<i class="icons-close"></i>
		<div class="title-form">
			<div>Оставить отзыв</div>
		</div>
		<div class="form-place">
			<form id="modal-feedback-form" novalidate="novalidate">
				<input type="hidden" name="form-title" value="Оставить отзыв">
				<div class="group">
					<div class="cell">
						<input type="text" placeholder="ФИО пациента" name="feedback_name" data-require="1">
					</div>
					<div class="cell">
						<input type="text" placeholder="Контактный телефон" class="phone" name="feedback_phone" data-require="1">
					</div>
					<div class="cell">
						<input type="text" placeholder="Электронная почта" name="feedback_email" data-require="1">
					</div>
					<div class="cell mb1 feedback_type">
						<select name="feedback_type" data-require="1">
							<option selected value="false">Отзыв о</option>
							<option value="doc">враче</option>
							<option value="serv">услуге</option>
							<option value="clin">клинике</option>
							<option value="control">обращение в отдел контроля качества</option>
						</select>
					</div>
					<div class="ajax_res"></div>
					<div class="cell">
						<textarea name="feedback_comment" placeholder="Повод обращения" class="valid" data-require="1"></textarea>
					</div>
				</div>	
				<div class="policy">нажимая кнопку отправить вы принимаете <a href="/o-nas/policy/">политику конфиденциальности</a></div>
				<div class="submit">
					<div class="btn">Отправить</div>
				</div>
			</form>
			<div class="form_res"></div>
		</div>
	</div>

	<div class="sandwich-menue">	
		<div class="search">
			<form action="/poisk/"><input type="text" name="q" placeholder="Поиск"></form>
		</div>
		<ul>
			<li><a href="/uslugi/">Услуги</a></li>
			<li><a href="/price/">Цены</a></li>
			<li><a href="/spetsialisty/">Врачи</a></li>
			<li><a href="/programmy/">Программы</a></li>
			<li><a href="/o-nas/aktsii/">Акции</a></li>
			<li><a href="/kontakty/">Контакты</a></li>
			<li class="has-children">
				<a href="">О Нас</a>
				<ul>
					<li><a href="/o-nas/">О компании</a></li>
					<li><a href="/o-nas/vakansii/">Вакансии</a></li>
					<li><a href="/otzyvi/">Отзывы</a></li>
					<li><a href="/o-nas/stati/">Статьи</a></li>
					<li><a href="/o-nas/novosti/">Новости</a></li>
					<li><a href="/faq/">Помощь</a></li>
				</ul>
			</li>
		</ul>
		<div class="phone-block">
			<div class="phone"><a href="tel:84951500303">8 495 150-03-03</a></div>
			<div class="button">
				<div class="btn get-callback"><i class="icons-red-phone"></i><span>Заказать звонок</span></div>
			</div>
		</div>
	</div>
	<div class="wrapper">
		<?
		$APPLICATION->IncludeComponent(
	"nks:nks.topmess", 
	".default", 
	array(
		"NAME" => "",
		"SORT" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"TM_REPEAT" => "4",
		"TM_NEW" => "Y",
		"TM_TIME" => "3",
		"TM_PAGES" => "",
		"TM_ON" => "N"
	),
	false
);
		?>		
		<div class="header">
			<div class="level-0">
				<div class="container">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "main_top", Array(
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
							"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
							"DELAY" => "N",	// Откладывать выполнение шаблона меню
							"MAX_LEVEL" => "1",	// Уровень вложенности меню
							"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
							"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
							"MENU_CACHE_TYPE" => "A",	// Тип кеширования
							"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
							"ROOT_MENU_TYPE" => "main",	// Тип меню для первого уровня
							"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
							"COMPONENT_TEMPLATE" => "top"
						),
						false
					);?>
				</div>
			</div>
			<div class="top_b"></div>
			<div class="level-1">
				<div class="container">
					<div class="grid">
						<div class="cell-2 logo">
							<? if ($APPLICATION->GetCurDir()!="/") { ?> <a href="/"><?}?>
								<!-- id="winter_logo" -->
								<i  class="icons-main-logo"></i>
							<? if ($APPLICATION->GetCurDir()!="/") { ?> </a><?}?>
						</div>
						<div class="cell-8 menu">
							<div class="hidden-search">
								<form action="/poisk/" method="GET">
									<input type="text" placeholder="Поиск..." name="q">
									<button class="btn red">Искать</button>
								</form>
							</div>
							<div class="search">
								<i class="icons-search"></i><span>Поиск</span>
							</div>
							<?$APPLICATION->IncludeComponent("bitrix:menu", "top", Array(
								"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
									"CHILD_MENU_TYPE" => "",	// Тип меню для остальных уровней
									"DELAY" => "N",	// Откладывать выполнение шаблона меню
									"MAX_LEVEL" => "1",	// Уровень вложенности меню
									"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
										0 => "",
									),
									"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
									"MENU_CACHE_TYPE" => "A",	// Тип кеширования
									"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
									"ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
									"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
								),
								false
							);?>
						</div>
						<div class="cell-2 phone">
							<div>
								<a href="tel:8495150-03-03">8 495 150-03-03</a>
							</div>
							<div>
								<a href="javascript:void(0)" class="get-callback"><i class="icons-menu-callback"></i><span>Заказать звонок</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
