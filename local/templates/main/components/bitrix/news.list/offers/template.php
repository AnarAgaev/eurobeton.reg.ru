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
<div class="offers section_container">
    <div class="container">
        <div class="row">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="offers__card-wrap col-xl-6 d-flex justify-content-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <div class="offers__card">
                        <a class="card-body offers__card-body"
                           href="<?=$arItem['PROPERTIES']['PAGE_URL']['VALUE'];?>">
                            <div class="offers__caption"><?=$arItem['NAME'];?></div>
                            <div class="offers__title"><?=$arItem['PREVIEW_TEXT'];?></div>
                            <div class="offers__txt"><?=$arItem['DETAIL_TEXT'];?></div>
                            <div class="offers__pic">
                                <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>"
                                     alt="<?=$arItem['NAME'];?>"
                                     title="<?=$arItem['NAME'];?>">
                            </div>
                        </a>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>
