<?php
session_start();
require_once '../../shop/configDB.php';
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Курс языка программирования C/C++ — Student IT Community</title>
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
		<nav class="breadcrumb">
                <a href="/">Главная</a> /
                <a href="/product-category/%d0%be%d0%b1%d1%83%d1%87%d0%b5%d0%bd%d0%b8%d0%b5/">Обучение</a> /
                Курс языка программирования C/C++
            </nav>
		<header class="entry-header">
			<h1 class="page-title">Курс языка программирования C/C++</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">
				<div class="product-header">
                    <h1 class="product-title">Курс языка программирования C/C++</h1>

                    <div class="product-price">

                        <span class="sale-price">10000,00 ₽</span>
                    </div>

                    <p class="stock-status">15 в наличии</p>
                </div>
								<div class="product-content">
                    <div class="product-image-container">

                    </div>

                    <div class="product-meta">
                        <span class="sku">Артикул: а2</span>
                        <span class="category">Категория: <a href="/product-category/%d0%be%d0%b1%d1%83%d1%87%d0%b5%d0%bd%d0%b8%d0%b5/">Обучение</a></span>
                    </div>

                    <form class="add-to-cart-form" action="/shop/?add-to-cart=430" method="post">
                        <button type="submit" class="add-to-cart-btn">В корзину</button>
                    </form>
                </div>
								<div class="product-tabs">
                    <div class="tab-content">
                        <h3>Описание курса</h3>
												<h4><strong>Что даст вам этот курс?</strong></h4>
                        <p><strong>Полное понимание C/C++</strong> – от синтаксиса до продвинутых концепций</p>
                        <p><strong>Практические навыки</strong> – работа с памятью, алгоритмами и многопоточностью</p>
                        <p><strong>Доступ к эксклюзивному комьюнити</strong> – поддержка преподавателя и единомышленников</p>

                        <h4><strong>Что входит в курс?</strong></h4>
                        <p><strong>60+ видеоуроков</strong> (доступ на 12 месяцев)</p>
                        <p><strong>25 практических заданий</strong></p>
                        <p><strong>Реальные проекты для портфолио</strong></p>
                        <p><strong>Дополнительные материалы:</strong>: чек-листы, шпаргалки, шаблоны проектов</p>
                    </div>
                </div>

                <section class="related-products">
                    <h2>Похожие товары</h2>
                    <div class="products-grid">

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
                </section>



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
