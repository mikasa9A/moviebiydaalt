<?php

require 'db.php'; 
$pageTitle = "Kinosan.mn - Нүүр";


$stmt = $pdo->query('SELECT * FROM movies ORDER BY rating DESC LIMIT 10');
$movies = $stmt->fetchAll();

include 'header.php';
?>
<section class="search-section">
  <form id="searchForm">
    <input type="text" name="query" placeholder="Кино хайх..." required>
    <button type="submit">Хайх</button>
  </form>
</section>

<section class="movies">
  <h2>Топ кинонууд</h2>
  <div class="movie-grid">
    <?php foreach ($movies as $movie): ?>
      <div class="movie-item">
        <a href="movie.php?id=<?= $movie['id'] ?>">
        <img src="image.php?id=<?= $movie['id'] ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
          <h3><?= htmlspecialchars($movie['title']) ?></h3>
          <p>Оноо: <?= htmlspecialchars($movie['rating']) ?></p>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php include 'footer.php'; ?>
