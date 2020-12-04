<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка");
?>
<?/* Вставка включаемой области Модальные окна на странице с видежетом доставка */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/delivery-calc-modals.php"
    )
);?>
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
    <?/* Вставка включаемой области Калькулятор доставки
       * include/delivery-calc.php
       */
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => "/include/delivery-calc.php"
            )
        );
    ?>
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