<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>
<?$APPLICATION->SetTitle("Главная");?>
<?// Баннер под шапкой с анимацией на картинке ?>
<div class="billboard section_container">
    <div class="container">
        <div class="row">
            <div class="billboard__desc col-lg-7 col-xl-6">
                <div class="billboard__title">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/banner-title.php"
                        )
                    ); ?>
                </div>
                <div class="billboard__txt">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/bunner-subtitle.php"
                        )
                    ); ?>
                </div>
                <div class="billboard__btn"><a class="btn" href="">консультация</a></div>
            </div>
            <div class="billboard__pic col-lg-5 col-xl-6">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/banner-picture.php"
                    )
                );?>
            </div>
        </div>
    </div>
</div>

<?/* Вывод карточек с предложениями на главной странице:
   * Инфоблоки->Типы инфоблоков->Контент->Предложения
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"offers", 
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
		"IBLOCK_ID" => "2",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
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
			0 => "PAGE_URL",
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
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "offers"
	),
	false
);?>

<div class="calculator section_container">
<div class="calculator">
    <div class="calculator__title d-flex align-items-center justify-content-center">
        РАССЧИТАТЬ ЦЕНУ БЕТОНА С ДОСТАВКОЙ
    </div>
    <form class="form" enctype="multipart/form-data" method="post">
        <div class="container">
            <div class="form__controls form_place d-flex align-items-lg-end flex-column align-items-start flex-lg-row">
                <div class="form__title">Место и время доставки</div>
                <label class="label label_w380">
                    <span>Адрес доставки:</span>
                    <input class="input" type="text" placeholder="Россия, Московская область, сельский посёлок Карачиха">
                </label>
                <label class="label label_w212">
                    <span>Дата доставки:</span>
                    <input class="input" type="text" placeholder="Не указана">
                </label>
                <label class="label label_check d-flex align-items-center">
                    <span>Самовывоз</span>
                    <input class="input" type="checkbox" value="true" name="takeself" checked>
                    <span class="checker"></span>
                </label>
                <label class="label label_w205">
                    <span>Выберите завод:</span>
                    <input class="input" type="text" placeholder="Не указан">
                </label>
            </div>
            <div class="form__controls form_parametrs">
                <div class="form__title">Основные параметры бетона</div>
                <div class="group-one">
                    <label class="label label_w380 label_select">
                        <span>Марка:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Прочность (кгс/см<sup>2</sup>):</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w245 label_select">
                        <span>Наполнитель:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>

                    <label class="label label_value">
                        <span>Объём (м<sup>3</sup>):</span>
                        <span class="value-checker">
                            <span class="value-checker__btn value-checker__btn_minus"></span>
                            <input class="input" type="text" value="0" readonly="">
                            <span class="value-checker__btn value-checker__btn_plus"></span>
                        </span>
                    </label>
                </div>
                <div class="group-additive">
                    <div class="tglr"><b>Добавки</b>(выберите при необходиости):</div>
                </div>
                <div class="group-two">
                    <label class="label label_w179 label_select">
                        <span>Морозостойкость:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w174 label_select">
                        <span>Подвижность:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Водонепроницаемость:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w179 label_select">
                        <span>Противоморозные доб.:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w205 label_select">
                        <span>Фибра:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                </div>
                <div class="btn-form-send"><span>добавить товар</span></div>
            </div>



            <div class="form_comments d-flex justify-content-between flex-wrap">
                <div class="d-flex flex-column wrapper flex-xl-row">
                    <div class="form_comments-text">
                        <div class="title">Комментарий к заказу:</div>
                        <textarea class="textarea" placeholder="Начните вводить ..."></textarea>
                    </div>
                    <div class="form_comments-technics">
                        <div class="title">Аренда техники:</div>
                        <label class="label label_check d-flex align-items-center">
                            <span>Бетононасос</span>
                            <input class="input" type="checkbox" value="true" name="pump" checked>
                            <span class="checker"></span>
                        </label>
                        <label class="label label_check d-flex align-items-center">
                            <span>Кран</span>
                            <input class="input" type="checkbox" value="true" name="crane">
                            <span class="checker"></span>
                        </label>
                    </div>
                </div>
                <div class="form_comments-offer d-flex flex-column align-items-center">
                    <div class="title"><b>Набрал свыше 300 кубов?</b>Тогда получай</div>
                    <a class="btn" href="">Персональное предложение</a></div>
            </div>
        </div>
    </form>
    <div class="calculator__resaults-wrap d-flex justify-content-center align-items-center">
        <div class="calculator__resaults d-flex align-items-center flex-column flex-xl-row">
            <div class="calculator__resaults-btn"><a class="btn" href="">добавить в корзину</a></div>
            <div class="calculator__resaults-price d-flex align-items-center">
                <div>Итого:<span>3000</span>руб.</div>
            </div>
            <div class="calculator__resaults-comments">
                <div class="calculator__resaults-delivery">Стоимость
                    доставки:<span>Не выбран адрес доставки</span></div>
                <div class="calculator__resaults-concrete">Стоимость бетона:<span>Укажите параметры</span></div>
            </div>
        </div>
    </div>

   <!-- !!! Заглушка до момнета деплоя рабочей версии калькулятора. После тестрирования на продакшене нужно удалить -->
    <div class="temporary-plug d-flex justify-content-center align-items-center flex-column">
        <h4>Скоро зедсь будет новый и удобный калькулятор.<br>А пока, если у Вас есть вопросы, их можно здалть менеджеру.</h4>
        <a class="btn" href="">Вопрос менеджеру</a>
    </div>

</div>
</div>

<?/* Выводим слайдер с популярными товарами ТОЛЬКО ИНФОБЛОКА БЕТОН (из всех подразделов кталога):
   * Инфоблоки->Типы инфоблоков->Каталог->Бетон
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"beton-slider", 
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
		"IBLOCK_ID" => "7",
		"IBLOCK_TYPE" => "products",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "100",
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
			0 => "CONCRETE_GRADE",
			1 => "CONCRETE_CLASS",
			2 => "CONCRETE_MOBILITY",
			3 => "CONCRETE_FROST",
			4 => "CONCRETE_WATER",
			5 => "CONCRETE_FILLER",
			6 => "CONCRETE_STRENGTH",
			7 => "PRICE",
			8 => "PRICE_MINIMUM",
			9 => "POPULAR",
			10 => "",
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
		"COMPONENT_TEMPLATE" => "beton-slider"
	),
	false
);?>

<?/* Включаемый компонент со списком преимуществ:
   * Инфоблоки->Типы инфоблоков->Контент->Преимушества
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"advantages", 
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
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "3",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
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
		"SORT_BY1" => "ID",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "advantages"
	),
	false
);?>

<?// Яндекс карта для главной страницы с несколькоими балунами ?>
<div class="map section_container">
    <div class="map__title px-5 section_title">Собственные заводы</div>
    <div class="map__body" id="map"></div>
</div>

<?/* Выводим списка партнёров на главной странице:
   * Инфоблоки->Типы инфоблоков->Контент->Партнёры
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"partners", 
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
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "30",
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
			0 => "PARTNER_URL",
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
		"COMPONENT_TEMPLATE" => "partners"
	),
	false
);?>

<?/* Вставка включаемой области Баннер "Получить расчёт стоимости"
   * Внтури родительского контейнера включаемой области /include/request-price.php
   * две дочерние включаемые области /include/request-price-title.php и /include/request-price-txt.php
   * соответственно с заголовком блока и текстом блока
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/request-price.php"
    )
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

<?/* Конмпонент списка новостей
   * Шаблон компонента:
   *   local->templates->main->components->bitrix->news.list->news-list
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news-list", 
	array(
		"ACTIVE_DATE_FORMAT" => "j F Y",
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
		"DETAIL_URL" => "o-kompanii/novosti/#ELEMENT_CODE#/",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "DETAIL_PICTURE",
			2 => "DATE_ACTIVE_FROM",
			3 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "5",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "4",
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
		"COMPONENT_TEMPLATE" => "news-list"
	),
	false
);?>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>