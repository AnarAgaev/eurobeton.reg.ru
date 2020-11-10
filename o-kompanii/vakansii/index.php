<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
?>
    <div class="modal" id="modalVacancy">
        <div class="send-msg-true flex-column justify-content-center align-items-center">
            <h3 class="send-msg-true__title">Сообщение отправлено</h3>
            <span class="send-msg-true__txt">Менеджер свяжется с Вами в ближайшее время.</span>
            <button class="btn" id="btnVacancyClose">Закрыть</button>
        </div>
    </div>
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
<div class="vacancy__subtitle">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 vacancies-txt">
                <?/* Вклчаемая область Текст для страницы Вакансии
                   * include/vacancies-txt.php
                   */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/vacancies-txt.php"
                        )
                    );?>
            </div>
            <div class="col-lg-5">
                <div class="vacancy__subtitle-pic">
                    <?/* Вклчаемая область Картинка для страницы Вакансии
                       * include/vacancies-pic.php
                       */
                    $APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/vacancies-pic.php"
                        )
                    );?>
                </div>
            </div>
        </div>
    </div>
</div>
<?/* Форма заявки на вакансию */
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    "",
    Array(
        "AREA_FILE_SHOW" => "file",
        "AREA_FILE_SUFFIX" => "inc",
        "EDIT_TEMPLATE" => "",
        "PATH" => "/include/form-vacancy.php"
    )
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>