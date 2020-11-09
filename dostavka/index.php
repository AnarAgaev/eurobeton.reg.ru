<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
?>
<?$APPLICATION->IncludeComponent(
    "bitrix:breadcrumb",
    "breadcrumbs",
    Array(
        "PATH" => "",
        "SITE_ID" => "s1",
        "START_FROM" => "0"
    )
);?>
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content"><?$APPLICATION->ShowTitle(false)?></h1>
    </div>
</div>
<div class="delivery">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-7">
                <?/* Вставка включаемой области Текст на странице Доставка
                   * include/delivery-txt.php
                   */
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    Array(
                        "AREA_FILE_SHOW" => "file",
                        "AREA_FILE_SUFFIX" => "inc",
                        "EDIT_TEMPLATE" => "",
                        "PATH" => "/include/delivery-txt.php"
                    )
                );?>
            </div>
            <div class="col-lg-6 col-xl-5">
                <div class="delivery__pic">
                    <?/* Вставка включаемой области Картинка на странице Доставка
                       * include/delivery-pic.php
                       */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/delivery-pic.php"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
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
</div>

<?/* Вставка включаемой области Баннер "Получить расчёт стоимости"
   * Внтури родительского контейнера включаемой области /include/request-price.php
   * две дочерние включаемые области /include/request-price-title.php и /include/request-price-txt.php
   * соответственно с заголовком блока и текстом блока
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/request-price.php"
    )
);?>

<?/* Вставка включаемой области "Вопрос ответ"
   * Путь к включаемой области: /include/faq.php
   * Внутри включаемой области компонент список новостей
   * который выводит список пункутов Вопрос-Ответ из инфоблока
   * Инфоблок Вопрос-Ответ: Инфоблоки->Типы инфоблоков->Контент->Вопрос-Ответ
   */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/faq.php"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>