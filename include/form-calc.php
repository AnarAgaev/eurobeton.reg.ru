<?
/* Получаем все товары раздела Бетон и его
 * подразделов (Администрирование/Контент/Продукция/Бетон).
 *
 * https://dev.1c-bitrix.ru/api_help/iblock/classes/ciblockelement/getlist.php
 */


// Получаем все товары раздела Бетон и всех подразделов
$infoBlockId = 7; // ИД инфоблока Бетон
$arConcreteItems = Array();

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>IntVal($infoBlockId), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$arSort = Array("ID"=>"ASC");
$res = CIBlockElement::GetList($arSort, $arFilter, false, Array("nPageSize"=>100), $arSelect);
$arResult["PREVIEW_PICTURE"] = CFile::GetFileArray($arResult["PREVIEW_PICTURE"]);
while($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

    $arConcreteItems[] = Array(
        "FIELDS" => $arFields,
        "PROPS" => $arProps,
        "PREVIEW_PICTURE" => CFile::GetFileArray($arFields["PREVIEW_PICTURE"]),
    );
}

// Получаем стоимость доставки таовара Бетон на каждом из предприятий, где 24 - это ИД инфоблока прайса
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
?>

<div class="yandex-modal-map" id="concreteCalcMap">
    <button class="yandex-modal-map__btn-close" id="btnConcreteMapCloser"></button>
</div>
<div class="modal d-flex justify-content-end align-items-start" id="concreteModal">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="msgAddConcreteTrue">
        <h3 class="send-msg-true__title">Товар добавлен в корзину</h3>
        <span class="send-msg-true__txt">Оформите заказ прямо сейчас или в любой момент, кликнув на иконку корзины вверху справа, или добавьте ещё один товар.</span>
        <button class="btn" id="btnOpenModalCart">Оформить заказ</button>
        <button class="btn" id="btnConcreteModalClose">Добавить товар</button>
    </div>
</div>
<div class="calculator">
    <div class="calculator__title d-flex align-items-center justify-content-center">
        РАССЧИТАТЬ ЦЕНУ БЕТОНА С ДОСТАВКОЙ
    </div>
    <form class="form form-calc"
          action="/utils/push-item-to-cart.php"
          enctype="multipart/form-data"
          method="post"
          id="concreteCalcForm">
        <input type="hidden"
               data-items='<?=json_encode($arConcreteItems)?>'
               id="concreteAllItems">

        <input type="hidden"
               value='<?=$JSON__DELIVERY_PRICES?>'
               name="factories"
               data-delivery-prices='<?=$JSON__DELIVERY_PRICES?>'
               id="deliveryPrices">

        <input type="hidden" value="concrete" name="product-type">
        <input type="hidden" value='' name="optimal-factory-id" id="concreteOptimalFactory">
        <input type="hidden" value="" name="route-length" id="concreteRouteLength">
        <input type="hidden" value="" name="delivery-price" id="concreteDeliveryPriceController">
        <input type="hidden" value="" name="product-price" id="concreteProductPriceController">
        <input type="hidden" value="" name="final-price" id="concreteFinalPriceController">
        <input type="hidden" value="" name="product-description" id="concreteDescriptionController">
        <input type="hidden" value="" name="product-name" id="concreteNameController">
        <input type="hidden" value="" name="product-prices" id="concretePricesController">
        <input type="hidden" value="" name="product-pic-src" id="concretePicSrcController">

        <div class="container">
            <div class="form__controls form_place d-flex align-items-lg-end flex-column align-items-start flex-lg-row">
                <div class="form__title">Место доставки и аренда техники</div>
                <label class="label label_w380 label_address">
                    <span>Адрес доставки:</span>
                    <input class="input address"
                           type="text"
                           placeholder="Россия, Москва, Силикатный проезд ..."
                           name="delivery-address"
                           value=""
                           id="concreteAddress">
                    <span class="err__msg">Некорректное значение</span>
                </label>
                <label class="label">
                    <span class="btn-select-place d-flex justify-content-center align-items-center"
                          id="btnSelectAddressOnMap">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/select-address.png" alt="Выбрать место на карте">
                        <span>Выбрать адрес на карте</span>
                    </span>
                </label>
                <label class="label label_check d-flex align-items-center">
                    <span>Арендовать бетононасос</span>
                    <input class="input"
                           type="checkbox"
                           value="true"
                           name="concrete-rent-pump"
                           id="concreteRentPump">
                    <span class="checker"></span>
                </label>
            </div>
            <div class="form__controls form_parametrs d-flex flex-wrap">
                <div class="form__title">Основные параметры бетона</div>
                <div class="group-one" id="concreteParamsGroupOne">
                    <label class="label label_w380 label_select label_grade">
                        <span>Марка:</span>
                        <select class="select"
                                name="concrete-grade"
                                id="concreteGrade">
                            <option value="">Не указана</option>
                            <option id="B7_5" value="B7_5">B7,5</option>
                            <option id="B10" value="B10">B10</option>
                            <option id="B12_5" value="B12_5">B12,5</option>
                            <option id="B15" value="B15">B15</option>
                            <option id="B20" value="B20">B20</option>
                            <option id="B22_5" value="B22_5">B22,5</option>
                            <option id="B25" value="B25">B25</option>
                            <option id="B30" value="B30">B30</option>
                            <option id="B35" value="B35">B35</option>
                            <option id="B40" value="B40">B40</option>
                            <option id="B45" value="B45">B45</option>
                            <option id="B50" value="B50">B50</option>
                            <option id="B60" value="B60">B60</option>
                            <option id="B70" value="B70">B70</option>
                            <option id="B75" value="B75">B75</option>
                            <option id="B80" value="B80">B80</option>
                            <option id="M100" value="M100">M100</option>
                            <option id="M150" value="M150">M150</option>
                            <option id="М200" value="М200">М200</option>
                            <option id="CEMENT_MILK" value="CEMENT_MILK">Цементное молоко</option>
                            <option id="STARTING_MIXTURE" value="STARTING_MIXTURE">Пусковая смесь</option>
                        </select>
                        <span class="btn__reset-select"></span>
                        <span class="err__msg">Выберите марку бетона</span>
                    </label>
                    <label class="label label_w245 label_select">
                        <span>Наполнитель:</span>
                        <select class="select"
                                name="concrete-filler"
                                id="concreteFiller">
                            <option value="">Не указан</option>
                            <option id="NO_PLACEHOLDER" value="NO_PLACEHOLDER">Без заполнителя</option>
                            <option id="GRANITE_5_20" value="GRANITE_5_20">Гранит 5-20</option>
                            <option id="GRAVEL_5_20" value="GRAVEL_5_20">Гравий 5-20</option>
                        </select>
                        <span class="btn__reset-select"></span>
                    </label>




                    <label class="label label_value">
                        <span>Объём (м<sup>3</sup>):</span>
                        <span class="value-checker">
                            <span class="value-checker__btn value-checker__btn_minus" id="btnConcreteValMinus"></span>
                            <input type="number"
                                   name="product-value"
                                   step="1"
                                   value="0"
                                   min="0"
                                   class="input value"
                                   id="concreteValue">
                            <span class="value-checker__btn value-checker__btn_plus" id="btnConcreteValPlus"></span>
                        </span>
                        <span class="err__msg">Некорректное значение</span>
                    </label>

                    <label class="label label-btn">
                        <span><b>Набрал свыше 300 кубов?</b></span>
                        <a class="btn show-modal" data-modal-id="modalSetOrder">спец. предложение</a>
                    </label>

                </div>
                <!--
                    <div class="group-additive">
                        <div class="tglr" id="concreteAddParamsTglr">
                            <b>Добавки</b>(выберите при необходиости):
                        </div>
                    </div>
                -->
                <div class="group-two params-visible" id="concreteParamsGroupTwo">
                    <label class="label label_w212 label_select">
                        <span>Морозостойкость:</span>
                        <select class="select"
                                name="concrete-frost"
                                id="concreteFrost">
                            <option value="">Не указана</option>
                            <option id="F50" value="F50">F50</option>
                            <option id="F100" value="F100">F100</option>
                            <option id="F150" value="F150">F150</option>
                            <option id="F200" value="F200">F200</option>
                            <option id="F300" value="F300">F300</option>
                        </select>
                        <span class="btn__reset-select"></span>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Подвижность:</span>
                        <select class="select"
                                name="concrete-mobility"
                                id="concreteMobility">
                            <option value="">Не указана</option>
                            <option id="P2" value="P2">П2</option>
                            <option id="P3" value="P3">П3</option>
                            <option id="P4" value="P4">П4</option>
                            <option id="P5" value="P5">П5</option>
                        </select>
                        <span class="btn__reset-select"></span>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Водонепроницаемость:</span>
                        <select class="select"
                                name="concrete-water"
                                id="concreteWater">
                            <option value="">Не указана</option>
                            <option id="W2" value="W2">W2</option>
                            <option id="W4" value="W4">W4</option>
                            <option id="W6" value="W6">W6</option>
                            <option id="W8" value="W8">W8</option>
                            <option id="W10" value="W10">W10</option>
                            <option id="W12" value="W12">W12</option>
                            <option id="W14" value="W14">W14</option>
                            <option id="W16" value="W16">W16</option>
                        </select>
                        <span class="btn__reset-select"></span>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Противоморозные доб.:</span>
                        <select class="select"
                                name="concrete-Antifreeze"
                                id="concreteAntifreeze">
                            <option value="">Не указана</option>
                            <option id="5" value="5">-5</option>
                            <option id="10" value="10">-10</option>
                            <option id="15" value="15">-15</option>
                            <option id="20" value="20">-20</option>
                        </select>
                        <span class="btn__reset-select"></span>
                    </label>
                </div>
                <button class="btn-form-send d-flex justify-content-center align-items-center"
                type="submit"
                form="concreteCalcForm">
                    <span>рассчитать стоимость</span>
                </button>
            </div>
        </div>
    </form>
    <div class="calculator__resaults-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 calc-results">
                    <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                         id="concreteResultContainer">
                        <div class="calc-results__title d-flex flex-column align-items-center align-items-xl-end">
                            <div class="calc-results__product-name" id="concreteNameContainer"></div>
                            <div>
                                Итого:<span id="concretePriceContainer"></span>руб.
                            </div>
                            <button class="btn btn_add-product-to-cart" id="addConcreteToCart">Добавить в корзину</button>
                        </div>
                        <div class="calc-results__desc">
                            <ul>
                                <li>Отгрузка:&nbsp; <span id="concreteFactoryContainer"></span></li>
                                <li>Расстояние:&nbsp; <span id="concreteRoutContainer"></span></li>
                                <li>Количество: <span id="concreteValueContainer"></span></li>
                                <li>Место поставки:&nbsp; <span id="concreteCoordsContainer"></span></li>
                                <li>Стоимость доставки: <span id="concreteProdDeliveryPriceContainer"></span></li>
                                <li>Стоимость продукции: <span id="concreteProductPriceContainer"></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 calc-results">
                    <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                         id="concreteErrorCoordsContainer">
                        <div class="calc-results__title">
                            <h3>Некорректный адерса доставки</h3>
                        </div>
                        <div class="calc-results__desc">
                            <p>
                                Для определения Адреса доставки воспользуйтесь картой.
                                <b>Кликните на кнопке Выбрать адрес на карте, на открывшейся карте
                                Кликните на то место в котором Вы хотите получить продукцию</b>,
                                после чего координаты этого места будут автоматически скопированы
                                в поле Адрес дастовки.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 calc-results">
                    <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                         id="concreteErrorRouteContainer">
                        <div class="calc-results__title">
                            <h3>Слишком длинный путь доставки</h3>
                        </div>
                        <div class="calc-results__desc">
                            <p>
                                К сожалению, доставка в указанное место невозможна.<br>
                                Укажите другое место доставки.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
