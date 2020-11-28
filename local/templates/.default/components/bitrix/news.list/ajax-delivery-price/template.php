<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResponse = [];

foreach ($arResult['ITEMS'] as $arItem) {
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

    $arr = [
        'id' => $this->GetEditAreaId($arItem['ID']),
        'name' => $arItem["NAME"],
        'address' => $arItem['PROPERTIES']['ADDRESS']['VALUE'],
        'coordinates' => $arItem['PROPERTIES']['COORDINATES']['VALUE'],
        'prices' => [
            '5' => $arItem['PROPERTIES']['PRICE_UP_TO_5_KM']['VALUE'],
            '10' => $arItem['PROPERTIES']['PRICE_UP_TO_10_KM']['VALUE'],
            '15' => $arItem['PROPERTIES']['PRICE_UP_TO_15_KM']['VALUE'],
            '20' => $arItem['PROPERTIES']['PRICE_UP_TO_20_KM']['VALUE'],
            '25' => $arItem['PROPERTIES']['PRICE_UP_TO_25_KM']['VALUE'],
            '30' => $arItem['PROPERTIES']['PRICE_UP_TO_30_KM']['VALUE'],
            '35' => $arItem['PROPERTIES']['PRICE_UP_TO_35_KM']['VALUE'],
            '40' => $arItem['PROPERTIES']['PRICE_UP_TO_40_KM']['VALUE'],
            '45' => $arItem['PROPERTIES']['PRICE_UP_TO_45_KM']['VALUE'],
            '50' => $arItem['PROPERTIES']['PRICE_UP_TO_50_KM']['VALUE'],
        ]
    ];

    $arResponse[] = $arr;
};

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;
?>








