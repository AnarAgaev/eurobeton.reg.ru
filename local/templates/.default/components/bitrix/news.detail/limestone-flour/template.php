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
// debug($arResult);
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
        "PRODUCT_TYPE" => 'limestoneFlour', // Тип товара для сохранения в соответствующем разделе корзины
        "PRODUCT_DESCRIPTION" => '', // Описание товара. Для Известковой муки описание НЕТ
        "PRODUCT_NAME" => $arResult['NAME'] // Наименование товара
    ),
	false
);?>
<div class="mineral-powder">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications">
                    <?=$arResult["PROPERTIES"]["LIMESTONE_FLOUR_DESCRIPTION"]["~VALUE"]["TEXT"]?>
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
                                <div class="footnote">Без транспортных услуг</div>
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
                        <a class="btn show-modal"
                           href=""
                           data-modal-id="modalSetOrder">
                            Персональное предложение
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>