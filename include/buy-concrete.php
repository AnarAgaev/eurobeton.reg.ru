<div class="request section_container">
    <div class="container">
        <div class="row">
            <div class="request__pic col-lg-4">
                <img class="request-car"
                     src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/request-car.png"
                     alt=""
                     title="">
            </div>
            <div class="request__desc col-lg-8">
                <div class="request__title">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/buy-concrete-title.php"
                        )
                    );?>
                </div>
                <div class="request__content request-car">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/buy-concrete-txt.php"
                        )
                    );?>
                </div>
                <div class="request__btn">
                    <a href="/#calc-link-target" class="btn">
                        РАССЧИТАТЬ
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
