<div class="modal d-flex justify-content-end align-items-start" id="cartModal">
    <div class="send-msg-true flex-column justify-content-center align-items-center" id="msgSetOrderTrue">
        <h3 class="send-msg-true__title">Заказ оформлен</h3>
        <span class="send-msg-true__txt">Менеджер свяжется с Вами в ближайшее время.</span>
        <button class="btn" id="btnSetOrderClose">Закрыть</button>
    </div>

    <div class="cart-modal__dialog d-flex flex-column" id="cartModalDialog">
        <div class="cart-modal__header d-flex flex-column justify-content-center">
            <h4 class="cart-modal__title">Корзина</h4>
            <div class="cart-modal__close" id="cartModalClose"></div>
        </div>
        <?
            // Получаем данные корзины зи Сессии
            $SESSION_CART = \Bitrix\Main\Application::getInstance()->getSession();
            $SESSION_CART_PRODUCTS = json_decode($SESSION_CART['cart'], true)['items'];
            $SESSION_CONCRETE = $SESSION_CART_PRODUCTS['concrete']; // бетон
            $SESSION_CRUSHED_STONE = $SESSION_CART_PRODUCTS['crushedStone']; // щебень
            $SESSION_MINERAL_POWDER = $SESSION_CART_PRODUCTS['mineralPowder']; // минеральный порош
            $SESSION_LIMESTONE_FLOUR = $SESSION_CART_PRODUCTS['limestoneFlour']; // известняковая мука
            $RESULT_CART_PRICE = 0;

            // Смотрим есть ли в корзине какие-нибудь товары
            $IS_ITEMS = false;
            foreach ($SESSION_CART_PRODUCTS as $arItem) {
                if (count($arItem)) {
                    $IS_ITEMS = true;
                    break;
                }
            }
        ?>

        <div class="cart-modal__body <?if(!$IS_ITEMS) echo 'hidden';?>" id="cartModalBody">
            <ul class="cart-modal__list d-flex flex-column" id="cartItemsConcrete">
                <?foreach($SESSION_CONCRETE as $key => $arItem):?>
                    <li class="cart-modal__item" data-product-type="<?=$arItem['product-type'];?>" data-pruduct-id="<?=$key?>">
                        <span class="cart-modal__item__delete" title="Удалить товар из корзины"></span>
                        <div class="cart-modal__item__title"><?=$arItem['product-name'];?></div>
                        <div class="cart-modal__item__content d-flex flex-column align-items-start flex-sm-row align-items-sm-center">
                            <span class="cart-modal__item__pic mb-3 mb-sm-0" style="background-image: url(<?=$arItem['product-pic-src'];?>);"></span>
                            <ul class="cart-modal__item__props mb-1 mb-sm-0">
                                <li class="cart-modal__item__value">Количество: <?=$arItem['product-value'];?> куб.м.</li>
                                <li class="cart-modal__item__product-price">Цена товара: <?=$arItem['product-price'];?> руб.</li>
                                <li class="cart-modal__item__delivery-price">Стоимость доставки: <?=$arItem['delivery-price'];?> руб.</li>
                            </ul>
                            <div class="cart-modal__item__result-price d-flex flex-row align-items-baseline flex-sm-column">
                                <span class="pr-1 pr-sm-0">Итоговая цена:</span>
                                <span class="num"><?=$arItem['final-price'];?> руб.</span>
                            </div>
                        </div>
                        <div class="cart-modal__item__inform d-flex flex-column">
                            <div class="cart-modal__item__inform-title">
                                <span class="controller"></span>
                                Дополнительная информация
                            </div>
                            <div class="cart-modal__item__inform-body">
                                <p class="mb-0">
                                    <b>Характеристики:</b> <?=$arItem['product-description'];?><br>
                                    <b>Место отгрузки: </b> <?
                                    $FROM_FACTORY_ID = $arItem['optimal-factory-id'];
                                    $FROM_FACTORY = json_decode($arItem['factories'], true)[$FROM_FACTORY_ID];
                                    echo $FROM_FACTORY['name'];?><br>
                                    <b>Место поставки:</b> <?=$arItem['delivery-address'];?><br>
                                    <b>Расстояние доставки:</b> <?=$arItem['route-length'];?> км.
                                </p>
                            </div>
                        </div>
                    </li>
                    <?$RESULT_CART_PRICE += floatval($arItem['final-price']);?>
                <?endforeach;?>
            </ul>
            <ul class="cart-modal__list d-flex flex-column" id="cartItemsCrushedStone">
                <?foreach($SESSION_CRUSHED_STONE as $key => $arItem):?>
                    <li class="cart-modal__item" data-product-type="<?=$arItem['product-type'];?>" data-pruduct-id="<?=$key?>">
                        <span class="cart-modal__item__delete" title="Удалить товар из корзины"></span>
                        <div class="cart-modal__item__title"><?=$arItem['product-name'];?></div>
                        <div class="cart-modal__item__content d-flex flex-column align-items-start flex-sm-row align-items-sm-center">
                            <span class="cart-modal__item__pic mb-3 mb-sm-0" style="background-image: url(<?=$arItem['product-pic-src'];?>);"></span>
                            <ul class="cart-modal__item__props mb-1 mb-sm-0">
                                <li class="cart-modal__item__value">Количество: <?=$arItem['product-value'];?> куб.м.</li>
                                <li class="cart-modal__item__product-price">Цена товара: <?=$arItem['product-price'];?> руб.</li>
                                <li class="cart-modal__item__delivery-price">Стоимость доставки: <?=$arItem['delivery-price'];?> руб.</li>
                            </ul>
                            <div class="cart-modal__item__result-price d-flex flex-row align-items-baseline flex-sm-column">
                                <span class="pr-1 pr-sm-0">Итоговая цена:</span>
                                <span class="num"><?=$arItem['final-price'];?> руб.</span>
                            </div>
                        </div>
                        <div class="cart-modal__item__inform d-flex flex-column">
                            <div class="cart-modal__item__inform-title">
                                <span class="controller"></span>
                                Дополнительная информация
                            </div>
                            <div class="cart-modal__item__inform-body">
                                <p class="mb-0">
                                    <b>Характеристики:</b> <?=$arItem['product-description'];?><br>
                                    <b>Место отгрузки: </b> <?
                                    $FROM_FACTORY_ID = $arItem['optimal-factory-id'];
                                    $FROM_FACTORY = json_decode($arItem['factories'], true)[$FROM_FACTORY_ID];
                                    echo $FROM_FACTORY['name'];?><br>
                                    <b>Место поставки:</b> <?=$arItem['delivery-address'];?><br>
                                    <b>Расстояние доставки:</b> <?=$arItem['route-length'];?> км.
                                </p>
                            </div>
                        </div>
                    </li>
                    <?$RESULT_CART_PRICE += floatval($arItem['final-price']);?>
                <?endforeach;?>
            </ul>
            <ul class="cart-modal__list d-flex flex-column" id="cartItemsMineralPowder">
                <?foreach($SESSION_MINERAL_POWDER as $key => $arItem):?>
                    <li class="cart-modal__item" data-product-type="<?=$arItem['product-type'];?>" data-pruduct-id="<?=$key?>">
                        <span class="cart-modal__item__delete" title="Удалить товар из корзины"></span>
                        <div class="cart-modal__item__title"><?=$arItem['product-name'];?></div>
                        <div class="cart-modal__item__content d-flex flex-column align-items-start flex-sm-row align-items-sm-center">
                            <span class="cart-modal__item__pic mb-3 mb-sm-0" style="background-image: url(<?=$arItem['product-pic-src'];?>);"></span>
                            <ul class="cart-modal__item__props mb-1 mb-sm-0">
                                <li class="cart-modal__item__value">Количество: <?=$arItem['product-value'];?> куб.м.</li>
                                <li class="cart-modal__item__product-price">Цена товара: <?=$arItem['product-price'];?> руб.</li>
                                <li class="cart-modal__item__delivery-price">Стоимость доставки: <?=$arItem['delivery-price'];?> руб.</li>
                            </ul>
                            <div class="cart-modal__item__result-price d-flex flex-row align-items-baseline flex-sm-column">
                                <span class="pr-1 pr-sm-0">Итоговая цена:</span>
                                <span class="num"><?=$arItem['final-price'];?> руб.</span>
                            </div>
                        </div>
                        <div class="cart-modal__item__inform d-flex flex-column">
                            <div class="cart-modal__item__inform-title">
                                <span class="controller"></span>
                                Дополнительная информация
                            </div>
                            <div class="cart-modal__item__inform-body">
                                <p class="mb-0">
                                    <b>Место отгрузки: </b> <?
                                    $FROM_FACTORY_ID = $arItem['optimal-factory-id'];
                                    $FROM_FACTORY = json_decode($arItem['factories'], true)[$FROM_FACTORY_ID];
                                    echo $FROM_FACTORY['name'];?><br>
                                    <b>Место поставки:</b> <?=$arItem['delivery-address'];?><br>
                                    <b>Расстояние доставки:</b> <?=$arItem['route-length'];?> км.
                                </p>
                            </div>
                        </div>
                    </li>
                    <?$RESULT_CART_PRICE += floatval($arItem['final-price']);?>
                <?endforeach;?>
            </ul>
            <ul class="cart-modal__list d-flex flex-column" id="cartItemsLimestoneFlour">
                <?foreach($SESSION_LIMESTONE_FLOUR as $key => $arItem):?>
                    <li class="cart-modal__item" data-product-type="<?=$arItem['product-type'];?>" data-pruduct-id="<?=$key?>">
                        <span class="cart-modal__item__delete" title="Удалить товар из корзины"></span>
                        <div class="cart-modal__item__title"><?=$arItem['product-name'];?></div>
                        <div class="cart-modal__item__content d-flex flex-column align-items-start flex-sm-row align-items-sm-center">
                            <span class="cart-modal__item__pic mb-3 mb-sm-0" style="background-image: url(<?=$arItem['product-pic-src'];?>);"></span>
                            <ul class="cart-modal__item__props mb-1 mb-sm-0">
                                <li class="cart-modal__item__value">Количество: <?=$arItem['product-value'];?> куб.м.</li>
                                <li class="cart-modal__item__product-price">Цена товара: <?=$arItem['product-price'];?> руб.</li>
                                <li class="cart-modal__item__delivery-price">Стоимость доставки: <?=$arItem['delivery-price'];?> руб.</li>
                            </ul>
                            <div class="cart-modal__item__result-price d-flex flex-row align-items-baseline flex-sm-column">
                                <span class="pr-1 pr-sm-0">Итоговая цена:</span>
                                <span class="num"><?=$arItem['final-price'];?> руб.</span>
                            </div>
                        </div>
                        <div class="cart-modal__item__inform d-flex flex-column">
                            <div class="cart-modal__item__inform-title">
                                <span class="controller"></span>
                                Дополнительная информация
                            </div>
                            <div class="cart-modal__item__inform-body">
                                <p class="mb-0">
                                    <b>Место отгрузки: </b> <?
                                    $FROM_FACTORY_ID = $arItem['optimal-factory-id'];
                                    $FROM_FACTORY = json_decode($arItem['factories'], true)[$FROM_FACTORY_ID];
                                    echo $FROM_FACTORY['name'];?><br>
                                    <b>Место поставки:</b> <?=$arItem['delivery-address'];?><br>
                                    <b>Расстояние доставки:</b> <?=$arItem['route-length'];?> км.
                                </p>
                            </div>
                        </div>
                    </li>
                    <?$RESULT_CART_PRICE += floatval($arItem['final-price']);?>
                <?endforeach;?>
            </ul>
            <form class="form cart-modal__form d-flex flex-wrap"
                  action="/utils/handle-set-order.php"
                  method="POST"
                  enctype="multipart/form-data"
                  id="formCart">
                <div class="cart-modal__form-caption">Контактная информация</div>
                <div class="cart-modal__from-controls d-flex flex-wrap">
                    <label class="label label_w345">
                        <span>Наименование компании</span>
                        <input class="input"
                               type="text"
                               name="name"
                               placeholder="Моя компания"
                               id="formCartName">
                        <span class="err__msg"></span>
                    </label>
                    <label class="label label_w205">
                        <span>Дата доставки</span>
                        <input class="input"
                               type="text"
                               placeholder="01.01.2020"
                               name="date"
                               id="formCartDate">
                        <span class="err__msg"></span>
                    </label>
                    <label class="label label_w345">
                        <span>E-mail</span>
                        <input class="input"
                               type="text"
                               placeholder="example@example.com"
                               name="email"
                               id="formCartMail">
                        <span class="err__msg"></span>
                    </label>
                    <label class="label label_w205">
                        <span>Телефон</span>
                        <input class="input"
                               type="text"
                               placeholder="+7 (999) 999-99-99"
                               name="phone"
                               id="formCartPhone">
                        <span class="err__msg"></span>
                    </label>
                    <label class="label label-comment">
                        <span>Комментарий к заказу</span>
                        <textarea class="textarea"
                                  placeholder="Начните вводить ..."
                                  name="comment"
                                  id="formCartMsg"></textarea>
                        <span class="err__msg"></span>
                    </label>
                </div>
            </form>
        </div>
        <div class="cart-modal__footer d-flex flex-column <?if(!$IS_ITEMS) echo 'hidden';?>"  id="cartModalFooter">
            <div class="cart-modal__result d-flex flex-column">
                <div class="cart-modal__result-price">
                    Итого:<span id="finalCartPriceContainer"><?=number_format(round($RESULT_CART_PRICE, 2), 2, '.', '')?></span>руб.
                </div>
                <div class="cart-modal__result-comment">
                    С учётом всех товаров, их количества и доставки.
                </div>
            </div>
            <div class="cart-modal__action d-flex flex-column justify-content-center align-items-center flex-md-row">
                <button class="btn mb-3 mb-md-0 mr-md-4" type="submit" form="formCart">
                    оформить заказ
                </button>
                <div class="cart-modal__agreement">
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

        <div class="cart-modal__body <?if($IS_ITEMS) echo 'hidden';?>" id="noProductsMsg">
            <h3 class="cart-modal__section-title">
                <b>Ваша корзина пуста</b><br>
                Выберите в каталоге интересующий
                товар и добавьте его в Корзину.
            </h3>
            <div class="cart-modal__section-cards d-flex flex-column">
                <a href="/produktsiya/beton/" class="products-list__item d-flex flex-column flex-sm-row">
                    <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                        <img src="/local/templates/.default/img/products-list-pic1.png" alt="">
                    </div>
                    <div class="products-list__item-body">
                        <div class="products-list__item-title">Бетон</div>
                        <div class="products-list__item-caption">
                            <span>Товарный бетон</span>
                            <span>Пескобетон</span>
                            <span>Растворы цементно - Песчаные</span>
                        </div>
                    </div>
                </a>
                <a href="/produktsiya/shcheben/" class="products-list__item d-flex flex-column flex-sm-row">
                    <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                        <img src="/local/templates/.default/img/products-list-pic2.png" alt="">
                    </div>
                    <div class="products-list__item-body">
                        <div class="products-list__item-title">Щебень</div>
                        <div class="products-list__item-caption">
                            <span>Гранитный 5-20, 20-40, 25-60, 40-70</span>
                            <span>Доломитовый</span>
                        </div>
                    </div>
                </a>
                <a href="/produktsiya/mineralnyy-poroshok/" class="products-list__item d-flex flex-column flex-sm-row">
                    <div class="products-list__item-pic order-sm-1 d-flex justify-content-center align-items-center flex-grow-1">
                        <img src="/local/templates/.default/img/products-list-pic3.png" alt="">
                    </div>
                    <div class="products-list__item-body">
                        <div class="products-list__item-title">Минеральный порошок</div>
                        <div class="products-list__item-caption">
                            <span>Известняковая мука</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>