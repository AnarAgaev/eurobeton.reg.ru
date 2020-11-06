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
<ul class="laboratory__security-list d-flex flex-column">
    <?foreach($arResult["ITEMS"] as $arKey => $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <li class="laboratory__security-item d-flex justify-content-start align-items-center"
            id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <img src="<?=DEFAULT_TEMPLATE_PATH?>/img/item-<?=($arKey + 1);?>.png" alt="" title="">
            <?=$arItem['PREVIEW_TEXT']?>
        </li>
    <?endforeach;?>
</ul>
