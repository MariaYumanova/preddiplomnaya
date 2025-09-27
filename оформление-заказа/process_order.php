<?php
// process_order.php - ФИНАЛЬНАЯ ВЕРСИЯ ДЛЯ PHP 5.6
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: text/plain; charset=utf-8');

// Старт сессии
if (session_id() == '') {
    session_start();
}

// Проверяем метод
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Неверный метод запроса";
    exit();
}

// Проверяем обязательные поля
$required = array('first_name', 'last_name', 'email', 'phone', 'city', 'address_1', 'postcode');
foreach ($required as $field) {
    if (empty($_POST[$field])) {
        echo "Заполните поле: " . $field;
        exit();
    }
}

// Подключение к БД
require '../my-account/blocks/connect.php';

// Проверяем корзину
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Корзина пуста";
    $mysql->close();
    exit();
}

// Получаем данные
$first_name = $mysql->real_escape_string($_POST['first_name']);
$last_name = $mysql->real_escape_string($_POST['last_name']);
$email = $mysql->real_escape_string($_POST['email']);
$phone = $mysql->real_escape_string($_POST['phone']);
$country = $mysql->real_escape_string(isset($_POST['country']) ? $_POST['country'] : 'RU');
$city = $mysql->real_escape_string($_POST['city']);
$address_1 = $mysql->real_escape_string($_POST['address_1']);
$address_2 = $mysql->real_escape_string(isset($_POST['address_2']) ? $_POST['address_2'] : '');
$postcode = $mysql->real_escape_string($_POST['postcode']);

// Валидация email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Некорректный email";
    $mysql->close();
    exit();
}

// Формируем данные заказа из корзины
$name_order = '';
$total_sales = 0;
$num_items_sold = 0;

foreach ($_SESSION['cart'] as $item) {
    $name_order .= $item['name'] . ', ';
    $num_items_sold += $item['quantity'];
    $total_sales += $item['price'] * $item['quantity'];
}

$name_order = rtrim($name_order, ', ');
if (strlen($name_order) > 500) {
    $name_order = substr($name_order, 0, 497) . '...';
}
$name_order = $mysql->real_escape_string($name_order);

// Вставляем заказ
$sql_stats = "INSERT INTO ht_order_stats
    (name_order, parent_id, date_created, date_created_gmt, num_items_sold,
     total_sales, tax_total, shipping_total, net_total, returning_customer, status, customer_id)
    VALUES (
        '$name_order',
        0,
        NOW(),
        UTC_TIMESTAMP(),
        $num_items_sold,
        $total_sales,
        0,
        0,
        0,
        0,
        'wc-checkout-draft',
        12
    )";

if ($mysql->query($sql_stats)) {
    $order_id = $mysql->insert_id;

    // Вставляем адрес
    $sql_address = "INSERT INTO ht_order_addresses
        (order_id, address_type, first_name, last_name, company,
         address_1, address_2, city, state, postcode, country, email, phone)
        VALUES (
            $order_id,
            'billing',
            '$first_name',
            '$last_name',
            '',
            '$address_1',
            '$address_2',
            '$city',
            '',
            '$postcode',
            '$country',
            '$email',
            '$phone'
        )";

    if ($mysql->query($sql_address)) {
        // УСПЕХ - очищаем корзину
        unset($_SESSION['cart']);
        echo "Заказ успешно оформлен! Номер заказа: $order_id. С вами в ближайшее время свяжется менеджер.";
    } else {
        echo "Ошибка при сохранении адреса: " . $mysql->error;
    }
} else {
    echo "Ошибка при создании заказа: " . $mysql->error;
}

$mysql->close();
?>
