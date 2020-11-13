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
<div class="page-title">
    <div class="container">
        <h1 class="page-title__content">Бетонная смесь мелкозернистого бетона</h1>
    </div>
</div>
<div class="catalog">
    <div class="container">
        <div class="row justify-content-center<?
            $countItems = 0;
            foreach($arResult["ITEMS"] as $arItem) {
                if ($arItem["IBLOCK_SECTION_ID"] === '5') {
                    $countItems++;
                }
            }
            if ($countItems > 3) echo " justify-content-sm-start";?>" id="itemsListContainer">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?if ($arItem["IBLOCK_SECTION_ID"] === '5') : //Выводим элементы только из подраздела Бетонная смесь ?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3 catalog__item d-flex flex-column justify-content-start align-items-center"
                         id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                        <div class="prices__pic" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"></div>
                        <div class="prices__caption"><?=$arItem["PREVIEW_TEXT"]?></div>
                        <div class="prices__desc">
                            <?=$arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_CLASS"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_FROST"]["VALUE"]?>
                            <?=$arItem["PROPERTIES"]["CONCRETE_WATER"]["VALUE"]?>
                        </div>
                        <div class="prices__price"><?if($arItem["PROPERTIES"]["PRICE_MINIMUM"]["VALUE_XML_ID"]) echo 'от';?><span><?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?></span>руб.</div>
                        <div class="prices__btn">
                            <a class="btn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">подробнее</a>
                        </div>
                    </div>
                <?endif;?>
            <?endforeach;?>
        </div>
    </div>
</div>