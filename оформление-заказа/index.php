<?php
session_start();
require_once '../shop/configDB.php'; // Подключаем БД если нужно что-то дополнительно проверять
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оформление заказа — Student IT Community</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <p class="site-title"><a href="/" rel="home">Student IT Community</a></p>
                </div>

                <nav class="main-nav">
                    <ul>
                        <li><a href="/">Главная</a></li>
                        <li><a href="/news/">Новости</a></li>
                        <li><a href="/shop/">Магазин</a></li>
                        <li><a href="/a5213-contact/">Контакты</a></li>
                        <li><a href="/%d0%be-%d1%81%d0%be%d0%be%d0%b1%d1%89%d0%b5%d1%81%d1%82%d0%b2%d0%b5/">О сообществе</a></li>
                        <li><a href="/my-account/">Мой аккаунт</a></li>
                        <li><a href="/cart/">Корзина</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Основной контент -->

  <main class="container">
		<header class="entry-header">
			<h1 class="page-title">Оформление заказа</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">

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

						<a href="../оформление-заказа/">Оформить заказ</a>

				<?php else: ?>
						<h2 class="wp-block-heading has-text-align-center with-empty-cart-icon wc-block-cart__empty-cart__title">Сейчас ваша корзина пуста!</h2>
				<?php endif; ?>

				<h2>Контактная информация</h2>


				<form  id="orderForm" method="post" >
				<!-- Скрытые поля для таблицы ht_wc_order_stats -->
				<input type="hidden" name="parent_id" value="0">
				<input type="hidden" name="num_items_sold" value="1">
				<input type="hidden" name="total_sales" value="0">
				<input type="hidden" name="tax_total" value="0">
				<input type="hidden" name="shipping_total" value="0">
				<input type="hidden" name="net_total" value="0">
				<input type="hidden" name="returning_customer" value="0">
				<input type="hidden" name="status" value="wc-checkout-draft">
				<input type="hidden" name="customer_id" value="12">

				<!-- Поля адреса -->
				<p >
						<label for="first_name">Имя <span class="required">*</span></label>
						<input class="input-text" type="text" name="first_name" id="first_name" required>
				</p>

				<p >
						<label for="last_name">Фамилия <span class="required">*</span></label>
						<input class=" input-text" type="text" name="last_name" id="last_name" required>
				</p>

				<p >
						<label for="email">Email <span class="required">*</span></label>
						<input class=" input-text" type="email" name="email" id="email" required>
				</p>

				<p >
						<label for="phone">Телефон <span class="required">*</span></label>
						<input class=" input-text" type="tel" name="phone" id="phone" required>
				</p>

				<p >
						<label for="country">Страна <span class="required">*</span></label>
						<input class=" input-text" type="text" name="country" id="country" value="RU" required>
				</p>

				<p >
						<label for="city">Город <span class="required">*</span></label>
						<input class=" input-text" type="text" name="city" id="city" required>
				</p>

				<p >
						<label for="address_1">Адрес 1 <span class="required">*</span></label>
						<input class=" input-text" type="text" name="address_1" id="address_1" required>
				</p>

				<p >
						<label for="address_2">Адрес 2</label>
						<input class=" input-text" type="text" name="address_2" id="address_2">
				</p>

				<p >
						<label for="postcode">Почтовый индекс <span class="required">*</span></label>
						<input class=" input-text" type="text" name="postcode" id="postcode" required>
				</p>

				<!-- Скрытые поля -->
				<input type="hidden" name="address_type" value="billing">
				<input type="hidden" name="company" value="">
				<input type="hidden" name="state" value="">

				<!-- Блок для сообщений -->
				<div id="message" style="display: none; padding: 10px; margin: 10px 0; border-radius: 4px;"></div>

				<p class="form-row">
						<button type="submit" class=" button" name="submit_order">Оформить заказ</button>
				</p>

		</form>

		<script>
		document.getElementById('orderForm').addEventListener('submit', function(e) {
				e.preventDefault(); // Отменяем стандартную отправку формы

				var formData = new FormData(this);
				var messageDiv = document.getElementById('message');
				var submitButton = this.querySelector('button[type="submit"]');

				// Показываем загрузку
				submitButton.disabled = true;
				submitButton.textContent = 'Обработка...';
				messageDiv.style.display = 'none';

				// Отправляем AJAX запрос
				fetch('process_order.php', {
						method: 'POST',
						body: formData
				})
				.then(response => response.text())
				.then(data => {
						// Показываем сообщение об успехе
						messageDiv.style.display = 'block';
						messageDiv.style.backgroundColor = '#d4edda';
						messageDiv.style.color = '#155724';
						messageDiv.style.border = '1px solid #c3e6cb';
						messageDiv.innerHTML = '✅ ' + data;

						// Очищаем форму после успешной отправки
						this.reset();
				})
				.catch(error => {
						// Показываем сообщение об ошибке
						messageDiv.style.display = 'block';
						messageDiv.style.backgroundColor = '#f8d7da';
						messageDiv.style.color = '#721c24';
						messageDiv.style.border = '1px solid #f5c6cb';
						messageDiv.innerHTML = '❌ Ошибка при отправке заказа: ' + error;
				})
				.finally(() => {
						// Восстанавливаем кнопку
						submitButton.disabled = false;
						submitButton.textContent = 'Оформить заказ';
				});
		});
		</script>





			</div><!-- entry-content -->

		</div>


								<!-- Боковая панель -->
								<aside class="sidebar">
										<div class="widget">
												<form role="search" method="get" class="search-form" action="/">
														<label>
																<span class="screen-reader-text">Найти:</span>
																<input type="search" class="search-field" placeholder="Поиск…" value="" name="s">
														</label>
														<input type="submit" class="search-submit" value="Поиск">
												</form>
										</div>

										<div class="widget">
												<h3 class="widget-title">Свежие записи</h3>
												<ul class="widget-list">
														<li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b5%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
														<li><a href="/%d0%bd%d0%be%d0%b2%d0%b0%d1%8f-%d0%bb%d0%b0%d0%b1%d0%be%d1%80%d0%b0%d1%82%d0%be%d1%80%d0%b8%d1%8f-vr-ar-%d0%be%d1%82%d0%ba%d1%80%d1%8b%d1%82%d0%b0-%d0%b2-%d0%ba%d0%b0%d0%bc%d0%bf%d1%83%d1%81%d0%b5/">Новая лаборатория VR/AR открыта в кампусе</a></li>
														<li><a href="/%d0%be%d0%bf%d1%80%d0%be%d1%81-%d0%ba%d0%b0%d0%ba%d0%b8%d0%b5-%d1%82%d0%b5%d1%85%d0%bd%d0%be%d0%bb%d0%be%d0%b3%d0%b8%d0%b8-%d0%b2%d0%b0%d0%bc-%d0%b8%d0%bd%d1%82%d0%b5%d1%80%d0%b5%d1%81%d0%bd%d1%8b/" aria-current="page">Опрос: какие технологии вам интересны?</a></li>
												</ul>
										</div>

										<div class="widget">
												<h3 class="widget-title">Архивы</h3>
												<ul class="widget-list">
														<li><a href="/2025/01/">Январь 2025</a></li>
														<li><a href="/2019/07/">Июль 2019</a></li>
												</ul>
										</div>
								</aside>
								</main>

								<!-- Подвал сайта -->
								<footer class="site-footer">
								<div class="container">
										<div class="footer-content">
												<div class="footer-section">
														<h3 class="footer-title">О нас!</h3>
														<ul class="footer-links">
																<li><a href="/a5213-contact/">Контакты</a></li>
																<li><a href="#">Версия сайта для слабовидящих</a></li>
														</ul>
												</div>

												<div class="footer-section">
														<h3 class="footer-title">Последние новости</h3>
														<ul class="footer-links">
																<li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b5%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
																<li><a href="/%d0%bd%d0%be%d0%b2%d0%b0%d1%8f-%d0%bb%d0%b0%d0%b1%d0%be%d1%80%d0%b0%d1%82%d0%be%d1%80%d0%b8%d1%8f-vr-ar-%d0%be%d1%82%d0%ba%d1%80%d1%8b%d1%82%d0%b0-%d0%b2-%d0%ba%d0%b0%d0%bc%d0%bf%d1%83%d1%81%d0%b5/">Новая лаборатория VR/AR открыта в кампусе</a></li>
														</ul>
												</div>

												<div class="footer-section">
														<h3 class="footer-title">Свежие записи</h3>
														<ul class="footer-links">
																<li><a href="/%d0%b8%d1%82%d0%be%d0%b3%d0%b8-%d1%87%d0%b9%d0%bc%d0%bf%d0%b8%d0%be%d0%bd%d0%b0%d1%82%d0%b0-%d0%bf%d0%be-%d0%b0%d0%bb%d0%b3%d0%be%d1%80%d0%b8%d1%82%d0%bc%d0%b0%d0%bc-%d0%b2%d0%b8%d1%82%d1%82/">Итоги чемпионата по алгоритмам «Витте.Code»</a></li>
														</ul>
												</div>
										</div>

										<div class="copyright">
												<p>&copy; 2025 Student IT Community Юманова Мария Андреевна.</p>
										</div>
								</div>
								</footer>
							</body>
							</html>
