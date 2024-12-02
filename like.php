<?php
require 'db.php';

if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    // Incrementar el contador de "me gusta"
    $stmt = $pdo->prepare('UPDATE posts SET likes = likes + 1 WHERE id = ?');
    $stmt->execute([$postId]);

    // Obtener el número actualizado de "me gusta"
    $stmt = $pdo->prepare('SELECT likes FROM posts WHERE id = ?');
    $stmt->execute([$postId]);
    $likes = $stmt->fetchColumn();

    echo $likes;
}
?>
