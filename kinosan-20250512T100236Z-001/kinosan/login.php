<?php
session_start();
require 'db.php';



$pageTitle = "Kinosan.mn - Нэвтрэх";
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';
  
  if (empty($email) || empty($password)) {
       $message = "Бүх талбаруудыг бөглөнө үү.";
  } else {
       $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
       $stmt->execute([$email]);
       $user = $stmt->fetch();


       if ($user && isset($user['password']) && password_verify($password, $user['password'])) {
        // Store both user id and username in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $message = "Буруу E-мэйл эсвэл нууц үг.";
    }
    
  }
}

include 'header.php';
?>


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
  .login-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
  }
  .login-form input[type="email"],
  .login-form input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  .options {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 15px;
  }
  .options label {
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 5px;
  }
  .options a {
    font-size: 0.9rem;
    color: #3498db;
    text-decoration: none;
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
</style>

<div class="modal-overlay">
  <div class="modal">
    <div class="modal-header">
      <h2>Нэвтрэх</h2>
      <p>Тавтай морилно уу!</p>
    </div>
    <?php if($message): ?>
      <div class="message error"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" class="login-form" action="login.php">
      <label for="email">E-мэйл хаяг</label>
      <input type="email" id="email" name="email" placeholder="E-мэйл хаягаа оруулна уу" required>
      
      <label for="password">Нууц үг</label>
      <input type="password" id="password" name="password" placeholder="Нууц үгээ оруулна уу" required>
      
      <div class="options">
        <label><input type="checkbox" name="remember"> Сануулах уу?</label>
        <a href="#">Нууц үг сэргээх?</a>
      </div>
      
      <button type="submit">Нэвтрэх</button>
    </form>
    <div class="registration-link">
      <p>Бүртгэл үүсгэх үү? <a href="register.php">Энд</a></p>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
