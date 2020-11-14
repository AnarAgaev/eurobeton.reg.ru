<div class="container section_container">
    <div class="row">
        <div class="col-xl-5 calc__wrap">
            <div class="calc">
                <h5 class="calc__title">Автоматизированная система расчёта стоимости доставки</h5>
                <form class="form calc__nums d-flex flex-column align-items-start">
                    <label class="label label_value">
                        <span>Количество(куб.м.)</span>
                        <span class="value-checker">
                                <span class="value-checker__btn value-checker__btn_minus"></span>
                                <input type="text" value="0" readonly="" class="input">
                                <span class="value-checker__btn value-checker__btn_plus"></span>
                            </span>
                    </label>
                    <label class="label label_w284 label_address">
                        <span>Адрес доставки:</span>
                        <input type="text" class="input" placeholder="Россия, Московская область, городской">
                    </label>
                    <button class="btn" type="submit">рассчитать</button>
                </form>


                <!-- !!! Заглушка до момнета деплоя рабочей версии калькулятора. После тестрирования на продакшене нужно удалить -->
                <div class="temporary-plug d-flex justify-content-center align-items-center flex-column">
                    <h4 style="padding: 0 50px;">Скоро зедсь будет новый и удобный калькулятор доставки.<br><br>А пока, если у Вас есть вопросы, их можно здалть менеджеру.</h4>
                    <button class="btn show-modal" data-modal-id="modalSetOrder">Вопрос менеджеру</button>
                </div>


            </div>
        </div>
        <div class="col-xl-7 map__wrap">
            <div id="deliveryMap"></div>
        </div>
    </div>
</div>
