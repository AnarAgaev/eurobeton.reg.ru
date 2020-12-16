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

//debug($arResult['ITEMS']);

// Добавляем в рузультирующий массив данные добавляемых товаро раздела Бетон
foreach ($arResult['ITEMS'] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    // Получаем минимальную цену товара
    // В том случае если цен несколько в переменную $PRICE_MINIMUM
    // пишем true и тогда в карточке товара в списке товара
    // к товару добавиться приставка ОТ
    $PRICE_COUNT = 0;
    $PRICE = false;

    for ($i = 350; $i < 356; $i++) {
        $CURRENT_PRICE = (float)str_replace(',', '.', $arItem['PROPERTIES']['PRICE_FACTORY_ID_' . $i]['VALUE']);

        if ($CURRENT_PRICE != 0) {
            $PRICE = !$PRICE
                ? $CURRENT_PRICE
                : $CURRENT_PRICE < $PRICE
                    ? $CURRENT_PRICE
                    : $PRICE;
            $PRICE_COUNT++;
        }
    }

    if ($PRICE_COUNT > 0) $PRICE_MINIMUM = true;

    $arr = [
        'ID' => $this->GetEditAreaId($arItem['ID']),
        'NAME' => $arItem["NAME"],
        'PREVIEW_PICTURE_SRC' => $arItem['PREVIEW_PICTURE']['SRC'],
        'PREVIEW_TEXT' => $arItem["PREVIEW_TEXT"],
        'CONCRETE_GRADE' => $arItem["PROPERTIES"]["CONCRETE_GRADE"]["VALUE"],
        'CONCRETE_MOBILITY' => $arItem["PROPERTIES"]["CONCRETE_MOBILITY"]["VALUE"],
        'CONCRETE_FROST' => $arItem["PROPERTIES"]["CONCRETE_FROST"]["VALUE"],
        'CONCRETE_WATER' => $arItem["PROPERTIES"]["CONCRETE_WATER"]["VALUE"],
        'CONCRETE_FILLER' => $arItem["PROPERTIES"]["CONCRETE_FILLER"]["VALUE"],
        'CONCRETE_ANTIFREEZE_ADDITIVE' => $arItem["PROPERTIES"]["CONCRETE_ANTIFREEZE_ADDITIVE"]["VALUE"],
        'PRICE' => $PRICE,
        'PRICE_MINIMUM' => $PRICE_MINIMUM,
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