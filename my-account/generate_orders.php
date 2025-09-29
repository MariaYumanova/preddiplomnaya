<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Проверка авторизации
if (empty($_COOKIE['user']) || $_COOKIE['user'] != 'admin1') {
    die("Доступ запрещен. Требуется авторизация администратора.");
}

// Подключение к БД
require 'configDB.php';

// Получение данных
try {
    $query = $pdo->query('SELECT * FROM `ht_order_addresses` ORDER BY `order_id` DESC');
    $orders = $query->fetchAll(PDO::FETCH_OBJ);
} catch (PDOException $e) {
    die("Ошибка получения данных: " . $e->getMessage());
}

// Обработка формы
if (isset($_POST['generate'])) {
    $format = $_POST['format'];

    try {
        switch ($format) {
            case 'xlsx':
                generateExcel($orders);
                break;

            case 'docx':
                generateWord($orders);
                break;

            case 'csv':
                generateCSV($orders);
                break;

            default:
                die("Неизвестный формат: $format");
        }
    } catch (Exception $e) {
        die("Ошибка генерации: " . $e->getMessage());
    }
}

// Функция генерации Excel
function generateExcel($orders) {
    // Создаем простой HTML который Excel откроет как XLS
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="orders_export.xls"');

    echo '<html><head><meta charset="UTF-8"></head><body>';
    echo '<table border="1">';
    echo '<tr style="background-color: #40B198; color: white; font-weight: bold;">';
    echo '<th>ID заказа</th><th>Тип адреса</th><th>Имя</th><th>Фамилия</th><th>Адрес 1</th><th>Адрес 2</th><th>Город</th><th>Индекс</th><th>Страна</th><th>Email</th><th>Телефон</th>';
    echo '</tr>';

    foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($order->order_id) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_type) . '</td>';
        echo '<td>' . htmlspecialchars($order->first_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->last_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_1) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_2) . '</td>';
        echo '<td>' . htmlspecialchars($order->city) . '</td>';
        echo '<td>' . htmlspecialchars($order->postcode) . '</td>';
        echo '<td>' . htmlspecialchars($order->country) . '</td>';
        echo '<td>' . htmlspecialchars($order->email) . '</td>';
        echo '<td>' . htmlspecialchars($order->phone) . '</td>';
        echo '</tr>';
    }

    echo '</table></body></html>';
    exit;
}

// Функция генерации Word
function generateWord($orders) {
    // Создаем простой HTML который Word откроет как DOC
    header('Content-Type: application/msword');
    header('Content-Disposition: attachment; filename="orders_export.doc"');

    echo '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">';
    echo '<head><meta charset="UTF-8"><title>Экспорт заказов</title></head>';
    echo '<body>';
    echo '<h1>Экспорт заказов</h1>';
    echo '<p>Дата формирования: ' . date('d.m.Y H:i') . '</p>';
    echo '<p>Всего заказов: ' . count($orders) . '</p>';

    echo '<table border="1" cellpadding="5" style="border-collapse: collapse; width: 100%;">';
    echo '<tr style="background-color: #40B198; color: white;">';
    echo '<th>ID заказа</th><th>Тип адреса</th><th>Имя</th><th>Фамилия</th><th>Email</th><th>Телефон</th>';
    echo '</tr>';

    foreach ($orders as $order) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($order->order_id) . '</td>';
        echo '<td>' . htmlspecialchars($order->address_type) . '</td>';
        echo '<td>' . htmlspecialchars($order->first_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->last_name) . '</td>';
        echo '<td>' . htmlspecialchars($order->email) . '</td>';
        echo '<td>' . htmlspecialchars($order->phone) . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</body></html>';
    exit;
}

// Функция генерации CSV
function generateCSV($orders) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="orders_export.csv"');

    $output = fopen('php://output', 'w');
    fwrite($output, "\xEF\xBB\xBF"); // BOM для UTF-8

    fputcsv($output, [
        'ID заказа', 'Тип адреса', 'Имя', 'Фамилия', 'Адрес 1',
        'Адрес 2', 'Город', 'Индекс', 'Страна', 'Email', 'Телефон'
    ], ';');

    foreach ($orders as $order) {
        fputcsv($output, [
            $order->order_id,
            $order->address_type,
            $order->first_name,
            $order->last_name,
            $order->address_1,
            $order->address_2,
            $order->city,
            $order->postcode,
            $order->country,
            $order->email,
            $order->phone
        ], ';');
    }

    fclose($output);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Генерация отчетов по заказам  — Student IT Community</title>
  <link rel="stylesheet" href="/style.css">
    <style>

        .format-option {
            padding: 20px;
            margin: 15px 0;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .format-option:hover {
            border-color: #40B198;
            background: #f8f9fa;
        }
        .format-option input[type="radio"] {
            margin-right: 15px;
        }
        .format-option label {
            cursor: pointer;
            display: flex;
            align-items: center;
            font-size: 18px;
        }
        .format-icon {
            font-size: 24px;
            margin-right: 15px;
        }
        .btn-generate {
            background: #40B198;
            color: white;
            padding: 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
            font-weight: bold;
            margin-top: 30px;
            transition: background 0.3s;
        }
        .btn-generate:hover {
            background: #3BA38C;
        }
        .stats {
            background: #e8f5e8;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin: 20px 0;
        }
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
        <a href="/">Главная</a> > Генерация отчетов
    </div>
    <div class="container">
        <h1 style="text-align: center; color: #2c3e50; margin-bottom: 30px;">📊 Генерация отчетов по заказам</h1>

        <div class="stats">
            <h2>Найдено заказов: <span style="color: #40B198;"><?= count($orders) ?></span></h2>
        </div>

        <form method="post">
            <h3 style="color: #2c3e50; margin-bottom: 20px;">Выберите формат:</h3>

            <div class="format-option">
                <input type="radio" name="format" value="xlsx" id="xlsx" required>
                <label for="xlsx">
                    <span class="format-icon">📈</span>
                    Excel файл (.xls)
                </label>
            </div>

            <div class="format-option">
                <input type="radio" name="format" value="docx" id="docx">
                <label for="docx">
                    <span class="format-icon">📝</span>
                    Word документ (.doc)
                </label>
            </div>

            <div class="format-option">
                <input type="radio" name="format" value="csv" id="csv">
                <label for="csv">
                    <span class="format-icon">📊</span>
                    CSV файл (для Excel)
                </label>
            </div>

            <button type="submit" name="generate" class="btn-generate">
                🚀 Сгенерировать отчет
            </button>
        </form>

        <div style="text-align: center; margin-top: 30px;">
            <a href="/my-account/" style="color: #666; text-decoration: none; font-size: 16px;">
                ← Вернуться к списку заказов
            </a>
        </div>

        <div style="margin-top: 30px; padding: 20px; background: #fff3cd; border-radius: 8px;">
            <h4>💡 Как использовать:</h4>
            <p><strong>Excel:</strong> Файл откроется в Microsoft Excel</p>
            <p><strong>Word:</strong> Файл откроется в Microsoft Word</p>
            <p><strong>CSV:</strong> Импортируйте в Excel через "Данные → Из текста/CSV"</p>
        </div>
    </div>

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

