<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вакансии");
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
<form class="form form-interview-wrap" enctype="multipart/form-data" method="post">
    <div class="container">
        <div class="form__controls form_interview d-flex flex-column align-items-start flex-lg-row flex-wrap">
            <div class="form__title">Записать на собеседование</div>
            <label class="label label_w378">
                <span>Фамилии, Имя, Отчество:</span>
                <input class="input control" type="text" placeholder="Иванов Ивановский Иванович">
            </label>
            <label class="label label_w284">
                <span>Дата рождения:</span>
                <input class="input control" type="text" placeholder="01.01.1999">
            </label>
            <label class="label label_w339">
                <span>Телефон:</span>
                <input class="input control" type="text" placeholder="+7 (999) 999-99-99">
            </label>
            <label class="label label_w378">
                <span>Е-mail почта:</span>
                <input class="input control" type="text" placeholder="example@example.com">
            </label>
            <label class="label label_w653">
                <span>На какую должность Вы претендуете в нашей компании:</span>
                <input class="input control" type="text">
            </label>
            <label class="label label_file label_w299">
                <span>Прикрепить анкету соискателя:</span>
                <input id="photo" type="file" class="input">
                <span class="controller control"></span>
                <a class="download" href="">Скачать образец анкеты соискателя</a>
            </label>
            <label class="label label_file label_w175">
                <span>Прикрепить фото:</span>
                <input id="questionaty" type="file" class="input">
                <span class="controller control"></span>
            </label>
            <div class="form__send-wrap d-flex flex-column flex-md-row align-items-md-center">
                <div class="form__send-btn">
                    <button class="btn btn" type="submit">Отправить</button>
                </div>
                <div class="form__send-caption">
                    <span>Нажимая кнопку, вы соглашаетесь с условиями <a href="/">пользовательского соглашения</a> по обработке персональных данных</span>
                </div>
            </div>
        </div>
    </div>
</form>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>