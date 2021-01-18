<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
if (isset($_POST['date'])
    && isset($_POST['email'])
    && isset($_POST['phone'])
    && isset($_POST['comment'])
    && isset($_POST['name'])) {

    CModule::IncludeModule('iblock');
    $order = new CIBlockElement; // создаём свой класс

    // Пришедшие с формы свойства
    $PROP = array();
    $PROP['DELIVERY_DATE'] = htmlspecialchars(strip_tags(trim($_POST['date'])));
    $PROP['EMAIL'] = htmlspecialchars(strip_tags(trim($_POST['email'])));
    $PROP['PHONE'] = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $PROP['COMMENT'] = htmlspecialchars(strip_tags(trim($_POST['comment'])));

    if (get_magic_quotes_gpc()) {
        $PROP['DELIVERY_DATE'] = stripcslashes($PROP['DELIVERY_DATE']);
        $PROP['EMAIL'] = stripcslashes($PROP['EMAIL']);
        $PROP['PHONE'] = stripcslashes($PROP['PHONE']);
        $PROP['COMMENT'] = stripcslashes($PROP['COMMENT']);
    }

    // Получаем данные из корзины, хранящейся в сессии
    $session = \Bitrix\Main\Application::getInstance()->getSession();

    // Сохраняем корзину в переменную для редактирования
    $cart = json_decode($session['cart'], true);

    // Получаем итоговую стоимость заказа
    $PROP['PRICE'] = 0;
    foreach ($cart['items'] as $arItem) {
        foreach ($arItem as $arProduct) {
            $PROP['PRICE'] += floatval($arProduct['final-price']);
        };
    };

    // Формируем заказ из данных товаров корзины
    // Эти данный будут записаны в свойство инфоблока DETAIL_TEXT
    $ORDER = '';
    foreach ($cart['items'] as $arItem) {
        foreach ($arItem as $arProduct) {
            $ORDER .= '<ul>';
            $ORDER .= '<li style="list-style: none; font-size: 1.2rem;"><b>'.$arProduct['product-name'].'</b></li>';
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Количество:</b> '.$arProduct['product-value'].'</li>';
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Цена товара:</b> '.$arProduct['product-price'].' руб.</li>';
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Стоимость доставки:</b> '.$arProduct['delivery-price'].' руб.</li>';
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Итоговая цена товара:</b> '.$arProduct['final-price'].' руб.</li>';

            $description = ($arProduct['product-type'] === 'concrete' || $arProduct['product-type'] === 'crushedStone')
                ? '<li style="font-size: 0.9rem;"><b>Характеристики:</b> '.$arProduct['product-description'].'</li>'
                : '';
            if ($description !== '') $ORDER .= $description;

            $factories = json_decode($arProduct['factories'], true);
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Место отгрузки:</b> '.$factories[$arProduct['optimal-factory-id']]['name'].'</li>';

            $ORDER .= '<li style="font-size: 0.9rem;"><b>Место поставки:</b> '.$arProduct['delivery-address'].'</li>';
            $ORDER .= '<li style="font-size: 0.9rem;"><b>Расстояние доставки:</b> '.$arProduct['route-length'].' км.</li>';
            $ORDER .= '</ul>';
        };
    };

    //Основные поля элемента
    $fields = array(
        "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дату создания
        "CREATED_BY" => $GLOBALS['USER']->GetID(), //Передаем ID пользователя кто добавляет
        "IBLOCK_SECTION_ID" => false, //ID раздела. В нашем случае false, т.к. нет подразделов
        "IBLOCK_ID" => 32, //ID информационного блока он 30-ый в нашем случае
        "PROPERTY_VALUES" => $PROP, // Передаем массив значении для свойств инфоблока
        "NAME" => strip_tags($_REQUEST['name']),
        "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
        "PREVIEW_TEXT" => "", //Анонс
        "PREVIEW_PICTURE" => "", //изображение для анонса
        "DETAIL_TEXT" => $ORDER, //текст для детальной страницы
        "DETAIL_PICTURE" => "" //изображение для детальной страницы
    );

    $arResponse['DATA'] = $_POST;

    // Добавляем заказ в Инфоблок Заказы (ИД 30)
    if ($ID = $order->Add($fields)) {
        $arResponse['IS_ERRORS'] = false;
        $arResponse['ELEMENT_ID'] = $ID;
        $arResponse['ADDED_DATA'] = $fields;

        // Добавляем товары в инфоблок с првязкой к добавленному заказу
        foreach ($cart['items'] as $arItem) {
            foreach ($arItem as $arProduct) {
                $product = new CIBlockElement; // создаём свой класс
                $factories = json_decode($arProduct['factories'], true);

                $PRODUCT_PROP = array();
                $PRODUCT_PROP['ID_ORDER'] = $ID;
                $PRODUCT_PROP['PRODUCT_VALUE'] = $arProduct['product-value'];
                $PRODUCT_PROP['PRODUCT_PRICE'] = $arProduct['product-price'];
                $PRODUCT_PROP['DELIVERY_PRICE'] = $arProduct['delivery-price'];
                $PRODUCT_PROP['FINAL_PRICE'] = $arProduct['final-price'];
                $PRODUCT_PROP['PRODUCT_DESCRIPTION'] = $arProduct['product-description'];
                $PRODUCT_PROP['FACTORY_NAME'] = $factories[$arProduct['optimal-factory-id']]['name'];
                $PRODUCT_PROP['DELIVERY_ADDRESS'] = $arProduct['delivery-address'];
                $PRODUCT_PROP['ROUTE_LENGTH'] = $arProduct['route-length'];

                //Основные поля элемента
                $product_fields = array(
                    "DATE_CREATE" => date("d.m.Y H:i:s"), //Передаем дату создания
                    "CREATED_BY" => $GLOBALS['USER']->GetID(), //Передаем ID пользователя кто добавляет
                    "IBLOCK_SECTION_ID" => false, //ID раздела. В нашем случае false, т.к. нет подразделов
                    "IBLOCK_ID" => 33, //ID информационного блока он 33-ый в нашем случае
                    "PROPERTY_VALUES" => $PRODUCT_PROP, // Передаем массив значении для свойств инфоблока
                    "NAME" => $arProduct['product-name'],
                    "ACTIVE" => "Y", //поумолчанию делаем активным или ставим N для отключении поумолчанию
                    "PREVIEW_TEXT" => "", //Анонс
                    "PREVIEW_PICTURE" => "", //изображение для анонса
                    "DETAIL_TEXT" => "", //текст для детальной страницы
                    "DETAIL_PICTURE" => "" //изображение для детальной страницы
                );

                $product->Add($product_fields);
            };
        };

        // Чистим корзину в сессии
        $session->set('cart', json_encode([
            "itemCount" => 0,
            "items" => [
                "concrete" => [], // бетон
                "crushedStone" => [], // щебень
                "mineralPowder" => [], // минеральный порошок
                "limestoneFlour" => [], // известняковая мука
            ]
        ]));

    } else {
        $arResponse['IS_ERRORS'] = true;
    }
} else {
    $arResponse['IS_ERRORS'] = true;
}

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>