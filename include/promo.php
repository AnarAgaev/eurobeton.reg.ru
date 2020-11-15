<div class="promo section_container">
        <div class="container">
            <div class="row d-flex">
                <div class="promo__cards col-xl-4">
                    <a class="promo__card d-flex flex-column justify-content-center align-items-center"
                       href="/proizvodstvo/sertifikaty/">
                        <img class="promo__card__pic" src="<?=DEFAULT_TEMPLATE_PATH;?>/img/certificate.png" alt="" title="">
                        <div class="promo__card__desc">Свидетельства и сертификаты качества</div>
                    </a>
                    <a class="promo__card d-flex flex-column justify-content-center align-items-center" href="/download/dogovor_postavki.docx">
                        <img class="promo__card__pic" src="<?=DEFAULT_TEMPLATE_PATH;?>/img/contract.png" alt="" title="">
                        <div class="promo__card__desc">Договор поставки</div>
                    </a>
                </div>
                <div class="promo__banner col-xl-8">
                    <div class="promo__banner__body">
                        <div class="promo__banner__title"><?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/promo-title.php"
                                )
                            );?></div>
                        <div class="promo__banner__list d-flex"><?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/promo-list.php"
                                )
                            );?></div>
                        <div class="promo__banner__btn">
                            <button class="btn show-modal" data-modal-id="modalSetOrder">
                                консультация с менеджером
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>