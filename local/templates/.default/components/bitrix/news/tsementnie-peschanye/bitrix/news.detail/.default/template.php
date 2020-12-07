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
$this->setFrameMode(true);
?>
<?/* Вставка включаемой области Модальные окна на страницах с товарами
   * В калькулятор расчёта стомимости товара (цена товара + доставка)
   * передаются переменные содержащие цены товара на всех заводах
   * и стомость доставки на каждом из заводов.
   */
$arPRODUCT_PRICES = Array(
    "350" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_350']['VALUE'],
    "351" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_351']['VALUE'],
    "352" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_352']['VALUE'],
    "353" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_353']['VALUE'],
    "354" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_354']['VALUE'],
    "355" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_355']['VALUE'],
);
$JSON__PRODUCT_PRICES = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arPRODUCT_PRICES, JSON_UNESCAPED_UNICODE)
    : json_encode($arPRODUCT_PRICES);

// Получаем стоимость доставки данного товара на каждом из предприятий, где 24 - это ИД инфоблока прайса
$iterator = CIBlockElement::GetPropertyValues(24, array(), true, array());
while ($row = $iterator->Fetch()) {
    $res = CIBlockElement::GetByID($row['IBLOCK_ELEMENT_ID']);
    $arDELIVERY_PRICES[$row['IBLOCK_ELEMENT_ID']] = Array(
        'name' => $res->GetNext()['NAME'],
        'address' => $row['89'],
        'coordinates' => $row['90'],
        'prices' => [
            '5' => $row['91'],
            '10' => $row['92'],
            '15' => $row['93'],
            '20' => $row['94'],
            '25' => $row['95'],
            '30' => $row['96'],
            '35' => $row['97'],
            '40' => $row['98'],
            '45' => $row['104'],
            '50' => $row['105'],
        ]
    );
}
$JSON__DELIVERY_PRICES = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arDELIVERY_PRICES, JSON_UNESCAPED_UNICODE)
    : json_encode($arDELIVERY_PRICES);

$PRODUCT_DESCRIPTION = 'Характеристики: '
    .'Класс бетона - '.$arResult['PROPERTIES']['CONCRETE_CLASS']['VALUE'].'; '
    .'Подвижность - '.$arResult['PROPERTIES']['CONCRETE_MOBILITY']['VALUE'].'; '
    .'Морозостойкость,F - '.$arResult['PROPERTIES']['CONCRETE_FROST']['VALUE'].'; '
    .'Водонепроницаемость - '.$arResult['PROPERTIES']['CONCRETE_WATER']['VALUE'].'.'
    .'Наполнитель - '.$arResult['PROPERTIES']['CONCRETE_FILLER']['VALUE'].'.'
    .'Средняя прочность, кгс/см2 - '.$arResult['PROPERTIES']['CONCRETE_STRENGTH']['VALUE'].'.';

$PRODUCT_NAME = $arResult['PREVIEW_TEXT']
    ." ".$arResult['PROPERTIES']['CONCRETE_GRADE']['VALUE']
    ." ".$arResult['PROPERTIES']['CONCRETE_CLASS']['VALUE']
    ." ".$arResult['PROPERTIES']['CONCRETE_MOBILITY']['VALUE']
    ." ".$arResult['PROPERTIES']['CONCRETE_FROST']['VALUE']
    ." ".$arResult['PROPERTIES']['CONCRETE_WATER']['VALUE'];

//debug(['$arPRODUCT_PRICES', $arPRODUCT_PRICES]);
//debug(['$arDELIVERY_PRICES', $arDELIVERY_PRICES]);
//debug(['$PRODUCT_DESCRIPTION', $PRODUCT_DESCRIPTION]);
//debug(['$PRODUCT_NAME', $PRODUCT_NAME]);

$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",	// Показывать включаемую область
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",	// Шаблон области по умолчанию
        "PATH" => "/include/product-calc.php",	// Путь к файлу области
        "PRODUCT_PRICES" => $JSON__PRODUCT_PRICES, // JSON с ценами товара на всех заводах
        "DELIVERY_PRICES" => $JSON__DELIVERY_PRICES, // JSON с ценами доставки товара на всех заводах
        "PRODUCT_TYPE" => 'concrete', // Тип товара для сохранения в соответствующем разделе корзины
        "PRODUCT_DESCRIPTION" => $PRODUCT_DESCRIPTION, // Описание товара. Для Известковой муки описание НЕТ
        "PRODUCT_NAME" => $PRODUCT_NAME, // Наименование товара
    ),
    false
);?>
<?/* Вставка включаемой области Модальные окна на странице с видежетом доставка
   * include/delivery-txt.php
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/delivery-calc-modals.php"
    )
);?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content">
            <?=$arResult['PREVIEW_TEXT']
            ." ".$arResult['PROPERTIES']['CONCRETE_GRADE']['VALUE']
            ." ".$arResult['PROPERTIES']['CONCRETE_CLASS']['VALUE']
            ." ".$arResult['PROPERTIES']['CONCRETE_MOBILITY']['VALUE']
            ." ".$arResult['PROPERTIES']['CONCRETE_FROST']['VALUE']
            ." ".$arResult['PROPERTIES']['CONCRETE_WATER']['VALUE'];
            ?>
        </h1>
    </div>
</div>
<div class="product">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications"><h5 class="specifications__title">Характеристики:</h5>
                    <ul class="specifications__list">
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Класс бетона</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_CLASS"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Подвижность</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Морозостойкость, F</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_FROST"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Водонепроницаемость</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_WATER"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Наполнитель</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_FILLER"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Средняя прочность, кгс/см<sup>2</sup></span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["CONCRETE_STRENGTH"]["VALUE"]?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 description__wrap">
                <div class="description">
                    <div class="description__content">
                        <?=$arResult["~DETAIL_TEXT"]?>
                    </div>
                    <div class="description__toggler">Развернуть</div>
                </div>
            </div>
            <div class="col-xl-6 actions__wrap">
                <div class="actions">
                    <div class="actions__price">
                        Стоимость:
                        <span><?
                            $PRICE_COUNT = 0;
                            $PRICE = false;

                            for ($i = 350; $i < 356; $i++) {
                                $CURRENT_PRICE = (float) str_replace(',','.',$arResult['PROPERTIES']['PRICE_FACTORY_ID_'.$i]['VALUE']);

                                if ($CURRENT_PRICE != 0) {
                                    $PRICE = !$PRICE
                                        ? $CURRENT_PRICE
                                        : $CURRENT_PRICE < $PRICE
                                            ? $CURRENT_PRICE
                                            : $PRICE;
                                    $PRICE_COUNT++;
                                }
                            }

                            if ($PRICE_COUNT > 0) echo 'от ';
                            echo $PRICE . ' руб./м<sup>3</sup>';?></span>
                    </div>
                    <div class="actions__btns d-flex flex-column align-items-center flex-xl-row align-items-xl-start">
                        <div class="actions__txt">
                            <button class="btn" id="showModalProductCalc">
                                рассчитать полную стоимость
                            </button>
                            <div class="actions__comment">
                                Ваш заказ будет доставлен прямо на вашу строительную площадку в любое удобное время.
                            </div>
                        </div>
                        <div class="btn-call">
                            <?/* Вставка включаемой области Зделать звонок.
                           * Разсположена на всехкарточках товара.
                           * Лежит по пути /include/btn-call.php
                           */
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/btn-call.php"
                                )
                            );?>
                        </div>
                    </div>
                    <div class="actions__offer d-flex flex-column align-items-center flex-xl-row justify-content-between">
                        <span><b>Нужно свыше 300 тонн?</b> Тогда нажимай!</span>
                        <button class="btn show-modal" data-modal-id="modalSetOrder">
                            Персональное предложение
                        </button>
                    </div>
                </div>
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