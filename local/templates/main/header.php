<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<? use Bitrix\Main\Page\Asset; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?$APPLICATION->ShowHead();?>
	<title><?$APPLICATION->ShowTitle();?></title>
    <?php
        /* Added favicons */
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">');
        Asset::getInstance()->addString('<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">');
        Asset::getInstance()->addString('<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">');
        Asset::getInstance()->addString('<link rel="manifest" href="/favicon/manifest.json">');
        Asset::getInstance()->addString('<meta name="msapplication-TileColor" content="#ffffff">');
        Asset::getInstance()->addString('<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">');
        Asset::getInstance()->addString('<meta name="theme-color" content="#ffffff">');

        Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
        Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="ie=edge">');
        Asset::getInstance()->addString('<meta name="robots" content="index, follow">');

        /* Added Fancybox apps */
        Asset::getInstance()->addCss('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
        Asset::getInstance()->addJs('https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js');

        /* Added Slick slider apps */
        Asset::getInstance()->addJs('//code.jquery.com/jquery-migrate-1.2.1.min.js');
        Asset::getInstance()->addJs('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
        Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

        /* Added base site includes */
        Asset::getInstance()->addString('<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Source+Sans+Pro:wght@400;600;700;900&display=swap" rel="stylesheet">');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/vendors.css');
        Asset::getInstance()->addCss(DEFAULT_TEMPLATE_PATH . '/css/main.css');
        Asset::getInstance()->addJs(DEFAULT_TEMPLATE_PATH . '/js/main.js');

        /* Добавляем Яндекс картуы только на те страницы где она используется*/
        if ($APPLICATION->GetCurPage(false) == '/'
            or $APPLICATION->GetCurPage(false) == '/proizvodstvo/tovarnyy-beton/'
            or $APPLICATION->GetCurPage(false) == '/proizvodstvo/shcheben/'
            or $APPLICATION->GetCurPage(false) == '/produktsiya/'
            or $APPLICATION->GetCurPage(false) == '/kontakty/'
            or $APPLICATION->GetCurPage(false) == '/dostavka/')
                Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=bcf0711f-5031-4e9a-a643-2984d4000f2b&amp;lang=ru_RU');

        if (preg_match('/\/produktsiya\/beton\/tovarnyy-beton\/\w/', $APPLICATION->GetCurPage())
            or preg_match('/\/produktsiya\/beton\/betonnaya-smes\/\w/', $APPLICATION->GetCurPage())
            or preg_match('/\/produktsiya\/beton\/rastvory-tsementno-peschanye\/\w/', $APPLICATION->GetCurPage())) {
            Asset::getInstance()->addJs('https://api-maps.yandex.ru/2.1/?apikey=bcf0711f-5031-4e9a-a643-2984d4000f2b&amp;lang=ru_RU');
        }
    ?>
</head>
<body class="<?
    if(preg_match('/\/produktsiya\/shcheben\/\w/', $APPLICATION->GetCurPage())) echo 'page-product-rubble';
    if(preg_match('/\/produktsiya\/beton\/tovarnyy-beton\/\w/', $APPLICATION->GetCurPage())) echo 'page-product';
    if(preg_match('/\/produktsiya\/beton\/betonnaya-smes\/\w/', $APPLICATION->GetCurPage())) echo 'page-product';
    if(preg_match('/\/produktsiya\/beton\/rastvory-tsementno-peschanye\/\w/', $APPLICATION->GetCurPage())) echo 'page-product';
    if(preg_match('/\/arenda\/\w/', $APPLICATION->GetCurPage())) echo 'pump-rental';

    if($APPLICATION->GetCurPage() == '/produktsiya/beton/rastvory-tsementno-peschanye/') echo 'page-catalog';
    if($APPLICATION->GetCurPage() == '/produktsiya/izvestnyakovaya-muka/') echo 'page-limestone-flour';
    if($APPLICATION->GetCurPage() == '/produktsiya/mineralnyy-poroshok/') echo 'page-mineral-powder';
    if($APPLICATION->GetCurPage() == '/o-kompanii/biografiya-rukovoditelya/') echo 'page-director';
    if($APPLICATION->GetCurPage() == '/produktsiya/beton/tovarnyy-beton/') echo 'page-catalog';
    if($APPLICATION->GetCurPage() == '/produktsiya/beton/betonnaya-smes/') echo 'page-catalog';
    if($APPLICATION->GetCurPage() == '/proizvodstvo/tovarnyy-beton/') echo 'page-concrete';
    if($APPLICATION->GetCurPage() == '/proizvodstvo/laboratoriya/') echo 'page-laboratory';
    if($APPLICATION->GetCurPage() == '/produktsiya/shcheben/') echo 'page-catalog-rubble';
    if($APPLICATION->GetCurPage() == '/proizvodstvo/shcheben/') echo 'page-breakstone';
    if($APPLICATION->GetCurPage() == '/proizvodstvo/dileram/') echo 'page-dealers';
    if($APPLICATION->GetCurPage() == '/o-kompanii/vakansii/') echo 'page-vacancy';
    if($APPLICATION->GetCurPage() == '/produktsiya/beton/') echo 'page-catalog';
    if($APPLICATION->GetCurPage() == '/produktsiya/') echo 'page-products';
    if($APPLICATION->GetCurPage() == '/arenda/') echo 'page-rent-list';
    if($APPLICATION->GetCurPage() == '/dostavka/') echo 'page-delivery';
    if($APPLICATION->GetCurPage() == '/tendery/') echo 'page-tenders';
    if($APPLICATION->GetCurPage() == '/') echo 'page-index';
?>">
	<div id="panel"><?$APPLICATION->ShowPanel();?></div>

    <div class="spinner" id="spinner">
        <div class="ldio">
            <div></div><div></div><div></div>
        </div>
    </div>
    <?/* Форма сообщения с сайта */
    $APPLICATION->IncludeComponent(
        "bitrix:main.include",
        "",
        Array(
            "AREA_FILE_SHOW" => "file",
            "AREA_FILE_SUFFIX" => "inc",
            "EDIT_TEMPLATE" => "",
            "PATH" => "/include/form-feedback.php"
        )
    );?>
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="header__top__wrap row d-flex justify-content-between align-items-center" id="headerTop">
                    <div class="header__top__body d-flex align-items-center justify-content-between">
                        <div class="nav-tglr" id="navTgglr">
                            <div class="nav-tglr__burger"></div>
                        </div>
                        <div class="region d-flex flex-md-column align-items-center justify-content-center" id="region">
                            <div class="region__map-marker d-md-none">
                                <img src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/map-marker-alt-solid.svg"
                                     alt="" title="">
                            </div>
                            <div class="region__caption d-none d-md-block">Ваш регион:</div>
                            <div class="region__description" id="regionCity"></div>

                            <? // Список городов в хедере сайта ?>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:news.list",
                                "cities",
                                array(
                                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "AJAX_MODE" => "N",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => "Y",
                                    "CACHE_TIME" => "36000000",
                                    "CACHE_TYPE" => "A",
                                    "CHECK_DATES" => "Y",
                                    "DETAIL_URL" => "",
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_DATE" => "N",
                                    "DISPLAY_NAME" => "Y",
                                    "DISPLAY_PICTURE" => "N",
                                    "DISPLAY_PREVIEW_TEXT" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "FIELD_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "FILTER_NAME" => "",
                                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                    "IBLOCK_ID" => "1",
                                    "IBLOCK_TYPE" => "content",
                                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                    "INCLUDE_SUBSECTIONS" => "N",
                                    "MESSAGE_404" => "",
                                    "NEWS_COUNT" => "20",
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGER_TITLE" => "Новости",
                                    "PARENT_SECTION" => "",
                                    "PARENT_SECTION_CODE" => "",
                                    "PREVIEW_TRUNCATE_LEN" => "",
                                    "PROPERTY_CODE" => array(
                                        0 => "",
                                        1 => "",
                                    ),
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SORT_BY1" => "ACTIVE_FROM",
                                    "SORT_BY2" => "SORT",
                                    "SORT_ORDER1" => "DESC",
                                    "SORT_ORDER2" => "ASC",
                                    "STRICT_SECTION_CHECK" => "N",
                                    "COMPONENT_TEMPLATE" => "cities"
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
                                <li class="drop products__item">
                                    <a class="products__link drop" href="/produktsiya/beton">Бетон</a>
                                    <div class="products__dropdown concrete d-flex justify-content-center align-items-center">
                                        <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.section.list", 
	"nav-beton", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
		"FILTER_NAME" => "sectionsFilter",
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "products",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "/produktsiya/beton/#SECTION_CODE#",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "2",
		"VIEW_MODE" => "TEXT",
		"COMPONENT_TEMPLATE" => "nav-beton"
	),
	false
);?>
                                    </div>
                                </li>
                                <li class="drop products__item"><a class="products__link drop" href="/produktsiya/shcheben">Щебень</a>
                                    <div class="products__dropdown rubble d-flex justify-content-center align-items-center">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:news.list",
                                            "nav-shcheben",
                                            array(
                                                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                                "ADD_SECTIONS_CHAIN" => "N",
                                                "AJAX_MODE" => "N",
                                                "AJAX_OPTION_ADDITIONAL" => "",
                                                "AJAX_OPTION_HISTORY" => "N",
                                                "AJAX_OPTION_JUMP" => "N",
                                                "AJAX_OPTION_STYLE" => "Y",
                                                "CACHE_FILTER" => "N",
                                                "CACHE_GROUPS" => "Y",
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_TYPE" => "A",
                                                "CHECK_DATES" => "Y",
                                                "DETAIL_URL" => "/produktsiya/shcheben/#ELEMENT_CODE#",
                                                "DISPLAY_BOTTOM_PAGER" => "N",
                                                "DISPLAY_DATE" => "N",
                                                "DISPLAY_NAME" => "Y",
                                                "DISPLAY_PICTURE" => "N",
                                                "DISPLAY_PREVIEW_TEXT" => "N",
                                                "DISPLAY_TOP_PAGER" => "N",
                                                "FIELD_CODE" => array(
                                                    0 => "",
                                                    1 => "",
                                                ),
                                                "FILTER_NAME" => "",
                                                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                                "IBLOCK_ID" => "8",
                                                "IBLOCK_TYPE" => "products",
                                                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                                "INCLUDE_SUBSECTIONS" => "Y",
                                                "MESSAGE_404" => "",
                                                "NEWS_COUNT" => "20",
                                                "PAGER_BASE_LINK_ENABLE" => "N",
                                                "PAGER_DESC_NUMBERING" => "N",
                                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                                "PAGER_SHOW_ALL" => "N",
                                                "PAGER_SHOW_ALWAYS" => "N",
                                                "PAGER_TEMPLATE" => ".default",
                                                "PAGER_TITLE" => "Новости",
                                                "PARENT_SECTION" => "",
                                                "PARENT_SECTION_CODE" => "",
                                                "PREVIEW_TRUNCATE_LEN" => "",
                                                "PROPERTY_CODE" => array(
                                                    0 => "",
                                                    1 => "",
                                                ),
                                                "SET_BROWSER_TITLE" => "N",
                                                "SET_LAST_MODIFIED" => "N",
                                                "SET_META_DESCRIPTION" => "N",
                                                "SET_META_KEYWORDS" => "N",
                                                "SET_STATUS_404" => "N",
                                                "SET_TITLE" => "N",
                                                "SHOW_404" => "N",
                                                "SORT_BY1" => "ACTIVE_FROM",
                                                "SORT_BY2" => "SORT",
                                                "SORT_ORDER1" => "DESC",
                                                "SORT_ORDER2" => "ASC",
                                                "STRICT_SECTION_CHECK" => "N",
                                                "COMPONENT_TEMPLATE" => "nav-shcheben"
                                            ),
                                            false
                                        );?>
                                    </div>
                                </li>
                                <li class="products__item">
                                    <a class="products__link" href="/produktsiya/mineralnyy-poroshok">Минеральный порошок</a>
                                </li>
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