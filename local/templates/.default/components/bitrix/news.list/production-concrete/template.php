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
<div class="yandex-modal-map" id="prodMap">
    <button class="yandex-modal-map__btn-close" id="prodMapCloser"></button>
</div>
<div class="concrete">
    <?foreach($arResult["ITEMS"] as $arKey => $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>

        <?if($arKey % 2 !== 0):?>
            <div class="container" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="row concrete__content">
                    <div class="col-xl-5 order-1">
                        <div class="left-side concrete__pic d-flex flex-column align-items-center align-items-xl-start">
                            <ul class="sml-img-slider__list">
                                <?foreach ($arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $key => $arImage):?>
                                    <li class="sml-img-slider__item <?if($key == 0) echo 'front'; if($key == 1) echo 'back';?>">
                                        <a class="sml-img-slider__card"
                                           data-fancybox="prod-concrete-gallery-<?=$arKey?>"
                                           href="<?=$arImage['SRC']?>"
                                           style="background-image: url(<?=$arImage['SRC']?>)">
                                        </a>
                                    </li>
                                <?endforeach;?>
                            </ul>
                            <a class="link concrete__link open-map"
                               data-coord="<?=$arItem['PROPERTIES']['COORDINATES']['VALUE']?>"
                               data-hint-desc="<?=$arItem['PREVIEW_TEXT']?>">
                                Показать на карте
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 order-xl-2">
                        <div class="concrete__title"><?=$arItem['PREVIEW_TEXT']?></div>
                        <div class="concrete__description"><?=$arItem['DETAIL_TEXT']?></div>
                    </div>
                </div>
            </div>
        <?else:?>
            <div class="container" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="row concrete__content">
                    <div class="col-xl-7">
                        <div class="concrete__title"><?=$arItem['PREVIEW_TEXT']?></div>
                        <div class="concrete__description"><?=$arItem['DETAIL_TEXT']?></div>
                    </div>
                    <div class="col-xl-5 order-1">
                        <div class="right-side concrete__pic d-flex flex-column align-items-center align-items-xl-end">
                            <ul class="sml-img-slider__list">
                                <?foreach ($arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $key => $arImage):?>
                                    <li class="sml-img-slider__item <?if($key == 0) echo 'front'; if($key == 1) echo 'back';?>">
                                        <a class="sml-img-slider__card"
                                           data-fancybox="prod-concrete-gallery-<?=$arKey?>"
                                           href="<?=$arImage['SRC']?>"
                                           style="background-image: url(<?=$arImage['SRC']?>)">
                                        </a>
                                    </li>
                                <?endforeach;?>
                            </ul>
                            <a class="link concrete__link open-map"
                               data-coord="<?=$arItem['PROPERTIES']['COORDINATES']['VALUE']?>"
                               data-hint-desc="<?=$arItem['PREVIEW_TEXT']?>">
                                Показать на карте
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?endif;?>
    <?endforeach;?>
</div>
