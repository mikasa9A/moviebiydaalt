<?php
// movie.php
session_start();  // Start the session to access user details
require 'db.php';

// Validate and retrieve the movie ID from the query string
$movieId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($movieId <= 0) {
    die("Invalid movie ID.");
}

// Fetch the movie details from the database
$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$movieId]);
$movie = $stmt->fetch();

$pageTitle = $movie ? htmlspecialchars($movie['title']) . " - Kinosan.mn" : "Кино олдсонгүй";
include 'header.php';
?>

<div id="movie-detail">
  <?php if ($movie): ?>
    <div class="movie-detail">
      <?php if (!empty($movie['image'])): ?>
        <!-- Display image as base64 encoded -->
        <img src="data:image/jpeg;base64,<?= base64_encode($movie['image']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
      <?php else: ?>
        <img src="path/to/default-image.jpg" alt="No Image Available">
      <?php endif; ?>
      <div class="movie-info">
        <h2><?= htmlspecialchars($movie['title']) ?></h2>
        <p><?= htmlspecialchars($movie['description']) ?></p>
        <p><strong>Оноо:</strong> <?= htmlspecialchars($movie['rating']) ?></p>
      </div>
    </div>

    <!-- Review Section -->
    <section class="reviews">
      <h2>Leave a Review</h2>
      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- If user is logged in, use their username automatically -->
        <p>Нэвтрүүлсэн хэрэглэгч: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>
        <form action="submit_review.php" method="POST">
          <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
          <input type="hidden" name="username" value="<?= htmlspecialchars($_SESSION['username']) ?>">
          <textarea name="comment" id="comment" placeholder="Your review..." required></textarea>
          <br>
          <button type="submit">Submit Review</button>
        </form>
      <?php else: ?>
        <!-- If user is not logged in, require a username entry -->
        <p>Хэрэв та нэвтрүүлээгүй бол хүлээн авсан хэрэглэгчийн нэрийг оруулна уу.</p>
        <form action="submit_review.php" method="POST">
          <input type="hidden" name="movie_id" value="<?= $movie['id'] ?>">
          <label for="username">Your Name:</label>
          <input type="text" name="username" id="username" placeholder="Your name" required>
          <br>
          <textarea name="comment" id="comment" placeholder="Your review..." required></textarea>
          <br>
          <button type="submit">Submit Review</button>
        </form>
      <?php endif; ?>

      <h2>Reviews</h2>
      <?php
        // Fetch all reviews for this movie, ordered by most recent
        $reviewStmt = $pdo->prepare("SELECT username, comment, created_at FROM reviews WHERE movie_id = ? ORDER BY created_at DESC");
        $reviewStmt->execute([$movieId]);
        $reviews = $reviewStmt->fetchAll();
      ?>
      <?php if ($reviews): ?>
        <?php foreach ($reviews as $review): ?>
          <div class="review-item">
            <strong><?= htmlspecialchars($review['username']) ?></strong>
            <small><?= $review['created_at'] ?></small>
            <p><?= nl2br(htmlspecialchars($review['comment'])) ?></p>
          </div>
          <hr>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No reviews yet. Be the first!</p>
      <?php endif; ?>
    </section>
  <?php else: ?>
    <p>Кино олдсонгүй.</p>
  <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
