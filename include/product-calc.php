<div class="modal" id="modalProductCalc">
    <div class="container container__dialog" id="modalDialogProductCalc">
        <div class="modal__close yandex-modal-map__btn-close"
             id="btnModalCalcClose"></div>
        <div class="row">
            <div class="col-xl-5 calc__wrap">
                <div class="calc">
                    <h5 class="calc__title">Расчёт стоимости продукции</h5>
                    <form class="form calc__nums d-flex flex-column align-items-start"
                          action="/utils/push-item-to-cart.php"
                          method="POST"
                          enctype="multipart/form-data"
                          id="productCalcForm">
                        <input type="hidden" value="<?= $arParams['PRODUCT_PRICES']?>" name="product-prices" data-product-prices="<?= $arParams['PRODUCT_PRICES']?>" id="productPrices">
                        <input type="hidden" value="<?= $arParams['DELIVERY_PRICES']?>" name="factories" data-delivery-prices="<?= $arParams['DELIVERY_PRICES']?>" id="deliveryPrices">
                        <input type="hidden" value="" name="optimal-factory-id" data-optimal-factory-id id="optimalFactory">
                        <input type="hidden" value="<?= $arParams['PRODUCT_TYPE']?>" name="product-type" data-product-type="<?= $arParams['PRODUCT_TYPE']?>" id="productType">
                        <input type="hidden" value="<?= $arParams['PRODUCT_DESCRIPTION']?>" name="product-description" data-product-description="<?= $arParams['PRODUCT_DESCRIPTION']?>" id="productDescription">
                        <input type="hidden" value="<?= $arParams['PRODUCT_NAME']?>" name="product-name" id="productNameController">
                        <input type="hidden" value name="route-length" id="routeLength">
                        <input type="hidden" value name="delivery-price" id="deliveryPriceController">
                        <input type="hidden" value name="product-price" id="productPriceController">
                        <input type="hidden" value name="final-price" id="finalPrice">
                        <label class="label label_value">
                            <span>Количество (м<sup>3</sup>)</span>
                            <span class="value-checker">
                                <span class="value-checker__btn value-checker__btn_minus"></span>
                                <input type="number"
                                       name="product-value"
                                       step="1"
                                       value="0"
                                       min="0"
                                       class="input value"
                                       id="valueInput">
                                <span class="value-checker__btn value-checker__btn_plus"></span>
                                <span class="err__msg">Некорректное значение</span>
                            </span>
                        </label>
                        <label class="label label_w284 label_address">
                            <span>Адрес доставки:</span>
                            <input type="text"
                                   name="delivery-address"
                                   class="input address"
                                   placeholder="Россия, Московская область, городской"
                                   id="addressInput">
                            <span class="err__msg">Некорректное значение</span>
                        </label>
                        <button class="btn" type="submit">рассчитать</button>
                    </form>
                </div>
            </div>
            <div class="col-xl-7 map__wrap pl-xl-0">
                <div id="productCalcMap"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 calc-results">
                <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                     id="calcResultContainerModal">
                    <div class="calc-results__title d-flex flex-column align-items-center align-items-xl-end">
                        <div class="calc-results__product-name" id="calcProductNameContainer"></div>
                        <div>
                            Итого:<span id="calcPriceContainer"></span>руб.
                        </div>
                        <button class="btn btn_add-product-to-cart" id="addProductToCart">Добавить в корзину</button>
                    </div>
                    <div class="calc-results__desc">
                        <ul>
                            <li>Отгрузка:&nbsp; <span id="calcFactoryContainer"></span></li>
                            <li>Расстояние:&nbsp; <span id="calcRoutContainer"></span></li>
                            <li>Количество: <span id="calcValueContainer"></span></li>
                            <li>Место поставки:&nbsp; <span id="calcCoordsContainer"></span></li>
                            <li>Стоимость доставки: <span id="calcProdDeliveryPriceContainer"></span></li>
                            <li>Стоимость продукции: <span id="calcProductPriceContainer"></span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 calc-results">
                <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                     id="calcErrorCoordsContainer">
                    <div class="calc-results__title">
                        <h3>Некорректный адерса доставки</h3>
                    </div>
                    <div class="calc-results__desc">
                        <p>
                            Для определения Адреса доставки воспользуйтесь картой.
                            <b>Кликните на то место в котором Вы хотите получить продукцию</b>, после чего координаты
                            этого места будут автоматически скопированы в поле Адрес дастовки.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 calc-results">
                <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                     id="calcErrorRouteContainer">
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