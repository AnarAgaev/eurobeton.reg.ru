<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
    <?php
        Asset::getInstance()->addString('<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />');
        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="ie=edge">');
        Asset::getInstance()->addString('<meta name="robots" content="index, follow">');

        /* Added Fancybox apps */
        Asset::getInstance()->addCss('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js');

        /* Added base site includes */
        Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/vendors.css');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/main.css');
        Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/main.js');

        /* Добавляем Яндекс карту используемую на главной странице */
        if($APPLICATION->GetCurPage() == '/')
            Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=bcf0711f-5031-4e9a-a643-2984d4000f2b&amp;lang=ru_RU');
    ?>
</head>
<body>
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	<div class="modal" id="modalSetOrder">
		<div class="modal__dialog modal__dialog_set-order">
			<div class="modal__close"></div>
			<div class="modal__content">
				<div class="modal__header"><h4 class="modal__title">Оставить заявку</h4></div>
				<div class="modal__body"><h5 class="modal__subtitle">Вам нужна помощь в расчёте стоимости бетона? Или у Вас
						есть другой вопрос?<br>Наш менеджер поможет Вам во всём разобраться</h5>
					<form class="form modal__form d-flex flex-column flex-md-row" enctype="multipart/form-data"
						  method="post">
						<div class="modal__controls d-flex flex-column"><label class="label label_w272"><span>Ваше имя (название организации):</span><input
									type="text" placeholder="Иван"></label><label
								class="label label_w272"><span>Ваш e-mail:</span><input type="text"
																						placeholder="example@example.com"></label><label
								class="label label_w272"><span>Телефон:</span><input type="text"
																					 placeholder="+7 (999) 999-99-99"></label>
						</div>
						<div class="modal__msg"><label class="label"><span>Ваш вопрос (данные для расчета)?:</span><textarea
									placeholder="Начните вводить ..."></textarea></label></div>
					</form>
				</div>
				<div class="modal__footer d-flex flex-column flex-md-row align-items-center justify-content-center">
					<button class="btn">отправить</button>
					<div class="modal__agreement">Нажимая кнопку, вы соглашаетесь с условиями
						<a class="link" href="/">пользовательского соглашения</a>
						по обработке персональных данных
					</div>
				</div>
			</div>
		</div>
	</div>
		<header class="header">
			<div class="header__top">
				<div class="container">
					<div class="header__top__wrap row d-flex justify-content-between align-items-center" id="headerTop">
						<div class="header__top__body d-flex align-items-center justify-content-between">
							<div class="nav-tglr" id="navTgglr">
								<div class="nav-tglr__burger"></div>
							</div>
							<div class="region d-flex flex-md-column align-items-center justify-content-center" id="region">
								<div class="region__map-marker d-md-none"><img src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/map-marker-alt-solid.svg" alt=""
																			   title=""></div>
								<div class="region__caption d-none d-md-block">Ваш регион:</div>
								<div class="region__description" id="regionCity"></div>

                                <? // Список городов в хедере сайта ?>
                                <?$APPLICATION->IncludeComponent("bitrix:news.list", "cities", Array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
                                        "ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
                                        "AJAX_MODE" => "N",	// Включить режим AJAX
                                        "AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
                                        "AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
                                        "AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
                                        "AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
                                        "CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
                                        "CACHE_GROUPS" => "Y",	// Учитывать права доступа
                                        "CACHE_TIME" => "36000000",	// Время кеширования (сек.)
                                        "CACHE_TYPE" => "A",	// Тип кеширования
                                        "CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
                                        "DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
                                        "DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
                                        "DISPLAY_DATE" => "N",	// Выводить дату элемента
                                        "DISPLAY_NAME" => "Y",	// Выводить название элемента
                                        "DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
                                        "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
                                        "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
                                        "FIELD_CODE" => array(	// Поля
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_NAME" => "",	// Фильтр
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
                                        "IBLOCK_ID" => "1",	// Код информационного блока
                                        "IBLOCK_TYPE" => "Structure",	// Тип информационного блока (используется только для проверки)
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
                                        "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
                                        "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
                                        "NEWS_COUNT" => "20",	// Количество новостей на странице
                                        "PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
                                        "PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
                                        "PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
                                        "PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
                                        "PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
                                        "PAGER_TITLE" => "Новости",	// Название категорий
                                        "PARENT_SECTION" => "",	// ID раздела
                                        "PARENT_SECTION_CODE" => "",	// Код раздела
                                        "PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
                                        "PROPERTY_CODE" => array(	// Свойства
                                            0 => "",
                                            1 => "",
                                        ),
                                        "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
                                        "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
                                        "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
                                        "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
                                        "SET_STATUS_404" => "N",	// Устанавливать статус 404
                                        "SET_TITLE" => "N",	// Устанавливать заголовок страницы
                                        "SHOW_404" => "N",	// Показ специальной страницы
                                        "SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
                                        "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
                                        "SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
                                        "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
                                        "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
                                    ),
                                    false
                                );?>
							</div>

                            <? // Главное меню в хедере сайта ?>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "main_menu", Array(
                                "ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
                                    "CHILD_MENU_TYPE" => "subtop",	// Тип меню для остальных уровней
                                    "DELAY" => "N",	// Откладывать выполнение шаблона меню
                                    "MAX_LEVEL" => "2",	// Уровень вложенности меню
                                    "MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
                                    "MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
                                    "MENU_CACHE_TYPE" => "N",	// Тип кеширования
                                    "MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
                                    "ROOT_MENU_TYPE" => "top",	// Тип меню для первого уровня
                                    "USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
                                    "COMPONENT_TEMPLATE" => "main_menu"
                                ),
                                false
                            );?>

							<div class="handset" id="headerPhoneBtn"><img src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/phone-alt-solid.svg" alt="" title=""></div>
							<div class="cart d-flex justify-content-end align-items-center" id="cart">
								<div class="cart__caption">Корзина</div>
								<div class="cart__items">
									<div class="cart__items__num" id="cartProds"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header__bottom" id="headerBottomContainer">
				<div class="container header__bottom__container">
					<div class="headerBottom header__bottom__wrap d-flex justify-content-between align-items-center"
						 id="headerBottom">
                        <a class="logo" href="/" id="logo">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/header-logo.php"
                                )
                            );?>
                        </a>
						<div id="prodContainer">
							<div class="products d-flex flex-column" id="nav">
								<ul class="products__list d-flex">
									<li class="drop products__item"><a class="products__link drop" href="/">Бетон</a>
										<div class="products__dropdown concrete d-flex justify-content-center align-items-center">
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М100
														(В7,5)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М150
														(В10)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М200
														(В15)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М250
														(В20)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М300
														(В22,5)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М350
														(В25)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М400
														(В30)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М450
														(В35)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М550
														(В40)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М600
														(В45)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М700
														(В50)</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">БЕТОН М800
														(В60)</a></li>
											</ul>
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">РАСТВОР БЕТОНА</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ТОВАРНЫЙ БЕТОН</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ТЯЖЕЛЫЙ БЕТОН</a>
												</li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">ДЛЯ ФУНДАМЕНТА</a>
												</li>
											</ul>
										</div>
									</li>
									<li class="drop products__item"><a class="products__link drop" href="/">Щебень</a>
										<div class="products__dropdown rubble d-flex justify-content-center align-items-center">
											<ul class="dropdown-list d-flex flex-column">
												<li class="dropdown__item"><a class="dropdown__link" href="/">Гранитный
														щебень</a></li>
												<li class="dropdown__item"><a class="dropdown__link" href="/">Доломитовый
														щебень</a></li>
											</ul>
										</div>
									</li>
									<li class="products__item"><a class="products__link" href="/">Минеральный порошок</a></li>
								</ul>
							</div>
						</div>
						<div class="operating d-flex flex-column align-items-center align-items-md-end justify-content-center"
							 id="operating">
							<div class="operating__worktime">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/include/working-hours.php"
                                    )
                                );?>
                            </div>
                            <div class="operating__phone">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_RECURSIVE" => "Y",
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "EDIT_TEMPLATE" => "",
                                        "PATH" => "/include/header-phone.php"
                                    )
                                );?>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main class="main">