<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Контакты");?>
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
<div class="contacts">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-5 contacts__description-wrap">
                <div class="contacts__description">
                    <h4 class="contacts__title">
                        <?/* Вклчаемая область Заголовок информационного блока на странице контакты */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/contacts-title.php"
                            )
                        );?></h4>
                    <p class="contacts__addres">
                        <?/* Вклчаемая область Почтоный адрес блока на странице контакты */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/contacts-post.php"
                            )
                        );?>
                    </p>
                    <p class="contacts__mail">
                        <?/* Вклчаемая область Адрес электронной почты блока на странице контакты */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/contacts-mail.php"
                            )
                        );?>
                    </p>
                    <p class="contacts__sales">
                        <?/* Вклчаемая область Отдел продаж блока на странице контакты */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/contacts-sales.php"
                            )
                        );?>
                    </p>
                    <p class="contacts__support">
                        <?/* Вклчаемая область Центральная диспетчерская блока на странице контакты */
                        $APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => "/include/contacts-support.php"
                            )
                        );?>
                    </p>
                    <a class="btn contacts__btn" href="/">Реквизиты АО «ЕВРОБЕТОН»</a>
                </div>
            </div>
            <div class="col-xl-5 contacts__map-wrap">
                <div class="contacts__map" id="contactsMap"></div>
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