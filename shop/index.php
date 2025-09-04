<?php
session_start();
// Подключаемся к базе данных
require_once 'configDB.php';

// Обработка добавления товара в корзину
if (isset($_GET['add-to-cart'])) {
    // Получаем ID товара из запроса
    $product_id = (int)$_GET['add-to-cart'];

    try {
        // 1. Достаем информацию о товаре из базы данных
        // Объединяем основную информацию о товаре и цену из вашей таблицы
        $stmt = $pdo->prepare(
            "SELECT p.ID, p.post_title, pm.min_price as price
             FROM ht_posts p
             INNER JOIN ht_wc_product_meta_lookup pm ON p.ID = pm.product_id
             WHERE p.ID = ? AND p.post_type = 'product' AND p.post_status = 'publish'"
        );

        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if ($product) {
            // 2. Подготавливаем структуру корзины в сессии, если ее еще нет
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // 3. Проверяем, есть ли уже такой товар в корзине
            if (isset($_SESSION['cart'][$product_id])) {
                // Если есть, увеличиваем количество
                $_SESSION['cart'][$product_id]['quantity'] += 1;
            } else {
                // Если нет, добавляем новый товар
                $_SESSION['cart'][$product_id] = [
                    'name' => $product['post_title'],
                    'price' => (float)$product['price'],
                    'quantity' => 1
                ];
            }

            // 4. Сообщение об успехе
            $_SESSION['cart_message'] = 'Товар "' . $product['post_title'] . '" добавлен в корзину!';

            // 5. Перенаправляем пользователя
            header('Location: ../cart/');
            exit();
        } else {
            $_SESSION['cart_error'] = 'Товар не найден!';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['cart_error'] = 'Ошибка при добавлении товара: ' . $e->getMessage();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Магазин — Student IT Community</title>
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
			<h1 class="page-title">Магазин</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">



				<div class="poll-container">


					<div class="additional-info">

            <ul class="products columns-3">
            <li class="product type-product post-573">
            	<a href="/product/%d0%ba%d1%83%d1%80%d1%81-%d1%8f%d0%b7%d1%8b%d0%ba%d0%b0-%d0%bf%d1%80%d0%be%d0%b3%d1%80%d0%b0%d0%bc%d0%bc%d0%b8%d1%80%d0%be%d0%b2%d0%b0%d0%bd%d0%b8%d1%8f-1%d1%81/" >
            	<span class="onsale">Распродажа!</span>
            	<h2>Курс языка программирования 1С</h2></a>
            	<span class="price"><del aria-hidden="true"><span><bdi>33900,00 ₽</bdi></span></del> <ins aria-hidden="true"><span><bdi>6780,00 ₽</bdi></span></ins></span>
            	<div class="loop-button-wrapper"><a href="/shop/?add-to-cart=573" data-quantity="1" class="button" data-product_id="573" data-product_sku="а4" aria-label="Добавить в корзину">
            	    В корзину
            	</a></div>
            </li>
            <li class="product type-product post-430">
            	<a href="/product/%d0%b0%d0%bc%d0%b8%d0%bd%d0%be%d0%ba%d0%b8%d1%81%d0%bb%d0%be%d1%82%d1%8b-optimum-nutrition-bcaa-1000-60-%d0%ba%d0%b0%d0%bf%d1%81%d1%83%d0%bb/" >
            	<span class="onsale">Распродажа!</span>
            	<h2>Курс языка программирования C/C++</h2></a>
            	<span class="price"><del aria-hidden="true"><span><bdi>50000,00 ₽</bdi></span></del> <ins aria-hidden="true"><span><bdi>10000,00 ₽</bdi></span></ins></span>
              <div class="loop-button-wrapper"><a href="/shop/?add-to-cart=430" class="button" data-product_id="430" data-product_sku="а2" aria-label="Добавить в корзину">
                   В корзину
              </a></div>
            </li>
            <li class="product type-product post-432">
            	<a href="/product/now-%d0%be%d0%bc%d0%b5%d0%b3%d0%b0-3-omega-3-1000%d0%bc%d0%b3-100-%d0%ba%d0%b0%d0%bf%d1%81%d1%83%d0%bb/" >
            	<span class="onsale">Распродажа!</span>
            	<h2>Курс языка программирования Python</h2></a>
            	<span class="price"><del aria-hidden="true"><span><bdi>5000,00 ₽</bdi></span></del> <ins aria-hidden="true"><span><bdi>1000,00 ₽</bdi></span></ins></span>
              <div class="loop-button-wrapper"><a href="/shop/?add-to-cart=432" data-quantity="1" class="button" data-product_id="432" data-product_sku="а3" aria-label="Добавить в корзину">
            			В корзину
            	</a></div>
            </li>
            </ul>

					</div>
				</div>




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
