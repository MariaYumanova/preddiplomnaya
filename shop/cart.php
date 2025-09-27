<?php
session_start();
require_once 'configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина товаров</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .alert { padding: 10px; margin: 10px 0; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>

    <h1>Ваша корзина</h1>

    <?php if (isset($_SESSION['cart_message'])): ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['cart_message'];
            unset($_SESSION['cart_message']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['cart_error'])): ?>
        <div class="alert alert-error">
            <?php
            echo $_SESSION['cart_error'];
            unset($_SESSION['cart_error']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['cart'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Цена</th>
                    <th>Количество</th>
                    <th>Итого</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item):
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price'], 2, ',', ' '); ?> ₽</td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item_total, 2, ',', ' '); ?> ₽</td>
                        <td>
                            <a href="remove_from_cart.php?id=<?php echo $id; ?>">Удалить</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Общая сумма:</th>
                    <th colspan="2"><?php echo number_format($total, 2, ',', ' '); ?> ₽</th>
                </tr>
            </tfoot>
        </table>

        <a href="checkout.php">Оформить заказ</a>

    <?php else: ?>
        <p>Ваша корзина пуста.</p>
    <?php endif; ?>

    <br>
    <a href="/shop/">Вернуться в магазин</a>

</body>
</html>
