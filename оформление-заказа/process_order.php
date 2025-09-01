<?php
// process_order.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Добавляем старт сессии
include '../my-account/blocks/connect.php';

// Простая проверка подключения
if (!$mysql) {
    die("Ошибка подключения к базе данных");
}

// Получение данных из формы
$first_name = $mysql->real_escape_string($_POST['first_name'] ?? '');
$last_name = $mysql->real_escape_string($_POST['last_name'] ?? '');
$email = $mysql->real_escape_string($_POST['email'] ?? '');
$phone = $mysql->real_escape_string($_POST['phone'] ?? '');
$country = $mysql->real_escape_string($_POST['country'] ?? 'RU');
$city = $mysql->real_escape_string($_POST['city'] ?? '');
$address_1 = $mysql->real_escape_string($_POST['address_1'] ?? '');
$address_2 = $mysql->real_escape_string($_POST['address_2'] ?? '');
$postcode = $mysql->real_escape_string($_POST['postcode'] ?? '');

// Текущие даты
$date_created = date('Y-m-d H:i:s');
$date_created_gmt = gmdate('Y-m-d H:i:s');

// Получаем данные из сессии корзины
$name_order = '';
$total_sales = 0;
$num_items_sold = 0;

if (!empty($_SESSION['cart'])) {
    // Формируем название заказа (список товаров)
    $product_names = [];
    foreach ($_SESSION['cart'] as $id => $item) {
        $product_names[] = htmlspecialchars($item['name']);
        $num_items_sold += $item['quantity'];
        $total_sales += $item['price'] * $item['quantity'];
    }
    $name_order = $mysql->real_escape_string(implode(', ', $product_names));
}

// Вставка в ht_wc_order_stats
$sql_stats = "INSERT INTO ht_order_stats
    (name_order, parent_id, date_created, date_created_gmt, num_items_sold,
     total_sales, tax_total, shipping_total, net_total, returning_customer, status, customer_id)
    VALUES (
        '$name_order',
        0,
        '$date_created',
        '$date_created_gmt',
        '$num_items_sold',
        '$total_sales',
        0,
        0,
        0,
        0,
        'wc-checkout-draft',
        12
    )";

if ($mysql->query($sql_stats)) {
    $order_id = $mysql->insert_id;

    // Вставка в ht_wc_order_addresses
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
        echo "Заказ успешно оформлен! ID заказа: " . $order_id . " С вами в ближайшее время свяжется менеджер.";
        // Очищаем корзину после успешного оформления
        unset($_SESSION['cart']);
    } else {
        echo "Ошибка при сохранении адреса: " . $mysql->error;
    }
} else {
    echo "Ошибка при создании заказа: " . $mysql->error;
}

$mysql->close();
?>
