    <?php

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'blog_db';
    $charset = 'utf8mb4';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db; charset=$charset", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch(PDOException $e) {
        die("Ошибка подключения: " . $e->getMessage());
    }