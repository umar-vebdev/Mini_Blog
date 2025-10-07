<?php

require 'db.php';

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (trim($title) === '' || trim($content) === '') {
        die("Пожалуйста, заполните все поля.");
    }

    $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' =>$content]);

    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Добавить статью</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Добавить статью</h1>

    <form method="POST" class="add-form">
      <input type="text" name="title" placeholder="Заголовок статьи" required>
      <textarea name="content" placeholder="Текст..." required></textarea>
      <button type="submit">Создать статью</button>
      <a href="index.php" class="cancel">Отмена</a>
    </form>
  </div>
</body>
</html>