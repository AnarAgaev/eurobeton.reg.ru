<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$arResponse = [];

foreach ($arResult['PROPERTIES'] as $arItem) {
    $arr = [
        'code' => $arItem["CODE"],
        'name' => $arItem["NAME"],
        'value' => $arItem["VALUE"],
    ];

    $arResponse[] = $arr;
};

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;
?>