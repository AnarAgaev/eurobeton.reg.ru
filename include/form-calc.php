<div class="calculator">
    <div class="calculator__title d-flex align-items-center justify-content-center">
        РАССЧИТАТЬ ЦЕНУ БЕТОНА С ДОСТАВКОЙ
    </div>
    <form class="form form-calc" enctype="multipart/form-data" method="post">
        <div class="container">
            <div class="form__controls form_place d-flex align-items-lg-end flex-column align-items-start flex-lg-row">
                <div class="form__title">Место доставки и аренда техники</div>
                <label class="label label_w380">
                    <span>Адрес доставки:</span>
                    <input class="input" type="text" placeholder="Россия, Московская область, сельский посёлок Карачиха">
                </label>
                <label class="label">
                    <span class="btn-select-place d-flex justify-content-center align-items-center">
                        <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/select-address.png" alt="Выбрать место на карте">
                        <span>Выбрать адрес на карте</span>
                    </span>
                </label>
                <label class="label label_check d-flex align-items-center">
                    <span>Арендовать бетононасос</span>
                    <input class="input" type="checkbox" value="true" name="takeself" checked>
                    <span class="checker"></span>
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
                    <label class="label label-btn">
                        <span><b>Набрал свыше 300 кубов?</b></span>
                        <a class="btn" href="">спец. предложение</a>
                    </label>
                </div>
                <div class="group-additive">
                    <div class="tglr"><b>Добавки</b>(выберите при необходиости):</div>
                </div>
                <div class="group-two">
                    <label class="label label_w212 label_select">
                        <span>Морозостойкость:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                    <label class="label label_w212 label_select">
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
                    <label class="label label_w212 label_select">
                        <span>Противоморозные доб.:</span>
                        <select class="select">
                            <option value="">Не указана</option>
                            <option>Пункт 1</option>
                            <option>Пункт 2</option>
                            <option>Пункт 3</option>
                        </select>
                    </label>
                </div>
                <div class="btn-form-send d-flex justify-content-center align-items-center">
                    <span>рассчитать стоимость</span>
                </div>
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
</div>
