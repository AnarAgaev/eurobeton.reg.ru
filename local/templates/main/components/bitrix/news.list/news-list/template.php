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
<div class="container">
    <div class="all-news"><a href="/o-kompanii/novosti/">Все новости</a></div>
</div>
<div class="container news-list">
    <div class="row news-list__wrap">
        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="col-md-6 col-xl-3 d-flex justify-content-center" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <a class="news-list__card" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                    <div class="news-list__pic" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>);"></div>
                    <div class="news-list__desc">
                        <div class="news-list__date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
                        <div class="news-list__caption"><?=$arItem["PREVIEW_TEXT"]?></div>
                    </div>
                </a>
            </div>
        <?endforeach;?>
    </div>
</div>
