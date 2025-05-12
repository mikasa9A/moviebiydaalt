<?php
$id = $_GET['id'];
$pdo = new PDO('mysql:host=localhost;dbname=kinosan', 'root', '');
$stmt = $pdo->prepare("SELECT image FROM movies WHERE id = ?");
$stmt->execute([$id]);
$image = $stmt->fetchColumn();

header("Content-Type: image/jpeg"); // or png, etc.
echo $image;
