<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
CModule::IncludeModule('iblock');

$el = new CIBlockElement; // создаём свой класс
$iblock_id = 19; // ID инфоблока в который добавляем новый элемент

//Свойства
$PROP = array();
$PROP['NAME'] = htmlspecialchars(strip_tags(trim($_POST['name'])));
$PROP['BIRTHDAY'] = htmlspecialchars(strip_tags(trim($_POST['birthday'])));
$PROP['PHONE'] = htmlspecialchars(strip_tags(trim($_POST['phone'])));
$PROP['EMAIL'] = htmlspecialchars(strip_tags(trim($_POST['email'])));
$PROP['POSITION'] = htmlspecialchars(strip_tags(trim($_POST['position'])));
$PROP['QUESTIONARY'] = $_FILES['questionary'];
$PROP['PHOTO'] = $_FILES['photo'];

if (get_magic_quotes_gpc()) {
    $PROP['NAME'] = stripcslashes($PROP['NAME']);
    $PROP['BIRTHDAY'] = stripcslashes($PROP['BIRTHDAY']);
    $PROP['PHONE'] = stripcslashes($PROP['PHONE']);
    $PROP['EMAIL'] = stripcslashes($PROP['EMAIL']);
    $PROP['POSITION'] = stripcslashes($PROP['POSITION']);
}

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