<?php

require 'db.php';

$id = $_GET['id'] ?? null;
if(!$id) {
    die("ID не передан");
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    if (trim($title) === '' || trim($content) === '') {
        die("Пожалуйста, заполните все поля.");
    }


    $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);

    header("location: index.php");
    exit;
}

$sql = "SELECT * FROM posts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) {
    die("Статья не найдена!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container edit-page">
        <h1>Редактировать статью</h1>

        <form method="POST" class="edit-form">
            <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
            <textarea name="content" placeholder="Текст..." required><?= htmlspecialchars($post['content']) ?></textarea>

            <button type="submit">Сохранить изменения</button>
            <a href="index.php" class="cancel">Отмена</a>
        </form>
    </div>
</body>
</html>