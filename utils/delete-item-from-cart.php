<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

/* Данный скрипт удаляет товар из стурктуры данныйх Карзины,
 * хранящейся в сессии.
 * Отдаёт массив обязательно содержащий количество оставшихся
 * товаров в карзине или ошибку есто таковая всплывёт.
 */

// Сохраняем сессию в перемнную для удобной работы
$session = \Bitrix\Main\Application::getInstance()->getSession();

// Сохраняем корзину в переменную для редактирования
$cart = json_decode($session['cart'], true);

if (isset($_GET['type']) && isset($_GET['id'])) {
    // Если пришли данные: тип товара и его ИД,
    // считаем, что ошибки нет
    $arResponse['IS_ERRORS'] = false;

    // Получаем стомость удаляемого товара
    $arResponse['PRODUCT_PRICE'] = $cart['items'][$_GET['type']][$_GET['id']]['final-price'];

    // Удаляем пришедший товар из соттветствущего типа
    // в структуре данных карзины
    unset($cart['items'][$_GET['type']][$_GET['id']]);

    // Уменьшаем счётчик товаров в карзине
    $cart['itemCount']--;

    // Отдельно передаём количество товаров в корзине
    $arResponse['CART_ITEM_COUNT'] = $cart['itemCount'];

    // Перезаписываем корзину в сессии
    $session->set('cart', json_encode($cart));
} else {
    $arResponse['IS_ERRORS'] = true;
}

// Сериализуем данные карзиын и отправляем на клиента
$JSON__DATA = defined('JSON_UNESCAPED_UNICODE')
    ? json_encode($arResponse, JSON_UNESCAPED_UNICODE)
    : json_encode($arResponse);
echo $JSON__DATA;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");