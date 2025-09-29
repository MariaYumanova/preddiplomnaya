<?php
// Для PHP 5.6 - старая версия синтаксиса

// Простейшая проверка авторизации
if (!isset($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

// Базовая директория
$base_dir = $_SERVER['DOCUMENT_ROOT'];
$current_dir = $base_dir;

// Обработка параметра dir (старый синтаксис)
if (isset($_GET['dir']) && !empty($_GET['dir'])) {
    $requested_dir = $base_dir . '/' . $_GET['dir'];
    if (is_dir($requested_dir)) {
        $current_dir = $requested_dir;
    }
}

// Простые функции (без современного синтаксиса)
if (isset($_GET['action']) && isset($_GET['file'])) {
    $file_path = $base_dir . '/' . $_GET['file'];

    if (file_exists($file_path)) {
        switch ($_GET['action']) {
            case 'download':
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
                readfile($file_path);
                exit();
                break;

            case 'view':
                if (is_file($file_path)) {
                    header('Content-Type: text/plain');
                    readfile($file_path);
                    exit();
                }
                break;

            case 'delete':
                if (is_file($file_path)) {
                    unlink($file_path);
                } elseif (is_dir($file_path)) {
                    // Простое удаление пустой папки
                    rmdir($file_path);
                }
                $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
                header('Location: ?dir=' . urlencode($redirect_dir));
                exit();
                break;
        }
    }
}

// Загрузка файлов (старый синтаксис)
if (isset($_POST['upload']) && isset($_FILES['file'])) {
    $target_file = $current_dir . '/' . basename($_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
        header('Location: ?dir=' . urlencode($redirect_dir));
        exit();
    }
}

// Создание папки (старый синтаксис)
if (isset($_POST['create_folder']) && !empty($_POST['folder_name'])) {
    $new_folder = $current_dir . '/' . $_POST['folder_name'];
    if (!file_exists($new_folder)) {
        mkdir($new_folder, 0755);
        $redirect_dir = isset($_GET['dir']) ? $_GET['dir'] : '';
        header('Location: ?dir=' . urlencode($redirect_dir));
        exit();
    }
}

// Получаем список файлов (старый синтаксис массивов)
$files = scandir($current_dir);
$files = array_diff($files, array('.', '..'));

// Функция для размера файла
function formatSize($bytes) {
    if ($bytes == 0) return '0 B';
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    $i = floor(log($bytes, 1024));
    return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Файловый менеджер — Student IT Community</title>
  <link rel="stylesheet" href="/style.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }

        h1 { color: #2c3e50; text-align: center; }
        .breadcrumb { background: #e8f4f8; padding: 10px; border-radius: 5px; margin: 15px 0; }
        .breadcrumb a { color: #3498db; text-decoration: none; }
        .file-list { list-style: none; padding: 0; margin: 20px 0; }
        .file-item { padding: 12px; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .file-item:hover { background: #f8f9fa; }
        .file-icon { margin-right: 10px; font-size: 18px; }
        .folder { color: #2c3e50; font-weight: bold; text-decoration: none; font-size: 16px; }
        .file-actions { display: flex; gap: 8px; }
        .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px; border: none; cursor: pointer; }
        .btn-view { background: #3498db; color: white; }
        .btn-download { background: #27ae60; color: white; }
        .btn-delete { background: #e74c3c; color: white; }
        .upload-form, .create-folder { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .file-info { font-size: 12px; color: #7f8c8d; margin-top: 5px; }
        .debug-info { background: #ffeaa7; padding: 15px; border-radius: 5px; margin: 15px 0; font-family: monospace; }
        input[type="file"], input[type="text"] { padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin: 5px 0; }
        button { background: #3498db; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #2980b9; }
    </style>
</head>

<body>
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


  <main class="container">
    <div class="breadcrumb">
        <a href="/">Главная</a> > Файловый менеджер
    </div>
		<header class="entry-header">
			<h1 class="page-title">Файловый менеджер</h1>
		</header>
		<div class="main-content">

			<div class="entry-content">

					<h2 class="poll-title">Файловый менеджер</h2>
    <div class="container">
        <h1>📁 Файловый менеджер</h1>

        <div class="breadcrumb">
            <a href="?">Корень сайта</a>
            <?php
            if (isset($_GET['dir'])) {
                $parts = explode('/', $_GET['dir']);
                $current_path = '';
                foreach ($parts as $part) {
                    if (!empty($part)) {
                        $current_path .= $current_path ? '/' . $part : $part;
                        echo ' / <a href="?dir=' . $current_path . '">' . $part . '</a>';
                    }
                }
            }
            ?>
        </div>

        <h3>Папка: <?php echo basename($current_dir); ?></h3>

        <?php if (empty($files)): ?>
            <p>Папка пуста</p>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
            <?php
            $file_path = $current_dir . '/' . $file;
            $is_dir = is_dir($file_path);
            $file_size = $is_dir ? '' : formatSize(filesize($file_path));
            $relative_path = isset($_GET['dir']) ? $_GET['dir'] . '/' . $file : $file;
            $current_dir_param = isset($_GET['dir']) ? $_GET['dir'] : '';
            ?>
            <div class="file-item">
                <div>
                    <?php if ($is_dir): ?>
                        <strong>📁</strong>
                        <a href="?dir=<?php echo $relative_path; ?>" style="color: #2c3e50; text-decoration: none;">
                            <?php echo $file; ?>/
                        </a>
                    <?php else: ?>
                        <strong>📄</strong> <?php echo $file; ?>
                    <?php endif; ?>
                    <?php if (!$is_dir): ?>
                        <br><small>Размер: <?php echo $file_size; ?></small>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if (!$is_dir): ?>
                        <a href="?action=view&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-view">Просмотр</a>
                        <a href="?action=download&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-download">Скачать</a>
                    <?php endif; ?>
                    <a href="?action=delete&file=<?php echo $relative_path; ?>&dir=<?php echo $current_dir_param; ?>" class="btn btn-delete"
                       onclick="return confirm('Удалить <?php echo $file; ?>?')">Удалить</a>
                </div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="upload-form">
            <h4>📤 Загрузить файл</h4>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" required style="margin: 10px 0; display: block;">
                <button type="submit" name="upload" style="background: #3498db; color: white; padding: 10px; border: none; border-radius: 3px; cursor: pointer;">Загрузить файл</button>
            </form>
        </div>

        <div class="upload-form">
            <h4>📂 Создать папку</h4>
            <form method="post">
                <input type="text" name="folder_name" placeholder="Название папки" required style="padding: 8px; width: 300px; margin: 10px 0; display: block;">
                <button type="submit" name="create_folder" style="background: #27ae60; color: white; padding: 10px; border: none; border-radius: 3px; cursor: pointer;">Создать папку</button>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function confirmDelete(filename) {
            return confirm('Вы уверены, что хотите удалить ' + filename + '?');
        }
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

