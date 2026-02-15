<?php
session_start();
require_once 'includes/db.php'; 

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        // 1. Updated query to target the 'admin' table specifically
        $stmt = $conn->prepare("SELECT username, password FROM admin WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $admin_user = $result->fetch_assoc();

            // 2. Changed to direct comparison (NO HASHING)
            // Note: This is less secure but matches your request for plain text
            if ($password === $admin_user['password']) {
                session_regenerate_id(true);
                $_SESSION['admin'] = $admin_user['username'];
                header("Location: index.php");
                exit();
            } else {
                $error = "❌ Invalid password.";
            }
        } else {
            $error = "❌ Admin username not found.";
        }
        $stmt->close();
    } else {
        $error = "❌ Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Admin Login</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <main class="login-wrapper">
        <section class="login-container">
            <h2 class="login-title">HR Admin Login</h2>

            <?php if (!empty($error)): ?>
                <p class="error-message" style="color: red; margin-bottom: 10px;">
                    <?php echo htmlspecialchars($error); ?>
                </p>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
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