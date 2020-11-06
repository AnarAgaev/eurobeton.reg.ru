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
<div class="right-side laboratory__pic d-flex justify-content-center">
    <ul class="sml-img-slider__list">
        <?foreach($arResult["ITEMS"] as $arKey => $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <li class="sml-img-slider__item <?if ($arKey == 0) echo 'front'; if ($arKey == 1) echo 'back';?>"
                id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a class="sml-img-slider__card"
                   data-fancybox="lab-galery"
                   href="<?=$arItem['DETAIL_PICTURE']['SRC']?>"
                   style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)">
                </a>
            </li>
        <?endforeach;?>
    </ul>
</div>
