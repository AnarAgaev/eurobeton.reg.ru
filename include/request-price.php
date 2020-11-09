<div class="request section_container">
    <div class="container">
        <div class="row">
            <div class="request__pic col-lg-4">
                <img class="request-men"
                     src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/request-men.png"
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
                            "PATH" => "/include/request-price-title.php"
                        )
                    );?></div>
                <div class="request__content request-men">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/request-price-txt.php"
                        )
                    );?>
                </div>
                <div class="request__btn">
                    <a class="btn show-modal"
                       href=""
                       data-modal-id="modalSetOrder">
                        оставить заявку
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>