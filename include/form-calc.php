<?
/* Получаем из сессии все товары раздела Бетон и его
 * подразделов (Администрирование/Контент/Продукция/Бетон).
 * Если переменой с аднными не существует, то получаем
 * данные из Инфоблока и сохраняем в сессиию.
 */


?>
<div class="modal d-flex justify-content-end align-items-start" id="concreteModal">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="msgAddConcreteTrue">
        <h3 class="send-msg-true__title">Товар добавлен в корзину</h3>
        <span class="send-msg-true__txt">Оформите заказ, кликнув на иконку корзины вверху справа, или добавьте ещё один товар.</span>
        <button class="btn" id="btnConcreteModalClose">Закрыть</button>
    </div>
</div>
<div class="calculator">
    <div class="calculator__title d-flex align-items-center justify-content-center">
        РАССЧИТАТЬ ЦЕНУ БЕТОНА С ДОСТАВКОЙ
    </div>
    <form class="form form-calc" enctype="multipart/form-data" method="post">
        <div class="container">
            <div class="form__controls form_place d-flex align-items-lg-end flex-column align-items-start flex-lg-row">
                <div class="form__title">Место доставки и аренда техники</div>
                <label class="label label_w380 label_address">
                    <span>Адрес доставки:</span>
                    <input class="input address"
                           type="text"
                           placeholder="Россия, Москва, Силикатный проезд ..."
                           name="concrete-address"
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
            <div class="form__controls form_parametrs">
                <div class="form__title">Основные параметры бетона</div>
                <div class="group-one">
                    <label class="label label_w380 label_select">
                        <span>Марка:</span>
                        <select class="select"
                                name="concrete-grade"
                                id="concreteGrade">
                            <option value="null">Не указана</option>
                            <option value="B7_5">B7,5</option>
                            <option value="B10">B10</option>
                            <option value="B12_5">B12,5</option>
                            <option value="B15">B15</option>
                            <option value="B20">B20</option>
                            <option value="B22_5">B22,5</option>
                            <option value="B25">B25</option>
                            <option value="B30">B30</option>
                            <option value="B35">B35</option>
                            <option value="B40">B40</option>
                            <option value="B45">B45</option>
                            <option value="B50">B50</option>
                            <option value="B60">B60</option>
                            <option value="B70">B70</option>
                            <option value="B75">B75</option>
                            <option value="B80">B80</option>
                            <option value="M100">M100</option>
                            <option value="M150">M150</option>
                            <option value="М200">М200</option>
                            <option value="CEMENT_MILK">Цементное молоко</option>
                            <option value="STARTING_MIXTURE">Пусковая смесь</option>
                        </select>
                    </label>
                    <label class="label label_w245 label_select">
                        <span>Наполнитель:</span>
                        <select class="select"
                                name="concrete-filler"
                                id="concreteFiller">
                            <option value="NO_PLACEHOLDER" selected>Без заполнителя</option>
                            <option value="GRANITE_5_20">Гранит 5-20</option>
                            <option value="GRAVEL_5_20">Гравий 5-20</option>
                        </select>
                    </label>
                    <label class="label label_value">
                        <span>Объём (м<sup>3</sup>):</span>
                        <span class="value-checker">
                            <span class="value-checker__btn value-checker__btn_minus"></span>
                            <input type="number"
                                   name="concrete-value"
                                   step="1"
                                   value="0"
                                   min="0"
                                   class="input value"
                                   id="concreteValue">
                            <span class="value-checker__btn value-checker__btn_plus"></span>
                            <span class="err__msg">Некорректное значение</span>
                        </span>
                    </label>
                    <label class="label label-btn">
                        <span><b>Набрал свыше 300 кубов?</b></span>
                        <a class="btn show-modal" data-modal-id="modalSetOrder">спец. предложение</a>
                    </label>
                </div>
                <div class="group-additive">
                    <div class="tglr"><b>Добавки</b>(выберите при необходиости):</div>
                </div>
                <div class="group-two">
                    <label class="label label_w212 label_select">
                        <span>Морозостойкость:</span>
                        <select class="select"
                                name="concrete-frost"
                                id="concreteFrost">
                            <option value="null">Не указана</option>
                            <option value="F50">F50</option>
                            <option value="F100">F100</option>
                            <option value="F150">F150</option>
                            <option value="F200">F200</option>
                            <option value="F300">F300</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Подвижность:</span>
                        <select class="select"
                                name="concrete-mobility"
                                id="concreteMobility">
                            <option value="null">Не указана</option>
                            <option value="P2">П2</option>
                            <option value="P3">П3</option>
                            <option value="P4">П4</option>
                            <option value="P5">П5</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Водонепроницаемость:</span>
                        <select class="select"
                                name="concrete-water"
                                id="concreteWater">
                            <option value="null">Не указана</option>
                            <option value="W2">W2</option>
                            <option value="W4">W4</option>
                            <option value="W6">W6</option>
                            <option value="W8">W8</option>
                            <option value="W10">W10</option>
                            <option value="W12">W12</option>
                            <option value="W14">W14</option>
                            <option value="W16">W16</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
                        <span>Противоморозные доб.:</span>
                        <select class="select"
                                name="concrete-Antifreeze"
                                id="concreteAntifreeze">
                            <option value="null">Не указана</option>
                            <option value="5">-5</option>
                            <option value="10">-10</option>
                            <option value="15">-15</option>
                            <option value="20">-20</option>
                        </select>
                    </label>
                </div>
                <div class="btn-form-send d-flex justify-content-center align-items-center">
                    <span>рассчитать стоимость</span>
                </div>
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
