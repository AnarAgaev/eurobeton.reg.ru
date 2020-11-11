<div class="request section_container">
    <div class="container">
        <div class="row">
            <div class="request__pic col-lg-4">
                <img class="request-crane"
                     src="<?=DEFAULT_TEMPLATE_PATH?>/img/request-crane.png"
                     alt="">
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
                            "PATH" => "/include/equipment-rental-title.php"
                        )
                    );?>
                </div>
                <div class="request__content request-crane">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/equipment-rental-txt.php"
                        )
                    );?>
                </div>
                <div class="request__btn">
                    <a class="btn" href="/arenda/">подробнее</a>
                </div>
            </div>
        </div>
    </div>
</div>
