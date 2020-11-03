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
<div class="faq section_container">
    <div class="container">
        <div class="faq__title section_title">Вопрос — ответ</div>
    </div>
    <div class="container">
        <ul class="faq__list d-flex flex-column">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <li class="faq__item d-flex flex-column"
                    id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="faq__caption d-flex align-items-center">
                        <div class="faq__btn"></div>
                        <?=$arItem["PREVIEW_TEXT"]?>
                    </div>
                    <div class="faq__description">
                        <?=$arItem["DETAIL_TEXT"]?>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
    </div>
</div>
