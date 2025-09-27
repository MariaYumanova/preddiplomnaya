<?php
// chat_server.php - Сервер чата для PHP 5.6

// Включаем вывод ошибок
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Логирование
$debugFile = 'chat_debug.log';
file_put_contents($debugFile, date('Y-m-d H:i:s') . " - Chat request\n", FILE_APPEND);

header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Файл для хранения сообщений
$messagesFile = 'chat_messages.json';
$onlineUsersFile = 'online_users.json';

// Функция логирования
function log_chat($message) {
    file_put_contents('chat_debug.log', date('Y-m-d H:i:s') . " - " . $message . "\n", FILE_APPEND);
}

// Создаем файлы если нет
if (!file_exists($messagesFile)) {
    file_put_contents($messagesFile, json_encode(array()));
    log_chat("Created messages file");
}

if (!file_exists($onlineUsersFile)) {
    file_put_contents($onlineUsersFile, json_encode(array()));
}

// Функция получения сообщений
function get_messages() {
    global $messagesFile;

    if (!file_exists($messagesFile)) {
        return array();
    }

    $data = file_get_contents($messagesFile);
    if ($data === false) {
        return array();
    }

    $messages = json_decode($data, true);
    if ($messages === null) {
        return array();
    }

    // Ограничиваем историю 100 сообщениями
    if (count($messages) > 100) {
        $messages = array_slice($messages, -100);
        save_messages($messages);
    }

    return $messages;
}

// Функция сохранения сообщений
function save_messages($messages) {
    global $messagesFile;
    return file_put_contents($messagesFile, json_encode($messages)) !== false;
}

// Функция управления онлайн пользователями
function update_online_users($user_id, $user_name, $action = 'update') {
    global $onlineUsersFile;

    $onlineUsers = array();
    if (file_exists($onlineUsersFile)) {
        $data = file_get_contents($onlineUsersFile);
        if ($data !== false) {
            $onlineUsers = json_decode($data, true);
            if ($onlineUsers === null) {
                $onlineUsers = array();
            }
        }
    }

    $timestamp = time();

    if ($action === 'update') {
        $onlineUsers[$user_id] = array(
            'user_name' => $user_name,
            'last_seen' => $timestamp
        );
    } elseif ($action === 'remove') {
        if (isset($onlineUsers[$user_id])) {
            unset($onlineUsers[$user_id]);
        }
    }

    // Удаляем неактивных пользователей (более 5 минут)
    foreach ($onlineUsers as $id => $user) {
        if ($timestamp - $user['last_seen'] > 300) { // 5 минут
            unset($onlineUsers[$id]);
        }
    }

    file_put_contents($onlineUsersFile, json_encode($onlineUsers));
    return count($onlineUsers);
}

// Отправка сообщения
function send_message($data) {
    $messages = get_messages();

    $text = isset($data['text']) ? trim($data['text']) : '';
    $user_id = isset($data['user_id']) ? $data['user_id'] : '';
    $user_name = isset($data['user_name']) ? $data['user_name'] : 'Гость';
    $user_role = isset($data['user_role']) ? $data['user_role'] : 'user';

    if (empty($text) || empty($user_id)) {
        return array('success' => false, 'error' => 'Неполные данные');
    }

    // Создаем новое сообщение
    $new_id = 1;
    if (!empty($messages)) {
        $last_msg = end($messages);
        $new_id = $last_msg['id'] + 1;
    }

    $new_message = array(
        'id' => $new_id,
        'text' => $text,
        'user_id' => $user_id,
        'user_name' => $user_name,
        'user_role' => $user_role,
        'time' => date('H:i'),
        'timestamp' => time()
    );

    $messages[] = $new_message;

    if (save_messages($messages)) {
        // Обновляем онлайн статус
        $online_count = update_online_users($user_id, $user_name, 'update');

        log_chat("Message sent by $user_name: " . substr($text, 0, 50));
        return array('success' => true, 'message' => $new_message, 'online_count' => $online_count);
    } else {
        return array('success' => false, 'error' => 'Ошибка сохранения');
    }
}

// Получение новых сообщений
function get_new_messages($last_id) {
    $messages = get_messages();
    $new_messages = array();

    foreach ($messages as $msg) {
        if (isset($msg['id']) && $msg['id'] > $last_id) {
            $new_messages[] = $msg;
        }
    }

    // Получаем количество онлайн пользователей
    $online_count = 0;
    global $onlineUsersFile;
    if (file_exists($onlineUsersFile)) {
        $data = file_get_contents($onlineUsersFile);
        if ($data !== false) {
            $onlineUsers = json_decode($data, true);
            if (is_array($onlineUsers)) {
                $online_count = count($onlineUsers);
            }
        }
    }

    return array('success' => true, 'messages' => $new_messages, 'online_count' => $online_count);
}

// Получение истории сообщений
function get_message_history() {
    $messages = get_messages();

    // Получаем количество онлайн пользователей
    $online_count = 0;
    global $onlineUsersFile;
    if (file_exists($onlineUsersFile)) {
        $data = file_get_contents($onlineUsersFile);
        if ($data !== false) {
            $onlineUsers = json_decode($data, true);
            if (is_array($onlineUsers)) {
                $online_count = count($onlineUsers);
            }
        }
    }

    return array('success' => true, 'messages' => $messages, 'online_count' => $online_count);
}

// Получаем данные запроса
$input = file_get_contents('php://input');
log_chat("Input: " . substr($input, 0, 200));

$action = '';
$request_data = array();

if (!empty($_POST['action'])) {
    $action = $_POST['action'];
    if (!empty($_POST['data'])) {
        $request_data = json_decode($_POST['data'], true);
        if ($request_data === null) {
            $request_data = array();
        }
    }
} elseif (!empty($input)) {
    $data = json_decode($input, true);
    if ($data !== null) {
        $action = isset($data['action']) ? $data['action'] : '';
        $request_data = isset($data['data']) ? $data['data'] : array();
    }
}

log_chat("Action: " . $action);

// Обработка запросов
$response = array('success' => false, 'error' => 'Unknown action');

try {
    switch ($action) {
        case 'get_messages':
            $response = get_message_history();
            log_chat("Sent " . count($response['messages']) . " messages");
            break;

        case 'get_new_messages':
            $last_id = isset($request_data['last_id']) ? intval($request_data['last_id']) : 0;
            $response = get_new_messages($last_id);
            log_chat("New messages: " . count($response['messages']));
            break;

        case 'send_message':
            $response = send_message($request_data);
            break;

        default:
            $response = array('success' => false, 'error' => 'Unknown action: ' . $action);
    }

} catch (Exception $e) {
    log_chat("Exception: " . $e->getMessage());
    $response = array('success' => false, 'error' => 'Server error');
}

// Отправляем ответ
echo json_encode($response);
log_chat("Response: " . substr(json_encode($response), 0, 200));
?>
