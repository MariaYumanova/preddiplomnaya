<?php
// remove_from_cart.php
session_start();

if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];

    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['cart_message'] = 'Товар удален из корзины!';
    }
}

header('Location: index.php');
exit();
?>
