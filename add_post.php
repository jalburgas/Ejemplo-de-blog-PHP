<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $imagePath = null;

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        $imagePath = $targetDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $stmt = $pdo->prepare('INSERT INTO posts (title, content, date, duration, image) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$title, $content, $date, $duration, $imagePath]);

    header('Location: admin.php');
}
?>

