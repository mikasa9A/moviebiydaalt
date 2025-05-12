<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="UTF-8">
  <!-- If a page sets $pageTitle, it will be shown; otherwise a default title is used -->
  <title><?php echo isset($pageTitle) ? $pageTitle : 'Kinosan.mn'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <div class="container header-container">
      <h1 class="logo"><a href="index.php">Kinosan.mn</a></h1>
      <nav>
        <ul>
  <li><a href="index.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'class="active"' : ''; ?>>Нүүр</a></li>
  <li><a href="movie.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'movie.php') ? 'class="active"' : ''; ?>>Кинонууд</a></li>
  <li><a href="news.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'news.php') ? 'class="active"' : ''; ?>>Мэдээ</a></li>
  <li><a href="about.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'class="active"' : ''; ?>>Бидний тухай</a></li>
  <li><a href="help.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'help.php') ? 'class="active"' : ''; ?>>Тусламж</a></li>
  <li><a href="login.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'login.php') ? 'class="active"' : ''; ?>>Нэвтрэх</a></li>
  <li><a href="register.php" <?php echo (basename($_SERVER['PHP_SELF']) == 'register.php') ? 'class="active"' : ''; ?>>Бүртгүүлэх</a></li>
</ul>
      </nav>
      <button id="menuToggle">☰</button>
    </div>
  </header>
  <main class="container">
