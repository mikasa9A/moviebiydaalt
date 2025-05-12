<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $movie_id = $_POST['movie_id'];
    $username = trim($_POST['username']);
    $comment = trim($_POST['comment']);

    if (empty($username) || empty($comment)) {
        die("Please fill in all fields.");
    }

    $stmt = $pdo->prepare("INSERT INTO reviews (movie_id, username, comment) VALUES (?, ?, ?)");
    $stmt->execute([$movie_id, $username, $comment]);

    // Redirect back to the movie details page after review submission
    header("Location: movie.php?id=" . $movie_id);
    exit;
} else {
    die("Invalid request.");
}
?>
