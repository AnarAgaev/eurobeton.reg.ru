<?php
define('DEFAULT_TEMPLATE_PATH', '/local/templates/.default');

function debug($data) {
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

function normalizeDate($date) {
    $arrMonths = [
        'января',
        'февраля',
        'марта',
        'апреля',
        'мая',
        'июня',
        'июля',
        'августа',
        'сентября',
        'октября',
        'ноября',
        'декабря'
    ];

    $arDate = date_parse_from_format("j.n.Y", $date);

    return $arDate['day']
        . ' '
        . $arrMonths[$arDate['month'] - 1]
        . ' '
        . $arDate['year'];
};

function getNextPage($arResult, $curPage, $templateUrl) {
    $NavPageNomer = $arResult["NAV_RESULT"]->NavPageNomer; // Номер текущей страницы
    $NavPageCount = $arResult["NAV_RESULT"]->NavPageCount; // Количество страниц
    $NavRecordCount = $arResult["NAV_RESULT"]->NavRecordCount; // Общее количество элементов
    $NavPageSize = $arResult["NAV_RESULT"]->NavPageSize; // Количество элементов на странице

    $nextPage = ($curPage && $curPage > 0 && $curPage < $NavPageCount)
        ? $templateUrl . ($NavPageNomer + 1)
        : null;

    return Array(
        'NavPageNomer' => $NavPageNomer,
        'NavPageCount' => $NavPageCount,
        'NavRecordCount' => $NavRecordCount,
        'NavPageSize' => $NavPageSize,
        'NEXT_PAGE_URL' => $nextPage
    );
}