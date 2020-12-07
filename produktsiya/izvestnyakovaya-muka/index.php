<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Известняковая мука");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "breadcrumbs",
    Array(
        "3" => "",
        "4" => false,
        "PATH" => "",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    )
);?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content">
            <?$APPLICATION->ShowTitle(false)?> </h1>
    </div>
</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.detail", 
	"limestone-flour", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"BROWSER_TITLE" => "-",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_CODE" => "izvestnyakovaya-muka",
		"ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
		"FIELD_CODE" => array(
			0 => "DETAIL_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "",
		),
		"IBLOCK_ID" => "20",
		"IBLOCK_TYPE" => "products",
		"IBLOCK_URL" => "",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Страница",
		"PROPERTY_CODE" => array(
			0 => "LIMESTONE_FLOUR_DESCRIPTION",
			1 => "PRICE",
			2 => "PRICE_MINIMUM",
			3 => "PRICE_FACTORY_ID_387",
			4 => "PRICE_FACTORY_ID_386",
			5 => "PRICE_FACTORY_ID_385",
			6 => "PRICE_FACTORY_ID_384",
			7 => "PRICE_FACTORY_ID_383",
			8 => "PRICE_FACTORY_ID_382",
			9 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_CANONICAL_URL" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"USE_PERMISSIONS" => "N",
		"USE_SHARE" => "N",
		"COMPONENT_TEMPLATE" => "limestone-flour"
	),
	false
);?>

<?/* Вставка включаемой области Баннер "Собственная лаборатория"
   * Внтури родительского контейнера включаемой области /include/own-lab.php
   * две дочерние включаемые области /include/own-lab-title.php и /include/own-lab-txt.php
   * соответственно с заголовком блока и текстом блока
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/own-lab.php"
    )
);?>

<div class="buy-from-us section_container">
    <div class="container">
        <div class="buy-from-us__title section_title">ПОЧЕМУ СТОИТ ПОКУПАТЬ У НАС?</div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-5 d-flex justify-content-center justify-content-xl-start">
                <ul class="buy-from-us__list d-flex flex-column align-items-start">
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-1.png" alt="">Оперативное заключение договоров
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-2.png" alt="">Гарантированная поставка заявленных объемов
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-3.png" alt="">Гарантированная поставка заявленных объемов
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-4.png" alt="">Выполнение всех пожеланий заказчиков
                    </li>
                </ul>
            </div>
            <div class="col-xl-2 buy-from-us__pic d-flex">
                <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/buy-from-us.jpg" alt="" title="">
            </div>
            <div class="col-xl-5 d-flex justify-content-center justify-content-xl-start">
                <ul class="buy-from-us__list second d-flex flex-column align-items-start">
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-5.png" alt="">Конкурентные цены
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-6.png" alt="">Быстрая доставка автомобильным транспортом
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-7.png" alt="">Особые условия для постоянных клиентов
                    </li>
                    <li class="buy-from-us__item d-flex justify-content-start align-items-center"><img
                                src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-8.png" alt="">Решение любых вопросов
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container section_container">
    <div class="row">
        <div class="col-12">
            <blockquote class="blockquote">
                <?/* Вставка включаемой области Текст цитаты на странице "Минеральный порошок"
               * include/mineral-powder-blockquote.php
               */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/mineral-powder-blockquote.php"
                    )
                );?>
            </blockquote>
        </div>
    </div>
</div>

<?/* Включаемый компонент со списком преимуществ:
   * Инфоблоки->Типы инфоблоков->Контент->Преимушества
   */
$APPLICATION->IncludeComponent("bitrix:news.list", "advantages-tenders", Array(
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
    "DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
    "DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
    "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
    "FIELD_CODE" => array(	// Поля
        0 => "",
        1 => "",
    ),
    "FILTER_NAME" => "",	// Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
    "IBLOCK_ID" => "3",	// Код информационного блока
    "IBLOCK_TYPE" => "content",	// Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
    "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT" => "100",	// Количество новостей на странице
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
        0 => "ADVANTAGE_GROUP",
        1 => "",
    ),
    "SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
    "SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
    "SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
    "SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
    "SET_STATUS_404" => "N",	// Устанавливать статус 404
    "SET_TITLE" => "N",	// Устанавливать заголовок страницы
    "SHOW_404" => "N",	// Показ специальной страницы
    "SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
    "SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
    "SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
    "SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
    "STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
    "COMPONENT_TEMPLATE" => "advantages"
),
    false
);?>

<?/* Вклчаемая область Промо "Сеть бетонных заводов ..."
   * Внтури родительского контейнера включаемой области /include/promo.php
   * две дочерние включаемые области /include/promo-title.php и /include/promo-list.php
   * соответственно с заголовком блока и списком преимуществ
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/promo.php"
    )
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>