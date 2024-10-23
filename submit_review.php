<?php
// Настройки подключения к БД
$host = 'localhost'; // хост
$db = 'alla_post'; // имя базы данных
$user = 'Alla_Post'; // имя пользователя
$pass = 'Abramova_76'; // пароль

try {
    // Подключение к БД
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Получение данных из формы
        $name = $_POST['name'];
        $review = $_POST['review'];
        $rating = (int) $_POST['rating'];

        // SQL-запрос на вставку данных
        $sql = "INSERT INTO reviews (name, review, rating) VALUES (:name, :review, :rating)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'review' => $review, 'rating' => $rating]);

        echo "Отзыв успешно добавлен!";
    }
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}
?>