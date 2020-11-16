<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');

$el = new CIBlockElement; // создаём свой класс
$iblock_id = 23; // ID инфоблока в который добавляем новый элемент

//Сохраняем в совойства добавляемые в инфоблок данные пришедшие с клиента
$PROP = array();
$PROP['NAME'] = $_POST['name'];
$PROP['ADDRESS'] = $_POST['address'];
$PROP['FIO'] = $_POST['fio'];
$PROP['OGRN'] = $_POST['ogrn'];
$PROP['PHONE'] = $_POST['phone'];
$PROP['EMAIL'] = $_POST['email'];
$PROP['DOCUMENTS'] = $_FILES['docs'];
$PROP['MONEY'] = $_POST['money'];

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

$arResponse['POST'] = $_POST;
$arResponse['FILES'] = $_FILES;

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