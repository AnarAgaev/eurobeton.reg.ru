<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');

$el = new CIBlockElement; // создаём свой класс
$iblock_id = 28; // ID инфоблока в который добавляем новый элемент

//Свойства
$PROP = array();
$PROP['EMAIL'] = $_POST['email'];
$PROP['PHONE'] = $_POST['phone'];
$PROP['NUM_LENGTH'] = $_POST['num-length'];
$PROP['PRICE_HOUR'] = $_POST['price-hour'];
$PROP['PRICE_RESULT'] = $_POST['price-result'];
$PROP['TIME'] = $_POST['time'];
$PROP['NUMBER_SHIFTS'] = $_POST['number-shifts'];
$PROP['EXTRA_HOURS'] = $_POST['extra-hours'];

//Основные поля элемента
$fields = array(
    "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дата создания
    "CREATED_BY" => $GLOBALS['USER']->GetID(),    //Передаем ID пользователя кто добавляет
    "IBLOCK_SECTION_ID" => false, //ID разделов. В нашем случае false, т.к. нет подразделов
    "IBLOCK_ID" => $iblock_id, //ID информационного блока он 18-ый в нашем случае
    "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств
    "NAME" => strip_tags($_REQUEST['name']),
    "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
    "PREVIEW_TEXT" => "", //Анонс
    "PREVIEW_PICTURE" => "", //изображение для анонса
    "DETAIL_TEXT"    => "", //текст для детальной страницы
    "DETAIL_PICTURE" => "" //изображение для детальной страницы
);

$arResponse['DATA'] = $_POST;

if ($ID = $el->Add($fields)) {
    $arResponse['IS_ERRORS'] = false;
    $arResponse['ELEMENT_ID'] = $ID;
} else {
    $arResponse['IS_ERRORS'] = true;
}

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>