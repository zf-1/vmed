<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
//$this->setFrameMode(true);

?>

					<p>Уважаемые пациенты!<br>
	 На данной странице вы можете ознакомиться с ценами на основные услуги нашего медицинского центра. <br>
	 Опубликованный на сайте прайс-лист не является публичным договором оферты. <br>
	 Предоставление услуг осуществляется на основании договора об оказании медицинских услуг. <br>
						Просим вас заранее уточнять стоимость услуг, а также график работы врачей специалистов у медицинских консультантов клиник по телефону <a href="tel:84951500303">8(495)150-03-03</a>. Прием ведется по предварительной записи.</p>
					<div class="tabs">
						<ul>
							<?php 
							$i = 0;
							foreach ($arResult['CLINICS'] as $centr): ?>
								<li class="<?if($i==0){ echo 'active';}?>"><?=$centr['NAME'];?></li>
							<?php 
							$i++;
							endforeach ?>
						</ul>
					</div>
				</div>
				<div class="search search_in_price_wrap">
					<input class="search_in_price" placeholder="Поиск услуг в прайсе" type="text">
				</div>
				<div class="services">
					<?php foreach ($arResult['CLINICS'] as $sname => $centr): ?>
					<div class="list">
						<ul>
							<?php foreach ($arResult['PRICE_SERVICES'] as $sect => $services): ?>
							<li class="p_lvl_1">
								<div><span class="sect_name"><?=$sect;?></span></div>
								<ul>
									<?php foreach ($services as $service => $price): ?>
									<li class="p_lvl_2"><span><?=$service;?></span><span><?=$price[$sname];?> Р</span></li>
									<?php endforeach ?>
								</ul>
							</li>
							<?php endforeach ?>															
						</ul>
					</div>
					<? endforeach ?>
				</div>
			</div>
			<div class="cell-10 shift-1">
				<div class="price_discl">
					<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/inc/to_price.php"
						)
					);?>
				</div>
			</div>
		</div>
	</div>
</div>

<?
	$APPLICATION->IncludeComponent(
		'nks:nks.clinics',
		'',
		Array(
			'TITLE' =>	'',
			'ID' => '',
		),
		false
	);
?>

<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/price_seo.php"
		)
	);?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		"",
		Array(
			"AREA_FILE_SHOW" => "file",
			"AREA_FILE_SUFFIX" => "inc",
			"EDIT_TEMPLATE" => "",
			"PATH" => "/inc/price_links.php"
		)
	);?>