
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отзывы — Student IT Community</title>
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/styleH.css">
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
    <div class="breadcrumb">
        <a href="/">Главная</a> > Отзывы
    </div>
		<header class="entry-header">
			<h1 class="page-title">Отзывы</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">



				<div class="poll-container">
					<h2 class="poll-title">Отзывы</h2>
          <?php
  					if ($_COOKIE['user'] == ''):


  				?>

          <form class="form-review" action="add.php" method="post">
              <div class="row">
                  <div class="">
                      <label for="taskName" class="form-label">Ваше имя</label>
                      <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Введите ваше имя" required>
                  </div>

                  <div class="">
                      <label for="taskTelephone" class="form-label">Номер телефона</label>
                      <input type="tel" class="form-control" name="taskTelephone" id="taskTelephone" placeholder="Введите номер телефона" required>
                  </div>

                  <div class="">
                      <label for="taskEmail" class="form-label">Электронная почта</label>
                      <input type="email" class="form-control" name="taskEmail" id="taskEmail" placeholder="email@example.com" required>
                  </div>

                  <div class="">
                      <label for="taskOcen" class="form-label">Оценка (0 - 9)</label>
                      <input type="number" class="form-control" name="taskOcen" id="taskOcen" min="0" max="9" required>
                  </div>
              </div>

              <label for="taskKomm" class="form-label">Комментарий</label>
              <textarea class="form-control" name="taskKomm" id="taskKomm" required></textarea>

              <button class="btn-submit" name="sendTask" type="submit">Отправить отзыв</button>
          </form>

          <div class="vivodOtz">
            <h2 class="reviews-title">Оставленные отзывы</h2><br>
            <?php
              require '../my-account/configDB.php';

              echo '<ul>';
              $query = $pdo->query('SELECT * FROM `ht_taskspol`ORDER BY `id` DESC');
              while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                echo '
                <li class="review-item">
                    <div class="review-header">
                        <h3 class="review-author">'.$row->taskName.'</h3>
                        <span class="review-rating">Оценка: '.$row->taskOcen.'/9</span>
                    </div>
                    <p class="review-content">'.$row->taskKomm.'</p>
                    <div class="review-meta">
                        <span>Телефон: '.$row->taskTelephone.'</span>
                        <span>Email: '.$row->taskEmail.'</span>
                    </div>
                </li>';
              }
              echo '</ul>';
            ?>
          </div>


          <?php
            elseif ($_COOKIE['user'] == 'admin1'):


          ?>

          <form class="form-review" action="add.php" method="post">
              <div class="row">
                  <div class="">
                      <label for="taskName" class="form-label">Ваше имя</label>
                      <input type="text" class="form-control" name="taskName" id="taskName" placeholder="Введите ваше имя" required>
                  </div>

                  <div class="">
                      <label for="taskTelephone" class="form-label">Номер телефона</label>
                      <input type="tel" class="form-control" name="taskTelephone" id="taskTelephone" placeholder="Введите номер телефона" required>
                  </div>

                  <div class="">
                      <label for="taskEmail" class="form-label">Электронная почта</label>
                      <input type="email" class="form-control" name="taskEmail" id="taskEmail" placeholder="email@example.com" required>
                  </div>

                  <div class="">
                      <label for="taskOcen" class="form-label">Оценка (0 - 9)</label>
                      <input type="number" class="form-control" name="taskOcen" id="taskOcen" min="0" max="9" required>
                  </div>
              </div>

              <label for="taskKomm" class="form-label">Комментарий</label>
              <textarea class="form-control" name="taskKomm" id="taskKomm" required></textarea>

              <button class="btn-submit" name="sendTask" type="submit">Отправить отзыв</button>
          </form>

          <div class="vivodOtz">
            <h2 class="reviews-title">Оставленные отзывы</h2><br>
            <?php
              require '../my-account/configDB.php';

              echo '<ul>';
              $query = $pdo->query('SELECT * FROM `ht_taskspol`ORDER BY `id` DESC');
              while ($row = $query->fetch(PDO::FETCH_OBJ)) {
                echo '
                <li class="review-item">
                    <div class="review-header">
                        <h3 class="review-author">'.$row->taskName.'</h3>
                        <span class="review-rating">Оценка: '.$row->taskOcen.'/9</span>
                    </div>
                    <p class="review-content">'.$row->taskKomm.'</p>
                    <div class="review-meta">
                        <span>Телефон: '.$row->taskTelephone.'</span>
                        <span>Email: '.$row->taskEmail.'</span>
                    </div>
                    <a href="../my-account/admin/deleteOtz.php?id='.$row->id.'" ><button class="btn-submit">Удалить</button></a>
                </li>';
              }
              echo '</ul>';
            ?>
          </div>






        <?php endif; ?>


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

