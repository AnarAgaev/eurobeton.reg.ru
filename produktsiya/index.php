<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Продукция");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "breadcrumbs",
    Array(
        "3" => "",
        "4" => fals,
        "PATH" => "",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    )
);?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content">Выберите каталог</h1>
    </div>
</div>
<div class="container">
    <div class="row products-list d-flex flex-wrap">
        <div class="col-12 col-xl-6">
            <a href="/produktsiya/beton/" class="products-list__item d-flex flex-column flex-sm-row">
                <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/products-list-pic1.png" alt="">
                </div>
                <div class="products-list__item-body">
                    <div class="products-list__item-title">Бетон</div>
                    <div class="products-list__item-caption">
                        <span>Товарный бетон</span>
                        <span>Пескобетон</span>
                        <span>Растворы цементно - Песчаные</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-xl-6">
            <a href="/produktsiya/shcheben/" class="products-list__item d-flex flex-column flex-sm-row">
                <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/products-list-pic2.png" alt="">
                </div>
                <div class="products-list__item-body">
                    <div class="products-list__item-title">Щебень</div>
                    <div class="products-list__item-caption">
                        <span>Гранитный 5-20, 20-40, 25-60, 40-70</span>
                        <span>Доломитовый</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-12 col-xl-6">
            <a href="/produktsiya/mineralnyy-poroshok/" class="products-list__item d-flex flex-column flex-sm-row">
                <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/products-list-pic3.png" alt="">
                </div>
                <div class="products-list__item-body">
                    <div class="products-list__item-title">Минеральный порошок</div>
                    <div class="products-list__item-caption">
                        <span>Известняковая мука</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?/* Вставка включаемой области Калькулятор доставки
       * include/delivery-calc.php
       */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/delivery-calc.php"
    )
);
?>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 company">
                <?/* Вставка включаемой области Промо текст под калькулятором доставки
                   * include/product-promotxt.php
                   */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/product-promotxt.php"
                    )
                );
                ?>
            </div>
            <div class="col-xl-4 banner">
                <div class="banner__img d-flex">
                    <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/banner-cars.png" alt="" title="">
                </div>
                <div class="banner__txt">Для обеспечения качественной доставки движение каждой единицы
                    автотранспорта отслеживается в он-лайн режиме сотрудниками отдела логистики.
                </div>
            </div>
        </div>
    </div>
    </div>

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

<?/* Выводим слайдер с популярными товарами ТОЛЬКО ИНФОБЛОКА БЕТОН (из всех подразделов кталога):
   * Инфоблоки->Типы инфоблоков->Каталог->Бетон
   * Слайдер выводится во включаемой области /include/product-slider.php
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/product-slider.php"
    )
);?>

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
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>