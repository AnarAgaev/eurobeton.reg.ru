<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>
<div class="page-index">
    <div class="billboard section_container">
        <div class="container">
            <div class="row">
                <div class="billboard__desc col-lg-7 col-xl-6">
                    <div class="billboard__title">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/banner-title.php"
                            )
                        ); ?>
                    </div>
                    <div class="billboard__txt">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/bunner-subtitle.php"
                            )
                        ); ?>
                    </div>
                    <div class="billboard__btn"><a class="btn" href="">консультация</a></div>
                </div>
                <div class="billboard__pic col-lg-5 col-xl-6">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/banner-picture.php"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>


    <!--<div class="offers section_container">
        <div class="container">
            <div class="row">
                <div class="offers__card-wrap col-xl-6 d-flex justify-content-center">
                    <div class="offers__card"><a class="card-body offers__card-body" href="">
                            <div class="offers__caption">АРЕНДА</div>
                            <div class="offers__title">Аренда спецтехники</div>
                            <div class="offers__txt">Аренда бетононасосов и кранов в Москве и Московской области</div>
                            <div class="offers__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/offers-1.png" alt="" title=""></div>
                        </a></div>
                </div>
                <div class="offers__card-wrap col-xl-6 d-flex justify-content-center">
                    <div class="offers__card"><a class="card-body offers__card-body" href="">
                            <div class="offers__caption">РАСЧЕТ ДОСТАВКИ БЕТОНА ОНЛАЙН</div>
                            <div class="offers__title">Купить бетон с доставкой</div>
                            <div class="offers__txt">Купить бетон с доставкой по Москве и области</div>
                            <div class="offers__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/offers-2.png" alt="" title=""></div>
                        </a></div>
                </div>
                <div class="offers__card-wrap col-xl-6 d-flex justify-content-center">
                    <div class="offers__card"><a class="card-body offers__card-body" href="">
                            <div class="offers__caption">СОБСТВЕННАЯ ЛАБОРАТОРИЯ</div>
                            <div class="offers__title">Выпуск бетона в соответствии с ГОСТ</div>
                            <div class="offers__txt">Наша лаборатория предоставляет широкий спектр лабораторного
                                сопровождения объектов
                            </div>
                            <div class="offers__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/offers-3.png" alt="" title=""></div>
                        </a></div>
                </div>
                <div class="offers__card-wrap col-xl-6 d-flex justify-content-center">
                    <div class="offers__card"><a class="card-body offers__card-body" href="">
                            <div class="offers__caption">тендеры</div>
                            <div class="offers__title">Тендеры на поставку</div>
                            <div class="offers__txt">АО «ЕВРОБЕТОН» объявляет конкурс на поставку в 1 квартале 2018 г.</div>
                            <div class="offers__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/offers-4.png" alt="" title=""></div>
                        </a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="calculator section_container">
        <div class="calculator">
            <div class="calculator__title d-flex align-items-center justify-content-center">РАССЧИТАТЬ ЦЕНУ БЕТОНА С
                ДОСТАВКОЙ
            </div>
            <form class="form" enctype="multipart/form-data" method="post">
                <div class="container">
                    <div class="form__controls form_place d-flex align-items-lg-end flex-column align-items-start flex-lg-row">
                        <div class="form__title">Место и время доставки</div>
                        <label class="label label_w380"><span>Адрес доставки:</span><input type="text"
                                                                                           placeholder="Россия, Московская область, сельский посёлок Карачиха"></label><label
                                class="label label_w212"><span>Дата доставки:</span><input type="text"
                                                                                           placeholder="Не указана"></label><label
                                class="label label_check d-flex align-items-center"><span>Самовывоз</span><input
                                    type="checkbox" value="true" name="takeself" checked><span
                                    class="checker"></span></label><label
                                class="label label_w205"><span>Выберите завод:</span><input type="text"
                                                                                            placeholder="Не указан"></label>
                    </div>
                    <div class="form__controls form_parametrs">
                        <div class="form__title">Основные параметры бетона:</div>
                        <div class="group-one"><label class="label label_w380 label_select"><span>Марка:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label
                                    class="label label_w212 label_select"><span>Прочность (кгс/см<sup>2</sup>):</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label class="label label_w245 label_select"><span>Наполнитель:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label class="label label_value"><span>Объём (м<sup>3</sup>):</span><span
                                        class="value-checker"><span
                                            class="value-checker__btn value-checker__btn_minus"></span><input type="text" value="0"
                                                                                                              readonly><span
                                            class="value-checker__btn value-checker__btn_plus"></span></span></label></div>
                        <div class="group-additive">
                            <div class="tglr"><b>Добавки</b>(выберите при необходиости):</div>
                        </div>
                        <div class="group-two"><label
                                    class="label label_w179 label_select"><span>Морозостойкость:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label class="label label_w174 label_select"><span>Подвижность:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label
                                    class="label label_w212 label_select"><span>Водонепроницаемость:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label class="label label_w179 label_select"><span>Противоморозные доб.:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label><label class="label label_w205 label_select"><span>Фибра:</span><select>
                                    <option value="">Не указана</option>
                                    <option>Пункт 1</option>
                                    <option>Пункт 2</option>
                                    <option>Пункт 3</option>
                                </select></label></div>
                        <div class="btn-form-send"><span>добавить товар</span></div>
                    </div>
                    <div class="form_comments d-flex justify-content-between flex-wrap">
                        <div class="d-flex flex-column wrapper flex-xl-row">
                            <div class="form_comments-text">
                                <div class="title">Комментарий к заказу:</div>
                                <textarea placeholder="Начните вводить ..."></textarea></div>
                            <div class="form_comments-technics">
                                <div class="title">Аренда техники:</div>
                                <label class="label label_check d-flex align-items-center"><span>Бетононасос</span><input
                                            type="checkbox" value="true" name="pump" checked><span
                                            class="checker"></span></label><label
                                        class="label label_check d-flex align-items-center"><span>Кран</span><input
                                            type="checkbox" value="true" name="crane"><span class="checker"></span></label>
                            </div>
                        </div>
                        <div class="form_comments-offer d-flex flex-column align-items-center">
                            <div class="title"><b>Набрал свыше 300 кубов?</b>Тогда получай</div>
                            <a class="btn" href="">Персональное предложение</a></div>
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
    </div>
    <div class="prices section_container">
        <div class="container">
            <div class="prices__title section_title">Лучшие предложения</div>
            <div class="prices__link"><a href="/">Перейти в каталог</a></div>
            <div class="prices__slider">
                <div class="slider">
                    <div class="slider__controller slider__controller_left slider-controller-left"></div>
                    <div class="slider__controller slider__controller_right slider-controller-right"></div>
                    <div class="slider__viewport">
                        <div class="slider__list d-flex">
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center">
                                <div class="prices__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/prices-pic.jpg')"></div>
                                <div class="prices__caption">БЕТОН</div>
                                <div class="prices__desc">М 100 В7.5 П2-П4 F50 W2</div>
                                <div class="prices__price">от<span>3000</span>руб./м<sup>2</sup></div>
                                <div class="prices__btn"><a class="btn" href="/">ПОДРОБНЕЕ</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="advantages section_container">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-3 advantages__card-wrap">
                    <div class="advantages__card d-flex flex-column justify-content-center align-items-center">
                        <div class="advantages__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/advantages-1.png" alt="" title=""></div>
                        <div class="advantages__desc px-5">Собственная сырьевая база</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 advantages__card-wrap">
                    <div class="advantages__card d-flex flex-column justify-content-center align-items-center">
                        <div class="advantages__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/advantages-2.png" alt="" title=""></div>
                        <div class="advantages__desc px-5">Высококачественное сырье</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 advantages__card-wrap">
                    <div class="advantages__card d-flex flex-column justify-content-center align-items-center">
                        <div class="advantages__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/advantages-3.png" alt="" title=""></div>
                        <div class="advantages__desc">Собственная испытательная лаборатория</div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3 advantages__card-wrap">
                    <div class="advantages__card d-flex flex-column justify-content-center align-items-center">
                        <div class="advantages__pic"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/advantages-4.png" alt="" title=""></div>
                        <div class="advantages__desc px-5">Тотальный контроль производства</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="map section_container">
        <div class="map__title px-5 section_title">Собственные заводы</div>
        <div class="map__body" id="map"></div>
    </div>
    <div class="partners section_container">
        <div class="container">
            <div class="partners__title section_title">Наши партнеры</div>
            <div class="partners__slider">
                <div class="slider">
                    <div class="slider__controller slider__controller_left slider-controller-left"></div>
                    <div class="slider__controller slider__controller_right slider-controller-right"></div>
                    <div class="slider__viewport">
                        <div class="slider__list d-flex">
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/PSE_Engineering_Gmb.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/Liebherr.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/teka.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/schwing_stetter.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/PSE_Engineering_Gmb.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/Liebherr.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/teka.jpg" alt="" title=""></div>
                            <div class="slider__item"><img src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/schwing_stetter.jpg" alt="" title=""></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="request section_container">
        <div class="container">
            <div class="row">
                <div class="request__pic col-lg-4"><img class="request-men" src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/request-men.png" alt="" title="">
                </div>
                <div class="request__desc col-lg-8">
                    <div class="request__title">ПОЛУЧИТЬ РАСЧЕТ СТОИМОСТИ</div>
                    <div class="request__content request-men">Наш менеджер поможет Вам с выбором и рассчитает цену
                        бетона с доставкой
                    </div>
                    <div class="request__btn"><a class="btn btn-modal" href="" data-modal-id="modalSetOrder">оставить
                            заявку</a></div>
                </div>
            </div>
        </div>
    </div>
    <div class="promo section_container">
        <div class="container">
            <div class="row d-flex">
                <div class="promo__cards col-xl-4"><a
                            class="promo__card d-flex flex-column justify-content-center align-items-center" href="/"><img
                                class="promo__card__pic" src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/certificate.png" alt="" title="">
                        <div class="promo__card__desc">Свидетельства и сертификаты качества</div>
                    </a><a class="promo__card d-flex flex-column justify-content-center align-items-center" href="/"><img
                                class="promo__card__pic" src="<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/contract.png" alt="" title="">
                        <div class="promo__card__desc">Договор поставки</div>
                    </a></div>
                <div class="promo__banner col-xl-8">
                    <div class="promo__banner__body">
                        <div class="promo__banner__title">Сеть бетонных заводов 10 лет на рынке Москвы и МО</div>
                        <div class="promo__banner__list d-flex">
                            <div class="promo__banner__wrap d-flex flex-column"><a class="promo__banner__item" href="">7
                                    современных заводов</a><a class="promo__banner__item" href="">5 производственных баз</a>
                            </div>
                            <div class="promo__banner__wrap d-flex flex-column"><a class="promo__banner__item" href="">10
                                    млн. кубометров в год. совокупная мощность</a><a class="promo__banner__item" href="">Собственная
                                    лаборатория</a></div>
                        </div>
                        <div class="promo__banner__btn"><a class="btn" href="">консультация с менеджером</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="all-news"><a href="">Все новости</a></div>
    </div>
    <div class="container news-list">
        <div class="row news-list__wrap">
            <div class="col-md-6 col-xl-3 d-flex justify-content-center"><a class="news-list__card" href="">
                    <div class="news-list__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/news1.jpg');"></div>
                    <div class="news-list__desc">
                        <div class="news-list__date">05 Сентября 2019</div>
                        <div class="news-list__caption">Противоморозные добавки в бетон</div>
                    </div>
                </a></div>
            <div class="col-md-6 col-xl-3 d-flex justify-content-center"><a class="news-list__card" href="">
                    <div class="news-list__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/news2.jpg');"></div>
                    <div class="news-list__desc">
                        <div class="news-list__date">30 Августа 2019</div>
                        <div class="news-list__caption">Цементное молочко</div>
                    </div>
                </a></div>
            <div class="col-md-6 col-xl-3 d-flex justify-content-center"><a class="news-list__card" href="">
                    <div class="news-list__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/news3.jpg');"></div>
                    <div class="news-list__desc">
                        <div class="news-list__date">02 Августа 2019</div>
                        <div class="news-list__caption">Бетон в дизайне</div>
                    </div>
                </a></div>
            <div class="col-md-6 col-xl-3 d-flex justify-content-center"><a class="news-list__card" href="">
                    <div class="news-list__pic" style="background-image: url('<?/*= DEFAULT_TEMPLATE_PATH; */?>/img/news4.jpg');"></div>
                    <div class="news-list__desc">
                        <div class="news-list__date">17 Июня 2019</div>
                        <div class="news-list__caption">Фундаменты и их виды</div>
                    </div>
                </a></div>
        </div>
    </div>-->
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>