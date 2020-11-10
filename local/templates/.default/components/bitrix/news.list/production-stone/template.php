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
<div class="breakstone">
    <?foreach($arResult["ITEMS"] as $arKey => $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="section" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="container">
                <div class="row breakstone__content">
                    <?if($arKey % 2 !== 0):?>
                        <div class="col-xl-5 order-1">
                            <div class="left-side breakstone__pic d-flex flex-column align-items-center align-items-xl-start">
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
                                <a class="link breakstone__link open-map"
                                   data-coord="<?=$arItem['PROPERTIES']['COORDINATES']['VALUE']?>"
                                   data-hint-desc="<?=$arItem['PREVIEW_TEXT']?>">
                                    Показать на карте
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-7 order-xl-2">
                            <div class="breakstone__title"><?=$arItem['PREVIEW_TEXT']?></div>
                            <div class="breakstone__description"><?=$arItem['DETAIL_TEXT']?></div>
                        </div>
                    <?else:?>
                        <div class="col-xl-7">
                            <div class="breakstone__title"><?=$arItem['PREVIEW_TEXT']?></div>
                            <div class="breakstone__description"><?=$arItem['DETAIL_TEXT']?></div>
                        </div>
                        <div class="col-xl-5 order-1">
                            <div class="right-side breakstone__pic d-flex flex-column align-items-center align-items-xl-end">
                                <ul class="sml-img-slider__list">
                                    <?foreach ($arItem['DISPLAY_PROPERTIES']['GALLERY']['FILE_VALUE'] as $key => $arImage):?>
                                        <li class="sml-img-slider__item <?if($key == 0) echo 'front'; if($key == 1) echo 'back';?>">
                                            <a class="sml-img-slider__card"
                                               data-fancybox="prod-stone-gallery-<?=$arKey?>"
                                               href="<?=$arImage['SRC']?>"
                                               style="background-image: url(<?=$arImage['SRC']?>)">
                                            </a>
                                        </li>
                                    <?endforeach;?>
                                </ul>
                                <a class="link breakstone__link open-map"
                                   data-coord="<?=$arItem['PROPERTIES']['COORDINATES']['VALUE']?>"
                                   data-hint-desc="<?=$arItem['PREVIEW_TEXT']?>">
                                    Показать на карте
                                </a>
                            </div>
                        </div>
                    <?endif;?>
                </div>
            </div>
            <div class="container">
                <div class="breakstone__accordion d-flex flex-column flex-xl-row flex-xl-wrap">
                    <div class="breakstone__accordion-caption d-flex justify-content-center align-items-center"
                         data-caption-mark="1">
                        <?=$arItem['PROPERTIES']['NOMENCLATURE']['NAME']?>
                    </div>
                    <div class="breakstone__accordion-content"
                         data-caption-for="1">
                        <?=$arItem['PROPERTIES']['NOMENCLATURE']['~VALUE']['TEXT']?>
                    </div>
                    <div class="breakstone__accordion-caption d-flex justify-content-center align-items-center"
                         data-caption-mark="2">
                        <?=$arItem['PROPERTIES']['EQUIPMENT']['NAME']?>
                    </div>
                    <div class="breakstone__accordion-content"
                         data-caption-for="2">
                        <?=$arItem['PROPERTIES']['EQUIPMENT']['~VALUE']['TEXT']?>
                    </div>
                    <div class="breakstone__accordion-caption d-flex justify-content-center align-items-center"
                         data-caption-mark="3">
                        <?=$arItem['PROPERTIES']['SHIPMENT']['NAME']?>
                    </div>
                    <div class="breakstone__accordion-content"
                         data-caption-for="3">
                        <?=$arItem['PROPERTIES']['SHIPMENT']['~VALUE']['TEXT']?>
                    </div>
                    <div class="breakstone__accordion-caption d-flex justify-content-center align-items-center"
                         data-caption-mark="4">
                        <?=$arItem['PROPERTIES']['BENEFITS']['NAME']?>
                    </div>
                    <div class="breakstone__accordion-content"
                         data-caption-for="4">
                        <?=$arItem['PROPERTIES']['BENEFITS']['~VALUE']['TEXT']?>
                    </div>
                    <div class="breakstone__accordion-caption d-flex justify-content-center align-items-center"
                         data-caption-mark="5">
                        <?=$arItem['PROPERTIES']['POWER']['NAME']?>
                    </div>
                    <div class="breakstone__accordion-content"
                         data-caption-for="5">
                        <?=$arItem['PROPERTIES']['POWER']['~VALUE']['TEXT']?>
                    </div>
                </div>
            </div>
        </div>
    <?endforeach;?>
</div>
