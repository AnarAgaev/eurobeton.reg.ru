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
//debug($arResult);
?>
<?/* Вставка включаемой области Модальные окна на страницах с товарами
   * В калькулятор расчёта стомимости товара (цена товара + доставка)
   * передаются переменные содержащие цены товара на всех заводах
   * и стомость доставки на каждом из заводов.
   */
$arPRODUCT_PRICES = Array(
    "382" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_382']['VALUE'],
    "383" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_383']['VALUE'],
    "384" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_384']['VALUE'],
    "385" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_385']['VALUE'],
    "386" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_386']['VALUE'],
    "387" => $arResult['PROPERTIES']['PRICE_FACTORY_ID_387']['VALUE'],
);
$JSON__PRODUCT_PRICES = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arPRODUCT_PRICES, JSON_UNESCAPED_UNICODE)
    : json_encode($arPRODUCT_PRICES);

// Получаем стоимость доставки данного товара на каждом из предприятий, где 29 - это ИД инфоблока прайса
$iterator = CIBlockElement::GetPropertyValues(29, array(), true, array());
while ($row = $iterator->Fetch()) {
    $res = CIBlockElement::GetByID($row['IBLOCK_ELEMENT_ID']);
    $arDELIVERY_PRICES[$row['IBLOCK_ELEMENT_ID']] = Array(
        'name' => $res->GetNext()['NAME'],
        'address' => $row['130'],
        'coordinates' => $row['131'],
        'prices' => [
            '5' => $row['132'],
            '10' => $row['133'],
            '15' => $row['134'],
            '20' => $row['135'],
            '25' => $row['136'],
            '30' => $row['137'],
            '35' => $row['138'],
            '40' => $row['139'],
            '45' => $row['140'],
            '50' => $row['141'],
        ]
    );
}
$JSON__DELIVERY_PRICES = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arDELIVERY_PRICES, JSON_UNESCAPED_UNICODE)
    : json_encode($arDELIVERY_PRICES);

$PRODUCT_DESCRIPTION = 'Порода - '.$arResult['PROPERTIES']['RUBBLE_TYPE']['VALUE'].'; '
 .'Прочность - '.$arResult['PROPERTIES']['RUBBLE_STRENGTH']['VALUE'].'; '
 .'Морозостойкость - '.$arResult['PROPERTIES']['RUBBLE_FROST']['VALUE'].'; '
 .'Насыпной коэффициент - '.$arResult['PROPERTIES']['RUBBLE_BULK_RATIO']['VALUE'].'.';

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
        "PRODUCT_TYPE" => 'crushedStone', // !!! Тип товара для сохранения в соответствующем разделе корзины
        "PRODUCT_DESCRIPTION" => $PRODUCT_DESCRIPTION, // Описание товара. Для Известковой муки описание НЕТ
        "PRODUCT_NAME" => $arResult['NAME'], // Наименование товара
        "PRODUCT_PICTURE_SRC" => $arResult['PREVIEW_PICTURE']['SRC'] // Путь к изображению для анонса товара
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
<div class="product-rubble">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications"><h5 class="specifications__title">Характеристики:</h5>
                    <ul class="specifications__list">
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Порода</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["RUBBLE_TYPE"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Прочность</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["RUBBLE_STRENGTH"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Морозостойкость, F</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["RUBBLE_FROST"]["VALUE"]?></span>
                        </li>
                        <li class="specifications__item d-flex justify-content-between">
                            <span class="specifications__parametr">Насыпной коэффициент</span>
                            <span class="specifications__value"><?=$arResult["PROPERTIES"]["RUBBLE_BULK_RATIO"]["VALUE"]?></span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-6 description__wrap">
                <div class="description">
                    <div class="description__content">
                        <?=$arResult["DETAIL_TEXT"]?>
                    </div>
                    <div class="description__toggler">Развернуть</div>
                </div>
            </div>
            <div class="col-xl-6 actions__wrap">
                <div class="actions">
                    <div class="actions__price">Стоимость:
                        <span><?
                            $PRICE_COUNT = 0;
                            $PRICE = false;

                            for ($i = 382; $i < 388; $i++) {
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
                            echo $PRICE . ' руб';?></span>
                    </div>
                    <div class="actions__btns d-flex flex-column align-items-center flex-xl-row align-items-xl-start">
                        <div class="actions__txt">
                            <button class="btn" id="showModalProductCalc">
                                рассчитать полную стоимость
                            </button>
                            <div class="actions__comment">
                                Отгрузка осуществляется железнодорожным, водным и
                                автомобильным транспортом.
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
</div>

<?/* Выводим популярные товары
   * В карточке товара должна быть выставлена галка Показывать в списке популярные
   */
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"rubble-popular", 
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
			0 => "ID",
			1 => "NAME",
			2 => "PREVIEW_TEXT",
			3 => "PREVIEW_PICTURE",
			4 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "8",
		"IBLOCK_TYPE" => "products",
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
		"EXCLUDE_ELEMENT_ID" => $arResult["ID"],
		"COMPONENT_TEMPLATE" => "rubble-popular"
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