<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/* !!!
 * Корзина инициализируется в header шаблона сайте в блоке с корзиной,
 * т.к. в этот момент уже нужны данные корзины, в частности
 * количество товаров в корзине.
 */

// Сохраняем сессию в перемнную для удобной работы
$session = \Bitrix\Main\Application::getInstance()->getSession();

// Сохраняем корзину в переменную для редактирования
$cart = json_decode($session['cart'], true);

if (isset($_POST['product-type'])) {
    // Если пришёл $_POST с товаром, считаем, что ошибки нет
    $arResponse['IS_ERRORS'] = false;

    // Добавляем пришедший товар в соответствующую ветку корзины
    switch ($_POST['product-type']) {
        case 'concrete':
            $cart['items']['concrete'][] = $_POST; // добавляем товар в конец соответствующего массива
            $arResponse['ADDED_ITEM_ID'] = count($cart['items']['concrete']) - 1;
            break;
        case 'crushedStone':
            $cart['items']['crushedStone'][] = $_POST; // добавляем товар в конец соответствующего массива
            $arResponse['ADDED_ITEM_ID'] = count($cart['items']['crushedStone']) - 1;
            break;
        case 'mineralPowder':
            $cart['items']['mineralPowder'][] = $_POST; // добавляем товар в конец соответствующего массива
            $arResponse['ADDED_ITEM_ID'] = count($cart['items']['mineralPowder']) - 1;
            break;
        case 'limestoneFlour':
            $cart['items']['limestoneFlour'][] = $_POST; // добавляем товар в конец соответствующего массива
            $arResponse['ADDED_ITEM_ID'] = count($cart['items']['limestoneFlour']) - 1;
            break;
    }

    // Увеличиваем счётчик товаров в корзине
    $cart['itemCount']++;

    // Отдельно передаём количество товаров в корзине
    $arResponse['CART_ITEM_COUNT'] = $cart['itemCount'];

    // Перезаписываем корзину в сессии
    $session->set('cart', json_encode($cart));
} else {
    $arResponse['IS_ERRORS'] = true;
}

/* Для дебажинга расскоментировать строки ниже,
 * тогда в ответе сервера на клиента будут приходить
 * полученный с клиента POST и вся корзина,
 * хранящаяся в сессии целиком
 */
$arResponse['GETTING_POST'] = $_POST;
$arResponse['CART_IN_SESSION'] = json_decode($session->get('cart'));

$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");