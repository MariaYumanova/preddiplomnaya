


<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мой аккаунт — Student IT Community</title>
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
			<h1 class="page-title">Мой аккаунт</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">










				<?php
					if ($_COOKIE['user'] == ''):


				?>
				<div class="u-columns col2-set" id="customer_login">

				<div class="u-column1 col-1">


				<h2>Вход</h2>



				<form action="validation-form\auth.php" method="post" novalidate>


				<p >
					<label for="username">Имя пользователя или Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
					<input type="text" class=" input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">			</p>
				<p >
					<label for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
					<input class=" input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
				</p>


				<p class="form-row">

					<button type="submit" class="button" name="login" value="Войти">Войти</button>
				</p>



				</form>





				</div>


				<div class="u-column2 col-2">

				<h2>Регистрация</h2>



				<form action="validation-form/check.php" method="post" >



				<p >
					<label for="username">Имя пользователя или Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
					<input type="text" class=" input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">			</p>
				<p >
					<label for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
					<input class=" input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
				</p>


				<p class="form-row">
					<button type="submit" class="button" >Регистрация</button>
				</p>







				</form>



				</div>





				</div>







				<?php
					elseif ($_COOKIE['user'] == 'admin1'):


				?>




					<div class="additional-info">
						<h2 class="poll-title">Мои данные профиля</h2>

						<div class="text-content">


							<div class="text-description">
								<?php
									require 'configDB.php';
									$query = $pdo->query('SELECT * FROM `ht_users`');
									while ($row = $query->fetch(PDO::FETCH_OBJ))
									if ($row->user_login == $_COOKIE['user'])

									{
										echo '
										<h4>Логин: '.$row->user_login.' </h4>
										<h4>Никнейм: '.$row->user_nicename.' </h4>
										<h4>Электронная почта: '.$row->user_email.' </h4>
										';
									}
								?>
							</div>
						</div>

						<form  action="add.php" method="post" novalidate>
							<h4>Изменить данные профиля пользователя</h4>

							<p >
								<label for="username">Новый Логин&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
								<input type="text" class=" input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">
							</p>
								<p >
									<label for="usernicename">Никнейм&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
									<input type="text" class=" input-text" name="usernicename" id="usernicename" autocomplete="usernicename" value="" required aria-required="true">
								</p>
									<p >
										<label for="useremail">Электронная почта/Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
										<input type="text" class=" input-text" name="useremail" id="useremail" autocomplete="useremail" value="" required aria-required="true">
									</p>




							<p >
								<label for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
								<input class=" input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
							</p>


							<p class="form-row">

								<button type="submit" class=" button" name="login" value="Отправить">Отправить</button>
							</p>



						</form>
						<h5>Привет. Чтобы посмотреть данные пользователей нажмите <a
							href="admin/данные-пользователей/index.php">здесь</a>. </h5>
							<h5>Привет. Чтобы посмотреть оформленные заказы пользователей нажмите <a
								href="admin/Оформленные-заказы/index.php">здесь</a>. </h5>

		<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
			href="../exit.php">здесь</a>. </h5>
					</div>




<?php elseif($_COOKIE['user'] == 'manager'): ?>

	<h2 class="poll-title">Оформленные заказы</h2>

	<div class="additional-info">
		<?php
require 'configDB.php';
$query = $pdo->query('SELECT * FROM `ht_order_addresses`');
?>

<style>
								.table-container {
										margin: 20px 0;
										overflow-x: auto;
										background: white;
										border-radius: 8px;

										box-shadow: 0 2px 10px rgba(0,0,0,0.1);
								}
								.data-table {
										width: 100%;
										border-collapse: collapse;
								}
								.data-table th,
								.data-table td {
										padding: 12px 15px;
										text-align: left;
										border-bottom: 1px solid #e1e1e1;
								}
								.data-table th {
										background-color: #f8f9fa;
										font-weight: 600;
										color: #333;
										border-top: 1px solid #e1e1e1;
								}
								.data-table tr:last-child td {
										border-bottom: none;
								}
								.data-table tr:hover {
										background-color: #f8f9fa;
								}
								.data-table td {
										color: #555;
								}
								</style>

								<div class="table-container">
										<table class="data-table">
												<thead>
														<tr>
																<th>Order ID</th>
																<th>Type</th>
																<th>First Name</th>
																<th>Last Name</th>
																<th>Address</th>
																<th>City</th>
																<th>Postcode</th>
																<th>Country</th>
																<th>Email</th>
																<th>Phone</th>
														</tr>
												</thead>
												<tbody>
														<?php while ($row = $query->fetch(PDO::FETCH_OBJ)): ?>
														<tr>
																<td><strong><?= htmlspecialchars($row->order_id) ?></strong></td>
																<td><?= htmlspecialchars($row->address_type) ?></td>
																<td><?= htmlspecialchars($row->first_name) ?></td>
																<td><?= htmlspecialchars($row->last_name) ?></td>
																<td>
																		<?= htmlspecialchars($row->address_1) ?>
																		<?= $row->address_2 ? '<br><small>' . htmlspecialchars($row->address_2) . '</small>' : '' ?>
																</td>
																<td><?= htmlspecialchars($row->city) ?></td>
																<td><?= htmlspecialchars($row->postcode) ?></td>
																<td><?= htmlspecialchars($row->country) ?></td>
																<td><?= htmlspecialchars($row->email) ?></td>
																<td><?= htmlspecialchars($row->phone) ?></td>
														</tr>
														<?php endwhile; ?>
												</tbody>
										</table>
								</div>
<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
href="../exit.php">здесь</a>. </h5>
	</div>



<?php else: ?>


	<div class="additional-info">
		<h2 class="poll-title">Мои данные профиля</h2>

		<div class="text-content">


			<div class="text-description">
				<?php
					require 'configDB.php';
					$query = $pdo->query('SELECT * FROM `ht_users`');
					while ($row = $query->fetch(PDO::FETCH_OBJ))
					if ($row->user_login == $_COOKIE['user'])

					{
						echo '
						<h4>Логин: '.$row->user_login.' </h4>
						<h4>Никнейм: '.$row->user_nicename.' </h4>
						<h4>Электронная почта: '.$row->user_email.' </h4>
						';
					}
				?>
			</div>
		</div>

		<form  action="add.php" method="post" novalidate>
			<h4>Изменить данные профиля пользователя</h4>

			<p >
				<label for="username">Новый Логин&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
				<input type="text" class=" input-text" name="username" id="username" autocomplete="username" value="" required aria-required="true">
			</p>
				<p >
					<label for="usernicename">Никнейм&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
					<input type="text" class=" input-text" name="usernicename" id="usernicename" autocomplete="usernicename" value="" required aria-required="true">
				</p>
					<p >
						<label for="useremail">Электронная почта/Email&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
						<input type="text" class=" input-text" name="useremail" id="useremail" autocomplete="useremail" value="" required aria-required="true">
					</p>




			<p >
				<label for="password">Пароль&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text">Обязательно</span></label>
				<input class=" input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true">
			</p>


			<p class="form-row">

				<button type="submit" class=" button" name="login" value="Отправить">Отправить</button>
			</p>



		</form>
		
	<h5>Привет <?=$_COOKIE['user']?>. Чтобы выйти нажмите <a
	href="../exit.php">здесь</a>. </h5>
	</div>




<?php endif; ?>
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
