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
<div class="prices section_container">
    <div class="container">
        <div class="prices__title section_title">ВАС ТАКЖЕ МОЖЕТ ЗАИНТЕРЕСОВАТЬ</div>
        <div class="prices__slider">
            <div class="slider">
                <div class="slider__controller slider__controller_left slider-controller-left"></div>
                <div class="slider__controller slider__controller_right slider-controller-right"></div>
                <div class="slider__viewport">
                    <div class="slider__list d-flex">
                        <?foreach($arResult["ITEMS"] as $arItem):?>
                            <?
                            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                            ?>
                            <div class="slider__item d-flex flex-column justify-content-start align-items-center"
                                 id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                                <div class="prices__pic" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)"></div>
                                <div class="prices__caption"><?=$arItem['PREVIEW_TEXT']?></div>
                                <div class="prices__desc"><?=$arItem['NAME']?></div>
                                <div class="prices__price">
                                    <?if($arItem["PROPERTIES"]["PRICE_MINIMUM"]["VALUE_XML_ID"]) echo 'от';?><span><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></span>руб.
                                </div>
                                <div class="prices__btn"><a class="btn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">ПОДРОБНЕЕ</a></div>
                            </div>
                        <?endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>