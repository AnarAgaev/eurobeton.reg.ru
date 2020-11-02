<?php
/* Удаляем из результирующего массива все элементы
 * (товары из каталога Бетон) в статусе которых снята
 * (не установлена) галочка "Показывать в списке популярные"
 */
foreach ($arResult['ITEMS'] as $keyItem => $arItem) {
    if (!$arItem['PROPERTIES']['POPULAR']['VALUE_XML_ID']) {
        unset($arResult['ITEMS'][$keyItem]);
    }
}