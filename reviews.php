<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отзывы о товаре</title>
</head>
<body>
    <h1>Добавить отзыв о товаре</h1>
    <form action="index.php" method="POST">
        <label for="name">Ваше имя:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="review">Ваш отзыв:</label>
        <textarea id="review" name="review" required></textarea>
        <br>
        <label for="rating">Рейтинг (1-5):</label>
        <input type="number" id="rating" name="rating" min="1" max="5" required>
        <br>
        <button type="submit">Отправить отзыв</button>
    </form>

    <h2>Отзывы о товаре</h2>
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
            $name = $_POST['name'];
            $review = $_POST['review'];
            $rating = $_POST['rating'];

            // SQL-запрос для вставки отзыва
            $sql = "INSERT INTO reviews (name, review, rating) VALUES (:name, :review, :rating)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $name, 'review' => $review, 'rating' => $rating]);

            echo "<p>Спасибо за ваш отзыв!</p>";
        }

        // Получение всех отзывов
        $sql = "SELECT * FROM reviews";
        $stmt = $pdo->query($sql);
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Вывод отзывов на странице
        foreach ($reviews as $review) {
            echo "<p><strong>{$review['name']}</strong>: {$review['review']} (Рейтинг: {$review['rating']})</p>";
        }
    } catch (PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
    }
    ?>
</body>
</html>