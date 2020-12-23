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
<div class="modal" id="modalRentPump">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="sendRPMsgTrue">
        <h3 class="send-msg-true__title">Сообщение отправлено</h3>
        <span class="send-msg-true__txt">Менеджер свяжется с Вами в ближайшее время.</span>
        <button class="btn" id="btnRPClose">Закрыть</button>
    </div>
    <div class="modal__dialog modal__dialog_set-order" id="modalDialogRentPump">
        <div class="modal__close"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h4 class="modal__title">Оставить заявку</h4>
            </div>
            <div class="modal__body pump-rent">
                <form class="form modal__form d-flex flex-column flex-md-row"
                      name="form-rent-pump"
                      action="/utils/handle-rent-pump-form.php"
                      method="POST"
                      enctype="multipart/form-data"
                      id="formRentPump">
                    <input type="hidden" name="num-length" value="" id="numLength">
                    <input type="hidden" name="price-result" value="" id="priceResult">
                    <input type="hidden" name="number-shifts" value="" id="numberShifts">
                    <input type="hidden" name="extra-hours" value="" id="extraHours">
                    <div class="modal__controls d-flex flex-column">
                        <label class="label label_w272">
                            <span>Ваше имя (название организации):</span>
                            <input class="input"
                                   type="text"
                                   name="name"
                                   placeholder="Иван"
                                   id="formRentPumpName">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Ваш e-mail:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="example@example.com"
                                   name="email"
                                   id="formRentPumpMail">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Телефон:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="+7 (999) 999-99-99"
                                   name="phone"
                                   id="formRentPumpPhone">
                            <span class="err__msg"></span>
                        </label>
                    </div>
                    <div class="modal__msg">
                        <label class="label label_w251 label_select">
                            <span>Длина подачи (м):</span>
                            <select class="select"
                                    id="formRentPumpLength"
                                    name="price-hour"></select>
                        </label>
                        <label class="label label_w251">
                            <span>Рабочая смена (час.):</span>
                            <input class="input"
                                   type="number"
                                   name="time"
                                   placeholder="8"
                                   id="formRentPumpTime">
                            <span class="err__msg"></span>
                        </label>
                        <div class="rent-pump-culc__result d-flex align-items-end">
                            Итого:<span id="formRentPumpResult">0</span>руб.
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal__footer d-flex flex-column flex-md-row align-items-center justify-content-center">
                <button class="btn" type="submit" form="formRentPump">отправить</button>
                <div class="modal__agreement">
                    Нажимая кнопку, вы соглашаетесь с условиями
                    <a class="link"
                       download="Пользовательское_соглашение_Евробетон.doc"
                       title="Пользовательское соглашение"
                       href="/download/terms_of_use.doc">
                        пользовательского соглашения
                    </a>
                    по обработке персональных данных
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal pump-rent" id="modalShowRentPumpNote">
    <div class="modal__dialog modal__dialog_set-order" id="modalDialogShowRentPumpNote">
        <div class="modal__content">
            <div class="modal__header">
                <h4 class="modal__title">Примечание</h4>
            </div>
            <div class="modal__body">
                <?=$arResult['PROPERTIES']['NOTE']['~VALUE']['TEXT']?>
            </div>
            <div class="modal__footer d-flex align-items-center justify-content-center">
                <button class="btn modal__close">Закрыть</button>
            </div>
        </div>
    </div>
</div>
<div class="page-title">
    <div class="container"><h1 class="page-title__content">Аренда бетононасоса</h1></div>
</div>
<div class="pump-rental">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC']?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications__mark">Аренда техники только для Москвы и Московской области!</div>
                <div class="specifications"><h5 class="specifications__title">Характеристики:</h5>
                    <ul class="specifications__list">
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Длина подачи</span>
                            <span class="specifications__value"><?=$arResult['PROPERTIES']['LENGTH']['VALUE']?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Производительность</span>
                            <span class="specifications__value"><?=$arResult['PROPERTIES']['PERFORMANCE']['VALUE']?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Размеры площадки</span>
                            <span class="specifications__value"><?=$arResult['PROPERTIES']['SIZE']['VALUE']?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Макс. дальность подачи</span>
                            <span class="specifications__value"><?=$arResult['PROPERTIES']['LENGTH_MAX']['VALUE']?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Время рабочей смены</span>
                            <span class="specifications__value"><?=$arResult['PROPERTIES']['TIME']['VALUE']?></span>
                        </li>
                    </ul>
                </div>
                <div class="note d-flex justify-content-end">
                    <a class="link show-modal" data-modal-id="modalShowRentPumpNote">Примечание</a>
                </div>
            </div>
            <div class="col-xl-6 description__wrap">
                <div class="description">
                    <div class="description__content">
                        <?=$arResult['DETAIL_TEXT']?>
                    </div>
                    <div class="description__toggler">Развернуть</div>
                </div>
            </div>
            <div class="col-xl-6 actions__wrap">
                <div class="actions">
                    <div class="actions__price_wrap d-flex justify-content-center justify-content-xl-between align-items-center align-items-md-end flex-wrap flex-column flex-sm-row">
                        <div class="actions__price">Стоимость:
                            <span class="cost"><?if($arResult["PROPERTIES"]["PRICE_MINIMUM"]["VALUE_XML_ID"]) echo 'от';?> <?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> руб</span>
                        </div>
                        <div class="comment">
                            за 1 раб. смену в т.ч. НДС 20%
                        </div>
                    </div>
                    <div class="actions__btns d-flex flex-column align-items-center flex-xl-row align-items-xl-start">
                        <div class="actions__txt d-xl-flex flex-xl-wrap justify-content-xl-start">
                            <button class="btn show-modal" data-modal-id="modalRentPump">
                                выбрать и узнать стоимость
                            </button>
                            <div class="actions__comment">
                                Ваш заказ будет доставлен прямо на вашу строительную
                                площадку в любое удобное время.
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
                </div>
            </div>
        </div>
    </div>
</div>

<?/* Компонент со списком популярных товаров из раздела Аренда */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"pump-rent", 
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
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "rent",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "50",
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
			0 => "PRICE",
			1 => "PRICE_MINIMUM",
			2 => "POPULAR",
			3 => "",
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
		"COMPONENT_TEMPLATE" => "pump-rent"
	),
	false
);?>

<?/* Вставка включаемой области Баннер "Купить бетон с доставкой"
   * Внтури родительского контейнера включаемой области /include/buy-concrete.php
   * две дочерние включаемые области /include/buy-concrete-title.php и /include/buy-concrete-txt.php
   * соответственно с заголовком блока и текстом блока
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/buy-concrete.php"
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

