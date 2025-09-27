<?php
// event_booking_server.php - Сервер бронирования мероприятий для PHP 5.6

// Включаем вывод ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Логирование
$debugFile = 'event_booking_debug.log';
file_put_contents($debugFile, date('Y-m-d H:i:s') . " - Event booking request\n", FILE_APPEND);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Файл для хранения бронирований мероприятий
$bookingsFile = 'event_bookings.json';
$maxBookingsPerSlot = 5;

// Функция логирования
function log_event_booking($message) {
    file_put_contents('event_booking_debug.log', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Создаем файл если нет
if (!file_exists($bookingsFile)) {
    $initialData = generate_initial_event_data();
    file_put_contents($bookingsFile, json_encode($initialData));
    log_event_booking("Created initial event bookings file");
}

// Генерация начальных данных на 7 дней вперед
function generate_initial_event_data() {
    $data = array();
    $today = new DateTime();
    $timeSlots = array('10:00', '12:00', '14:00', '16:00', '18:00', '20:00');

    for ($i = 0; $i < 7; $i++) {
        $date = clone $today;
        $date->add(new DateInterval('P' . $i . 'D'));
        $dateKey = $date->format('Y-m-d');

        $data[$dateKey] = array();
        foreach ($timeSlots as $slot) {
            $data[$dateKey][$slot] = array(); // Пустой массив для броней
        }
    }

    return $data;
}

// Функция получения бронирований
function get_event_bookings() {
    global $bookingsFile;

    if (!file_exists($bookingsFile)) {
        return array();
    }

    $data = file_get_contents($bookingsFile);
    if ($data === false) {
        return array();
    }

    $bookings = json_decode($data, true);
    if ($bookings === null) {
        return array();
    }

    // Добавляем новые даты если нужно
    $updatedBookings = update_event_dates($bookings);
    if ($updatedBookings != $bookings) {
        save_event_bookings($updatedBookings);
    }

    return $updatedBookings;
}

// Обновление дат (добавляем новые дни)
function update_event_dates($bookings) {
    $timeSlots = array('10:00', '12:00', '14:00', '16:00', '18:00', '20:00');
    $today = new DateTime();
    $maxDate = clone $today;
    $maxDate->add(new DateInterval('P6D')); // 7 дней вперед

    // Находим максимальную дату в данных
    $existingDates = array_keys($bookings);
    if (!empty($existingDates)) {
        $lastDate = max($existingDates);
        $maxDate = new DateTime($lastDate);
    }

    // Добавляем новые дни если нужно
    $currentMaxDate = new DateTime($maxDate->format('Y-m-d'));
    $todayPlus6 = clone $today;
    $todayPlus6->add(new DateInterval('P6D'));

    if ($currentMaxDate < $todayPlus6) {
        $interval = $today->diff($todayPlus6);
        $daysToAdd = $interval->days;

        for ($i = 1; $i <= $daysToAdd; $i++) {
            $newDate = clone $today;
            $newDate->add(new DateInterval('P' . $i . 'D'));
            $newDateKey = $newDate->format('Y-m-d');

            if (!isset($bookings[$newDateKey])) {
                $bookings[$newDateKey] = array();
                foreach ($timeSlots as $slot) {
                    $bookings[$newDateKey][$slot] = array();
                }
            }
        }
    }

    // Удаляем старые даты (больше 7 дней назад)
    $sevenDaysAgo = clone $today;
    $sevenDaysAgo->sub(new DateInterval('P7D'));

    foreach ($bookings as $date => $slots) {
        $dateObj = new DateTime($date);
        if ($dateObj < $sevenDaysAgo) {
            unset($bookings[$date]);
        }
    }

    return $bookings;
}

// Функция сохранения бронирований
function save_event_bookings($bookings) {
    global $bookingsFile;
    return file_put_contents($bookingsFile, json_encode($bookings)) !== false;
}

// Бронирование слота мероприятия
function book_event_slot($data) {
    global $maxBookingsPerSlot;

    $bookings = get_event_bookings();

    $date = isset($data['date']) ? $data['date'] : '';
    $slot = isset($data['slot']) ? $data['slot'] : '';
    $user_id = isset($data['user_id']) ? $data['user_id'] : '';
    $user_name = isset($data['user_name']) ? $data['user_name'] : 'Гость';

    if (empty($date) || empty($slot) || empty($user_id)) {
        return array('success' => false, 'error' => 'Неполные данные');
    }

    // Проверяем, существует ли дата и слот
    if (!isset($bookings[$date][$slot])) {
        return array('success' => false, 'error' => 'Неверная дата или время');
    }

    // Проверяем, не забронировал ли уже пользователь этот слот
    foreach ($bookings[$date][$slot] as $booking) {
        if ($booking['user_id'] === $user_id) {
            return array('success' => false, 'error' => 'Вы уже забронировали этот слот');
        }
    }

    // Проверяем, есть ли свободные места
    if (count($bookings[$date][$slot]) >= $maxBookingsPerSlot) {
        return array('success' => false, 'error' => 'Нет свободных мест');
    }

    // Создаем бронь
    $newBooking = array(
        'user_id' => $user_id,
        'user_name' => $user_name,
        'booked_at' => time()
    );

    $bookings[$date][$slot][] = $newBooking;

    if (save_event_bookings($bookings)) {
        log_event_booking("Event slot booked: $date $slot by $user_name");
        return array('success' => true);
    } else {
        log_event_booking("Error saving booking: $date $slot by $user_name");
        return array('success' => false, 'error' => 'Ошибка сохранения');
    }
}

// Отмена бронирования мероприятия
function cancel_event_booking($data) {
    $bookings = get_event_bookings();

    $date = isset($data['date']) ? $data['date'] : '';
    $slot = isset($data['slot']) ? $data['slot'] : '';
    $user_id = isset($data['user_id']) ? $data['user_id'] : '';

    if (empty($date) || empty($slot) || empty($user_id)) {
        return array('success' => false, 'error' => 'Неполные данные');
    }

    // Проверяем, существует ли дата и слот
    if (!isset($bookings[$date][$slot])) {
        return array('success' => false, 'error' => 'Неверная дата или время');
    }

    // Ищем бронь пользователя
    $found = false;
    foreach ($bookings[$date][$slot] as $key => $booking) {
        if ($booking['user_id'] === $user_id) {
            unset($bookings[$date][$slot][$key]);
            $found = true;
            break;
        }
    }

    if (!$found) {
        return array('success' => false, 'error' => 'Бронь не найдена');
    }

    // Переиндексируем массив
    $bookings[$date][$slot] = array_values($bookings[$date][$slot]);

    if (save_event_bookings($bookings)) {
        log_event_booking("Event booking canceled: $date $slot by $user_id");
        return array('success' => true);
    } else {
        log_event_booking("Error canceling booking: $date $slot by $user_id");
        return array('success' => false, 'error' => 'Ошибка отмены брони');
    }
}

// Основная обработка запросов
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents('php://input');

    // Обработка FormData
    if (isset($_POST['action']) && isset($_POST['data'])) {
        $action = $_POST['action'];
        $data = json_decode($_POST['data'], true);
    }
    // Обработка JSON
    else if (!empty($input)) {
        $request = json_decode($input, true);
        $action = isset($request['action']) ? $request['action'] : '';
        $data = isset($request['data']) ? $request['data'] : array();
    } else {
        $action = '';
        $data = array();
    }

    log_event_booking("Action: $action, Data: " . print_r($data, true));

    $response = array();

    switch ($action) {
        case 'get_event_bookings':
            $bookings = get_event_bookings();
            $response = array('success' => true, 'bookings' => $bookings);
            break;

        case 'book_event_slot':
            $response = book_event_slot($data);
            break;

        case 'cancel_event_booking':
            $response = cancel_event_booking($data);
            break;

        default:
            $response = array('success' => false, 'error' => 'Неизвестное действие');
            break;
    }

    echo json_encode($response);
    exit;
}

// Для GET запросов - возвращаем текущие бронирования
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $bookings = get_event_bookings();
    echo json_encode(array('success' => true, 'bookings' => $bookings));
    exit;
}
?>
