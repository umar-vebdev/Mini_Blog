<?php

require 'db.php';

$sql = "SELECT * FROM posts ORDER BY id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мой блог</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Мой блог</h1>
        <a href="add.php" class="add-btn">Добавить статью</a>
        <hr>
        
        <?php foreach($posts as $post): ?>
            <div class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= htmlspecialchars(mb_substr($post['content'], 0, 150)) ?>...</p>
                <small><?= htmlspecialchars($post['created_at']) ?></small>

                <div class="actions">
                    <a href="view.php?id=<?= $post['id'] ?>">Подробнее</a> |
                    <a href="edit.php?id=<?= $post['id'] ?>">Редактировать</a> |
                    <a href="delete.php?id=<?= $post['id'] ?>" onclick="return confirm('Удалить статью?')">Удалить</a>
                </div>
            </div>
            <?php endforeach; ?>
    </div>
</body>
</html>