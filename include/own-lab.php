<div class="request section_container">
    <div class="container">
        <div class="row">
            <div class="request__pic col-lg-4">
                <img class="request-lab"
                     src="<?= DEFAULT_TEMPLATE_PATH; ?>/img/request-lab.png"
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
                            "PATH" => "/include/own-lab-title.php"
                        )
                    );?></div>
                <div class="request__content request-lab">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => "/include/own-lab-txt.php"
                        )
                    );?>
                </div>
                <div class="request__btn">
                    <button class="btn show-modal" data-modal-id="modalSetOrder">
                        узнать больше
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>