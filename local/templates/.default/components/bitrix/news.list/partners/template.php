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
<div class="partners section_container">
    <div class="container">
        <div class="partners__title section_title">Наши партнеры</div>
        <div class="partners__slider">
            <div class="slider">
                <div class="slider__viewport">
                    <ul class="partners-slick-slider">
                        <?foreach($arResult["ITEMS"] as $arItem):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <li class="slider__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                 alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                 title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                        </li>
                        <?endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
