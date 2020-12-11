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


/*
 * Обработка отправки сообщения из формы Обратной связи
 * в модальном окне на всех страницах сайта
 *
 * Регистрируем обработчик
 */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handleFeedbackFrom", "OnAfterIBlockElementAddHandler")
);
class handleFeedbackFrom {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока Запросы/Сообщения
     * с идентификатором 18.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем своим в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 18) {

            $arSend = array(
                'AUTHOR' => $arFields['NAME'],
                'EMAIL_FROM' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'TEXT' => $arFields['PROPERTY_VALUES']['MESSAGE'],
            );

            CEvent::Send('FEEDBACK_FORM',SITE_ID,$arSend);
        }
    }
}

/*
 * Обработка отправки сообщения из формы Записаться
 * на собеседование на странице Вакансии
 *
 * Регистрируем обработчик
 */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handleVacancyFrom", "OnAfterIBlockElementAddHandler")
);
class handleVacancyFrom {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока
     * Запросы/Записи на собеседование
     * с идентификатором 19.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем свои в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 19) {

            // Получаем url добавленных файлов
            $arFilter = Array("IBLOCK_ID"=>19, "ID"=>$arFields['RESULT']);
            $res = CIBlockElement::GetList(Array(), $arFilter);
            $ob = $res->GetNextElement();
            $arProps = $ob->GetProperties();

            $arSend = array(
                'AUTHOR' => $arFields['NAME'],
                'BIRTHDAY' => $arFields['PROPERTY_VALUES']['BIRTHDAY'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'EMAIL_FROM' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'POSITION' => $arFields['PROPERTY_VALUES']['POSITION'],
                'QUESTIONARY' => $arProps['QUESTIONARY']['VALUE'] === ""
                            ? 'Не указана'
                            : $_SERVER["SERVER_NAME"].CFile::GetPath($arProps['QUESTIONARY']['VALUE']),
                'PHOTO' => $arProps['PHOTO']['VALUE'] === ""
                            ? 'Не указано'
                            : $_SERVER["SERVER_NAME"].CFile::GetPath($arProps['PHOTO']['VALUE']),
            );
            CEvent::Send('INTERVIEW_REQUEST',SITE_ID,$arSend);
        }
    }
}

/*
 * Обработка отправки сообщения из формы
 * Заявка на тендер на странице Тендеры
 *
 * Регистрируем обработчик
 */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handleRequestTenderFrom", "OnAfterIBlockElementAddHandler")
);
class handleRequestTenderFrom {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока
     * Запросы/Зааявки на тендеры
     * с идентификатором 23.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем свои в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 23) {

            // Получаем url добавленных файлов
            $arFilter = Array("IBLOCK_ID"=>23, "ID"=>$arFields['RESULT']);
            $res = CIBlockElement::GetList(Array(), $arFilter);
            $ob = $res->GetNextElement();
            $arProps = $ob->GetProperties();

            $arSend = array(
                'COMPANY' => $arFields['NAME'],
                'ADDRESS' => $arFields['PROPERTY_VALUES']['ADDRESS'],
                'FIO' => $arFields['PROPERTY_VALUES']['FIO'],
                'OGRN' => $arFields['PROPERTY_VALUES']['OGRN'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'EMAIL_FROM' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'MONEY' => $arFields['PROPERTY_VALUES']['MONEY'],
                'DOCUMENTS' => $arProps['DOCUMENTS']['VALUE'] === ""
                    ? 'Не указаны'
                    : $_SERVER["SERVER_NAME"].CFile::GetPath($arProps['DOCUMENTS']['VALUE']),
            );
            CEvent::Send('USER_REQUEST_TENDER',SITE_ID,$arSend);
        }
    }
}

/*
 * Обработка отправки сообщения из формы
 * Заявка на аренду доп. оборудования
 * в модальном окне на странице с кароточкой
 * товара из доп. оборудования
 *
 * Регистрируем обработчик
 */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handleEquipmentOrderForm", "OnAfterIBlockElementAddHandler")
);
class handleEquipmentOrderForm {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока
     * Запросы/Аренда доп. оборудования
     * с идентификатором 25.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем свои в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 25) {

            $arSend = array(
                'AUTHOR' => $arFields['NAME'],
                'EMAIL_FROM' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'TEXT' => $arFields['PROPERTY_VALUES']['MESSAGE'],
                'PRODUCT_NAME' => $arFields['PROPERTY_VALUES']['PRODUCT_NAME'],
                'PRODUCT_LINK' => $arFields['PROPERTY_VALUES']['PRODUCT_LINK'],
            );

            CEvent::Send('USER_REQUEST_EQUIPMENT_RENTAL',SITE_ID,$arSend);
        }
    }
}

/*
 * Обработка отправки сообщения из формы
 * Заявка на аренду бетононасоса
 * в модальном окне на странице Аренда
 *
 * Регистрируем обработчик
 */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handlePumpRentForm", "OnAfterIBlockElementAddHandler")
);
class handlePumpRentForm {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока
     * Запросы/Аренда бетононасоса
     * с идентификатором 28.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем свои в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 28) {

            $arSend = array(
                'AUTHOR' => $arFields['NAME'],
                'EMAIL_FROM' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'NUM_LENGTH' => $arFields['PROPERTY_VALUES']['NUM_LENGTH'],
                'PRICE_HOUR' => $arFields['PROPERTY_VALUES']['PRICE_HOUR'],
                'PRICE_RESULT' => $arFields['PROPERTY_VALUES']['PRICE_RESULT'],
                'TIME' => $arFields['PROPERTY_VALUES']['TIME'],
                'NUMBER_SHIFTS' => $arFields['PROPERTY_VALUES']['NUMBER_SHIFTS'],
                'EXTRA_HOURS' => $arFields['PROPERTY_VALUES']['EXTRA_HOURS'],
            );

            CEvent::Send('USER_REQUEST_PUMP_RENTAL',SITE_ID,$arSend);
        }
    }
}

/*
 * Обработка создания заказа
 */
/* Регистрируем обработчик */
AddEventHandler(
    "iblock",
    "OnAfterIBlockElementAdd",
    Array("handleSetOrderForm", "OnAfterIBlockElementAddHandler")
);
class handleSetOrderForm {
    /*
     * Создаем обработчик события "OnAfterIBlockElementAdd"
     * который слушает редактирование инфоблока
     * Заказы/Запросы с идентификатором 32.
     *
     * В массиве $arSend перезаписываем стандартные макросы
     * почтового сообщения и добавляем свои в сответствии
     * со свойствами инфоблока.
     */
    function OnAfterIBlockElementAddHandler(&$arFields) {
        if ($arFields["IBLOCK_ID"] == 32) {

            $arSend = array(
                'COMPANY' => $arFields['NAME'],
                'PRICE' => $arFields['PROPERTY_VALUES']['PRICE'],
                'DATE' => $arFields['PROPERTY_VALUES']['DELIVERY_DATE'],
                'EMAIL' => $arFields['PROPERTY_VALUES']['EMAIL'],
                'PHONE' => $arFields['PROPERTY_VALUES']['PHONE'],
                'COMMENT' => $arFields['PROPERTY_VALUES']['COMMENT'],
                'PRODUCTS' => $arFields['DETAIL_TEXT']
            );

            CEvent::Send('USER_REQUEST_SET_ORDER',SITE_ID,$arSend);
        }
    }
}
