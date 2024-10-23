<?php
// Параметры подключения к БД
$host = 'localhost'; // хост
$db = 'alla_post'; // имя базы данных
$user = 'Alla_Post'; // имя пользователя
$pass = 'Abramova_76'; // пароль

try {
    // Подключение к БД
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Проверка метода запроса
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $order_id = $_POST['order_id'];
        $reason = $_POST['reason'];

        // SQL-запрос для вставки данных
        $sql = "INSERT INTO cancellations (order_id, reason) VALUES (:order_id, :reason)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['order_id' => $order_id, 'reason' => $reason]);

        echo "Заказ #$order_id успешно отменен!";
    }
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>