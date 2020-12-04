<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Сохраняем сессия в перемнную для удобной работы
$session = \Bitrix\Main\Application::getInstance()->getSession();

// Инициализируем корзину если она не создана (при первом запуске сайта)
if (!$session->has('cart')) {
    $session->set('cart', json_encode([
        "itemCount" => 0,
        "items" => [
            "concrete" => [], // бетон
            "crushedStone" => [], // щебень
            "mineralPowder" => [], // минеральный порошок
            "limestoneFlour" => [], // известняковая мука
        ]
    ]));
}

// Сохраняем корзину в переменную для редактирования
$cart = json_decode($session['cart']);

if (isset($_POST['product-type'])) {
    // Если пришёл $_POST с товаром, считаем, что ошибки нет
    $arResponse['IS_ERRORS'] = false;

    // Добавляем пришедший товар в соответствующую ветку корзины
    switch ($_POST['product-type']) {
        case 'concrete':
            array_push($cart->items->concrete, $_POST);
            break;
        case 'crushedStone':
            array_push($cart->items->crushedStone, $_POST);
            break;
        case 'mineralPowder':
            array_push($cart->items->mineralPowder, $_POST);
            break;
        case 'limestoneFlour':
            array_push($cart->items->limestoneFlour, $_POST);
            break;
    }

    // Увеличиваем счётчик товаров в карзине
    $cart->itemCount++;

    // Отдельно передаём количество товаров в корзине
    $arResponse['CART_ITEM_COUNT'] = $cart->itemCount;

    // Перезаписываем корзину в сессии
    $session->set('cart', json_encode($cart));
} else {
    $arResponse['IS_ERRORS'] = true;
}

/* Для дебажинга расскоментировать строки ниже,
 * тогда в ответе сервера на клиента будут приходить
 * полученный с клиента POST и вся карзина,
 * хранящаяся в сессии целиком
 */
//$arResponse['GETTING_POST'] = $_POST;
//$arResponse['CART_IN_SESSION'] = json_decode($session->get('cart'));

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");