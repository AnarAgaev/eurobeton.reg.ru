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
<div class="modal" id="modalEquipmentOrder">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="sendEquipmentOrderMsgTrue">
        <h3 class="send-msg-true__title">Сообщение отправлено</h3>
        <span class="send-msg-true__txt">Менеджер свяжется с Вами в ближайшее время.</span>
        <button class="btn" id="btnEOClose">Закрыть</button>
    </div>
    <div class="modal__dialog modal__dialog_set-order" id="modalDialogEquipmentOrder">
        <div class="modal__close"></div>
        <div class="modal__content">
            <div class="modal__header">
                <h4 class="modal__title">Заказ доп. оборудования</h4>
            </div>
            <div class="modal__body">
                <h5 class="modal__subtitle d-flex flex-column justify-content-center align-items-center flex-md-row">
                    <span>Заявка на заказ:</span>
                    <span class="pl-md-1"><b><?= $arResult['NAME']?></b></span>
                </h5>
                <form class="form modal__form d-flex flex-column flex-md-row"
                      name="form_equipment_order"
                      action="/utils/handle-form-equipment-order.php"
                      method="POST"
                      enctype="multipart/form-data"
                      id="formEquipmentOrder">
                    <input type="hidden" name="product-name" value="<?= $arResult['NAME']?>">
                    <input type="hidden" name="product-link" value="<?= $APPLICATION->GetCurUri()?>">
                    <div class="modal__controls d-flex flex-column">
                        <label class="label label_w272">
                            <span>Ваше имя:</span>
                            <input class="input"
                                   type="text"
                                   name="name"
                                   placeholder="Иванов Иван"
                                   id="formEquipmentOrderName">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Ваш e-mail:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="example@example.com"
                                   name="email"
                                   id="formEquipmentOrderMail">
                            <span class="err__msg"></span>
                        </label>
                        <label class="label label_w272">
                            <span>Телефон:</span>
                            <input class="input"
                                   type="text"
                                   placeholder="+7 (999) 999-99-99"
                                   name="phone"
                                   id="formEquipmentOrderPhone">
                            <span class="err__msg"></span>
                        </label>
                    </div>
                    <div class="modal__msg">
                        <label class="label">
                            <span>Комментарий:</span>
                            <textarea class="textarea"
                                      placeholder="Данные для расчёта"
                                      name="message"
                                      id="formEquipmentOrderMsg"></textarea>
                            <span class="err__msg"></span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal__footer d-flex flex-column flex-md-row align-items-center justify-content-center">
                <button class="btn" type="submit" form="formEquipmentOrder">отправить</button>
                <div class="modal__agreement">
                    Нажимая кнопку, вы соглашаетесь с условиями
                    <a class="link"
                       download="Пользовательское_соглашение_Евробетон"
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
<?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "breadcrumbs",
    Array(
        "PATH" => "/",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    )
);?>
<div class="page-title">
    <div class="container"><h1 class="page-title__content"><?=$arResult['NAME']?></h1></div>
</div>
<div class="pump-rental">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult['DETAIL_PICTURE']['SRC']?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications__mark has-border">Аренда техники только для Москвы и Московской области!</div>
                <div class="specifications">
                    <?=$arResult['PROPERTIES']['NOTE']['~VALUE']['TEXT']?>
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
                            без учёта продолжительности раб. смены
                        </div>
                    </div>
                    <div class="actions__btns d-flex flex-column align-items-center flex-xl-row align-items-xl-start">
                        <div class="actions__txt d-flex flex-column align-items-center flex-sm-row flex-sm-wrap justify-content-sm-center justify-content-xl-start">
                            <button class="btn show-modal mb-4 mb-sm-0 mr-sm-3" data-modal-id="modalEquipmentOrder">
                                заказать
                            </button>
                            <div class="btn-call ml-sm-3 ml-xl-4">
                                <?/* Вставка включаемой области Сделать звонок.
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
                            <div class="actions__comment">
                                Ваш заказ будет доставлен прямо на вашу строительную
                                площадку в любое удобное время.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?/* Компонент со списком популярных товаров из раздела Аренда */
$APPLICATION->IncludeComponent("bitrix:news.list", "pump-rent", Array(
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
    "DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
    "DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
    "FIELD_CODE" => array(	// Поля
        0 => "",
        1 => "",
    ),
    "FILTER_NAME" => "",	// Фильтр
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
    "IBLOCK_ID" => "22",	// Код информационного блока
    "IBLOCK_TYPE" => "rent",	// Тип информационного блока (используется только для проверки)
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
    "INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
    "MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
    "NEWS_COUNT" => "50",	// Количество новостей на странице
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
        0 => "PRICE",
        1 => "PRICE_MINIMUM",
        2 => "POPULAR",
        3 => "",
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




<!--
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif($arResult["DETAIL_TEXT"] <> ''):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
-->