<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/*
 * При создании массива с результирующими данными сразу добавляем туда ссылку
 * на следующую страницу и данные постраничной навигации
 *
 * $arResult["NAV_RESULT"]->NavPageNomer; - Номер текущей страницы
 * $arResult["NAV_RESULT"]->NavPageCount; - Количество страниц
 * $arResult["NAV_RESULT"]->NavRecordCount; - Общее количество элементов
 * $arResult["NAV_RESULT"]->NavPageSize; - Количество элементов на странице
 */
$arResponse = [
    getNextPage(
        $arResult,
        $_GET['PAGEN_1'],
        '/utils/get-next-beton-page.php?PAGEN_1=')
];

// Добавляем в рузультирующий массив данные добавляемых товаро раздела Бетон
foreach ($arResult['ITEMS'] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $arr = [
        'ID' => $this->GetEditAreaId($arItem['ID']),
        'NAME' => $arItem["NAME"],
        'PREVIEW_PICTURE_SRC' => $arItem['PREVIEW_PICTURE']['SRC'],
        'PREVIEW_TEXT' => $arItem["PREVIEW_TEXT"],
        'CONCRETE_GRADE' => $arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"],
        'CONCRETE_CLASS' => $arItem["PROPERTIES"]["CONCRETE_CLASS"]["VALUE"],
        'CONCRETE_MOBILITY' => $arItem["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"],
        'CONCRETE_FROST' => $arItem["PROPERTIES"]["CONCRETE_FROST"]["VALUE"],
        'CONCRETE_WATER' => $arItem["PROPERTIES"]["CONCRETE_WATER"]["VALUE"],
        'PRICE' => $arItem["PROPERTIES"]["PRICE"]["VALUE"],
        'PRICE_MINIMUM' => $arItem["PROPERTIES"]["PRICE_MINIMUM"]["VALUE_XML_ID"],
        'DETAIL_PAGE_URL' => $arItem["DETAIL_PAGE_URL"],
    ];

    $arResponse[] = $arr;
};
?>
    <!-- Оборачиваем данные рузультирующего массива, чтобы в дальнейшем  -->
    <!-- вырезать их из страницы в файле component_epilog.php -->
    <!--RestartBuffer--><?
$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;
?><!--RestartBuffer-->













<div class="catalog">
    <div class="container">
        <div class="row justify-content-center justify-content-sm-start">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="col-sm-6 col-lg-4 col-xl-3 catalog__item d-flex flex-column justify-content-start align-items-center"
                     id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?=$arItem["NAME"]?>
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
            <?endforeach;?>
        </div>
    </div>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <br /><?=$arResult["NAV_STRING"]?>
<?endif;?>