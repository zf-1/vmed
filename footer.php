<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>		
		<div class="footer">
			<div class="level-0">
				<div class="container">
					<noindex>
						<?
						$uri = explode('/',$APPLICATION->GetCurPage(false),-1);
						if (stristr($APPLICATION->GetCurPage(false),'/spetsialisty/') != false && count($uri) > 2) {
							$hform = 'Запись на прием';
							$tform = 1;
						}else{
							$hform = 'Записаться на прием';
							$tform = 2;
						}
						?>
						<div class="title white"><?=$hform;?></div>
						<div class="form">
							<form id="fast_rec">
								<input type="hidden" name="fast_rec" value="y">
								<input type="hidden" name="fast_rec_type" value="<?=$tform;?>">
								<input type="hidden" name="url" value="<?=$APPLICATION->GetCurPage(false);?>">
								<div class="group">
									<div class="cell">
										<input type="text" name="fio" placeholder="Введите ваше имя">
									</div>
									<div class="cell shift-1">
										<input type="text" class="phone" name="phone" placeholder="Введите ваш телефон">
									</div>
									<div class="cell">
										<div class="btn zapis2_sub">Записаться</div>
									</div>
								</div>
							</form>
						</div>	
						
						<!-- <div class="title white">Свяжитесь со мной</div>
						<div class="grid">
							<div class="cell-10 shift-1">
								<p>Не нашли нужную вам информацию на этой странице? Оставьте свои контактные данные и наш консультант свяжется с Вами в ближайшее время</p>
							</div>
						</div>
						<div class="form">
							<form id="callme_bottom">
								<div class="group">
									<div class="cell">
										<input type="text" name="fio" placeholder="Введите ваше имя">
									</div>
									<div class="cell">
										<input type="text" class="phone" name="phone" placeholder="Введите ваш телефон">
									</div>
									<div class="cell">
										<div class="btn callme_sub">Отправить</div>
									</div>
								</div>
							</form>
						</div> -->
						
						<div class="policy">нажимая кнопку отправить вы принимаете <a href="/o-nas/policy/">политику конфиденциальности</a></div>
					</noindex>
				</div>
			</div>
			<div class="level-1">
				<div class="container">
					<div class="adapt-phone">
						<div>
							<a href="tel:84651500303">8 495 150-03-03</a>
						</div>
						<div>
							<a href="" class="get-callback"><i class="icons-menu-callback"></i><span>Заказать звонок</span></a>
						</div>
					</div>
					<div class="grid menu-place">
						<div class="cell-2">
							<ul class="strong">
								<li><a href="/uslugi/">Услуги</a></li>
								<li><a href="/price/">Цены</a></li>
								<li><a href="/spetsialisty/">Врачи</a></li>
								<li><a href="/programmy/">Программы</a></li>
								<li><a href="/o-nas/aktsii/">Акции</a></li>
								<li><a href="/otzyvi/">Отзывы</a></li>
								<li><a href="/kontakty/">Контакты</a></li>
							</ul>
						</div>
						<div class="cell-2">
							<ul>
								<li><a href="javascript:void(0)">Пациентам</a></li>
								<li><a href="/faq/">Помощь</a></li>
								<li><a href="/o-nas/skidki/">Скидки</a></li>
								<li><a href="javascript:void(0)">Вопрос врачу</a></li>
								<li><a href="/o-nas/policy/">Политика конфиденциальности</a></li>
								<li><a href="javascript:void(0)">О сайте</a></li>
							</ul>
						</div>
						<div class="cell-2">
							<ul>
								<li><a href="/o-nas/">О компании</a></li>
								<li><a href="/kontakty/">Контакты</a></li>
								<li><a href="javascript:void(0)">Миссия</a></li>
								<li><a href="javascript:void(0)">История</a></li>
								<li><a href="javascript:void(0)">Пациентам</a></li>
								<li><a href="/otzyvi/">Отзывы</a></li>
								<li><a href="/o-nas/vakansii/">Вакансии</a></li>
							</ul>
						</div>
						<div class="cell-2">
							<ul>
								<li><a href="javascript:void(0)">Пресс центр</a></li>
								<li><a href="/o-nas/novosti/">Новости</a></li>
								<li><a href="/o-nas/stati/">Статьи</a></li>
								<li><a href="javascript:void(0)">Социальная ответственность</a></li>
							</ul>
							<ul>
								<li><a href="/yuridicheskim-litsam/">Юрлицам</a></li>
								<li><a href="javascript:void(0)">Корпоративные услуги</a></li>
								<li><a href="javascript:void(0)">Партнёры</a></li>
							</ul>
						</div>
						<div class="cell-3 shift-1 phone">
							<div>
								<a href="tel:84951500303">8 495 150-03-03</a>
							</div>
							<div>
								<a href="javascript:void(0)" class="get-callback"><i class="icons-menu-callback"></i><span>Заказать звонок</span></a>
							</div>
						</div>
					</div>
					<div class="grid adress-place">
						<div class="cell-3">
							Наши клиники:
						</div>
						<a href="/kontakty/veramed-zvenigorod/" class="cell-3 adress">
							<div>ВЕРАМЕД Звенигород</div>
							<div>г. Звенигород, ул. Московская, 12</div>
							<div>пн-сб: 08:00 - 20:00, вс: 08:00 - 19:00</div>
							<div>Лицензия № ЛО-50-01-006-554</div>
						</a>
						<a href="/kontakty/veramed-premium/" class="cell-3 adress">
							<div>ВЕРАМЕД Премиум</div>
							<div>г. Одинцово, ул. Говорова, 18/1</div>
							<div>ежедневно 08:00 - 21:00</div>
							<div>Лицензия № ЛО-50-01-006-920</div>
						</a>
						<a href="/kontakty/veramed-odintsovo/" class="cell-3 adress">
							<div>ВЕРАМЕД Одинцово</div>
							<div>г. Одинцово, бул. Любы Новоселовой, 17</div>
							<div>пн-сб: 08:00 - 20:00, вс: 08:00 - 19:00</div>
							<div>Лицензия № ЛО-50-01-006-462 </div>
						</a>
					</div>
				</div>
			</div>
			<div class="level-2">
				<div class="container">
					<div class="grid">
						<div class="cell-3 copy">
							<a href="<?=($APPLICATION->GetCurPage() != "/")?'/':'javascript:void(0)'?>"><i class="icons-footer-logo"></i></a>
							<span>Copyright 2009-<?=date('Y');?></span>
						</div>
						<div class="cell-9 info">Имеются противопоказания, необходима консультация специалиста</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?$APPLICATION->ShowCSS();?>
    
    <?=$APPLICATION->ShowHeadScripts()?>
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/project/js/lib/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/project/js/lib/owl-carousel/owl.transitions.css">
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/project/js/lib/fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />

	
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery.formstyler.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/owl-carousel/owl.carousel.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery.scrollbar/jquery.scrollbar.min.js"></script>
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery.scrollbar/jquery.scrollbar.css">

	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/ui/jquery-ui.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/icheck.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/fancybox/jquery.fancybox.pack.js"></script>
	
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery.validate.min.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/lib/jquery.maskedinput.min.js"></script>

	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/fvalid.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/forms.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/project/js/main.js"></script>
	<script src="<?=SITE_TEMPLATE_PATH?>/nks/jquery.cookie.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/nks/nks.css?<?=time();?>">



	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/nks/nks.js"></script>
	<!-- Google Tag Manager -->
	<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-PF2TL8"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PF2TL8');</script>
	<!-- End Google Tag Manager -->
</body>
</html>
<? 
	

if(isset($_SESSION['NKS_STATUS']) && $_SESSION['NKS_STATUS'] == 200){
	//CHTTP::SetStatus('200 OK');
}?>