<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?$APPLICATION->SetTitle("О компании");?>
<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "breadcrumbs", Array(
    "PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
    "SITE_ID" => "s1",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
    "START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
),
    false
);?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content">
            <?$APPLICATION->ShowTitle(false)?>
        </h1>
    </div>
</div>

<div class="company">
    <div class="container">
        <div class="row">
            <div class="col-xl-7">
                <?/* Вклчаемая область Первая часть текст на странице О Компании */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/comp-top-txt.php"
                    )
                );?>
            </div>
            <div class="col-xl-4 offset-xl-1 company__pic-wrap">
                <div class="company__director-pic">
                    <?/* Вклчаемая область Ссылка на страницу о Генеральном директоре */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-dir-img.php"
                        )
                    );?>
                </div>
                <div class="company__director-link">
                    <?/* Вклчаемая область Ссылка на страницу о Генеральном директоре */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-img-capt-link.php"
                        )
                    );?>
                    <span>
                        <?/* Вклчаемая область Имя генерального директора */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/comp-dir-name.pnp"
                            )
                        );?>
                    </span>
                </div>
            </div>
            <div class="col-12">
                <?/* Вклчаемая область Вторая часть текст на странице О Компании */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/comp-middle-txt.php"
                    )
                );?>
            </div>
            <div class="col-12">
                <blockquote class="blockquote">
                    <?/* Вклчаемая область Цитата на странице О Компании */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-blockquote.php"
                        )
                    );?>
                </blockquote>
            </div>
            <div class="col-12">
                <?/* Вклчаемая область Третья часть текст на странице О Компании */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/comp-bottom-txt.php"
                    )
                );?>
            </div>
        </div>
    </div>
</div>

<div class="strategy">
    <div class="container">
        <div class="row">
            <div class="col-12"><h2 class="strategy__title">Стратегия</h2></div>
            <div class="col-12">
                <h3 class="strategy__subtitle">
                    <?/* Вклчаемая область Подзаголовок секции Стратегия */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-strat-subtitle.php"
                        )
                    );?>
                </h3>
            </div>
            <div class="col-xl-6">
                <div class="strategy__pic">
                    <?/* Вклчаемая область Картинка для секции Стратегия */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-strat-pic.php"
                        )
                    );?>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="strategy__description">
                    <h4 class="strategy__description-title">НАШИ ЗАДАЧИ</h4>
                    <?/* Вклчаемая область Текст секции Стратегия */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/comp-strat-txt.php"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>

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