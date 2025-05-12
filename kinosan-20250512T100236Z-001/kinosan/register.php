<?php
require 'db.php';
$pageTitle = "Kinosan.mn - Бүртгэл";
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $message = "Бүх талбаруудыг бөглөнө үү.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Зөв E-мэйл хаяг оруулна уу.";
    } elseif ($password !== $confirmPassword) {
        $message = "Нууц үг болон баталгаажуулах нууц үг таарахгүй байна.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        try {
            $stmt->execute([$username, $email, $hash]);
            $message = "Бүртгэл амжилттай боллоо. Та одоо нэвтэрнэ үү!";
            // Optionally, redirect to login.php after a successful registration:
            // header("Location: login.php");
            // exit;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            $message = "Энэ E-мэйл аль хэдийн бүртгэлтэй эсвэл бүртгэлд алдаа гарлаа.";
        }
    }
}
include 'header.php';
?>

<!-- Inline styles for the modal to maintain original GUI -->
<style>
  /* Full-screen modal overlay */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 999;
  }
  .modal {
    background: #fff;
    width: 400px;
    max-width: 90%;
    padding: 20px;
    border-radius: 8px;
    position: relative;
  }
  .modal-header h2 {
    font-size: 1.4rem;
    margin-bottom: 5px;
  }
  .modal-header p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 15px;
  }
  form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  form input[type="email"],
  form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  button[type="submit"] {
    width: 100%;
    background: #3498db;
    color: #fff;
    border: none;
    padding: 10px;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background: #2980b9;
  }
  .registration-link {
    margin-top: 15px;
    text-align: center;
  }
  .registration-link a {
    color: #3498db;
    text-decoration: none;
  }
  .message {
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
  }
  .message.error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }
  .message.success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
</style>

<div class="modal-overlay">
  <div class="modal">
    <div class="modal-header">
      <h2>Бүртгэл</h2>
      <p>Та дэлгэрэнгүй мэдээллээ оруулна уу.</p>
    </div>
    <?php if ($message): ?>
      <div class="message <?php echo (strpos($message, 'амжилттай') !== false) ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($message); ?>
      </div>
    <?php endif; ?>
    <form method="POST" action="register.php">
      <label for="username">Хэрэглэгчийн нэр</label>
      <input type="text" id="username" name="username" placeholder="Хэрэглэгчийн нэрээ оруулна уу" required>
      
      <label for="email">E-мэйл хаяг</label>
      <input type="email" id="email" name="email" placeholder="E-мэйл хаягаа оруулна уу" required>
      
      <label for="password">Нууц үг</label>
      <input type="password" id="password" name="password" placeholder="Нууц үгээ оруулна уу" required>
      
      <label for="confirm_password">Нууц үг баталгаажуулах</label>
      <input type="password" id="confirm_password" name="confirm_password" placeholder="Нууц үгээ дахин оруулна уу" required>
      
      <button type="submit">Бүртгүүлэх</button>
    </form>
    <div class="registration-link">
      <p>Хэрэв та бүртгэлтэй бол <a href="login.php">Нэвтрэх</a> хэсэг рүү орно уу.</p>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>