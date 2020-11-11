<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="mineral-powder">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 image__wrap">
                <div class="image" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>)"></div>
            </div>
            <div class="col-xl-6 specifications__wrap">
                <div class="specifications">
                    <?=$arResult["PROPERTIES"]["MINERAL_POWDER_DESCRIPTION"]["~VALUE"]["TEXT"]?>
                </div>
            </div>
            <div class="col-xl-6 description__wrap">
                <div class="description">
                    <div class="description__content">
                        <?=$arResult["~DETAIL_TEXT"]?>
                    </div>
                    <div class="description__toggler">Развернуть</div>
                </div>
            </div>
            <div class="col-xl-6 actions__wrap">
                <div class="actions">
                    <div class="actions__price">Стоимость:
                        <span>
                            <?if($arResult["PROPERTIES"]["PRICE_MINIMUM"]["VALUE"]) echo 'от ';?>
                            <?=$arResult["PROPERTIES"]["PRICE"]["VALUE"]?> руб.
                        </span>
                    </div>
                    <div class="actions__btns d-flex flex-column align-items-center flex-xl-row align-items-xl-start">
                        <div class="actions__txt">
                            <a class="btn show-modal"
                               data-modal-id="modalSetOrder">
                                рассчитать полную стоимость
                            </a>
                            <div class="actions__comment">
                                <div class="footnote">Без транспортных услуг</div>
                            </div>
                        </div>
                        <div class="btn-call">
                            <?/* Вставка включаемой области Зделать звонок.
                               * Разсположена на всехкарточках товара.
                               * Лежит по пути /include/btn-call.php
                               */
                            $APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => "/include/btn-call.php"
                                )
                            );?>
                        </div>
                    </div>
                    <div class="actions__offer d-flex flex-column align-items-center flex-xl-row justify-content-between">
                        <span><b>Нужно свыше 300 тонн?</b> Тогда нажимай!</span>
                        <a class="btn show-modal"
                           href=""
                           data-modal-id="modalSetOrder">
                            Персональное предложение
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>