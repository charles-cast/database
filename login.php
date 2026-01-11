<?php
session_start();
include 'includes/db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check username
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "❌ Invalid password.";
        }
    } else {
        $error = "❌ Username not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>HR Admin Login</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <main class="login-wrapper">
    <section class="login-container">
      <h2 class="login-title">HR Admin Login</h2>

      <?php if ($error): ?>
        <p class="error-message"><?= htmlspecialchars($error); ?></p>
      <?php endif; ?>

      <form method="POST" class="login-form">
        <div class="form-group">
          <label for="username">Username</label>
          <input 
            type="text" 
            id="username" 
            name="username" 
            placeholder="Enter username" 
            required 
          >
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input 
            type="password" 
            id="password" 
            name="password" 
            placeholder="Enter password" 
            required 
          >
        </div>

        <button type="submit" class="login-btn">Login</button>
      </form>
    </section>
  </main>
</body>
</html>
