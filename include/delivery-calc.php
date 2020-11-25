<div class="container section_container">
    <div class="row">
        <div class="col-xl-5 calc__wrap">
            <div class="calc">
                <h5 class="calc__title">Автоматизированная система расчёта стоимости доставки</h5>
                <form class="form calc__nums d-flex flex-column align-items-start" id="deliveryСost">
                    <label class="label label_value">
                        <span>Количество (м<sup>3</sup>)</span>
                        <span class="value-checker">
                            <span class="value-checker__btn value-checker__btn_minus"></span>
                            <input type="number" step="1" value="0" min="0" class="input deliveryValue">
                            <span class="value-checker__btn value-checker__btn_plus"></span>
                            <span class="err__msg">Не корректное значение</span>
                        </span>
                    </label>
                    <label class="label label_w284 label_address">
                        <span>Адрес доставки:</span>
                        <input type="text" class="input deliveryAddress"
                               placeholder="Россия, Московская область, городской">
                        <span class="err__msg">Не корректное значение</span>
                    </label>
                    <button class="btn" type="submit">рассчитать</button>
                </form>
            </div>
        </div>
        <div class="col-xl-7 map__wrap">
            <div id="deliveryMap"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 calc-results">
            <div class="calc-results__body d-flex flex-column justify-content-center align-items-center flex-xl-row"
                 id="calcResultContainer">
                <div class="calc-results__price">
                    Итого:<span id="calcPriceContainer"></span>руб.
                </div>
                <div class="calc-results__desc">
                    <ul>
                        <li>Отгрузка:&nbsp; <span id="calcFactoryContainer"></span></li>
                        <li>Расстояние:&nbsp; <span id="calcRoutContainer"></span></li>
                        <li>Место поставки:&nbsp; <span id="calcCoordsContainer"></span></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
