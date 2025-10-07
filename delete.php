<?php

require 'db.php';

$id = $_GET['id']  ?? null;

if(!$id) {
    die("ID не передан!");
}

$sql = "DELETE FROM posts WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

header("location: index.php");
exit;