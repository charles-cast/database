<?php
include 'includes/db.php';
include 'includes/navbar.php';

$msg = "";

// Fetch departments from database
$departments = [];
$dept_result = $conn->query("SELECT id, name FROM departments ORDER BY name ASC");
if ($dept_result && $dept_result->num_rows > 0) {
    while ($row = $dept_result->fetch_assoc()) {
        $departments[] = $row;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    $address = trim($_POST['address']);
    $birthdate = $_POST['birthdate'];
    $status = $_POST['status'];

    if ($name && $email) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, address, birthdate, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $email, $phone, $address, $birthdate, $status);

        if ($stmt->execute()) {
            header("Location: dashboard.php?msg=Contact added successfully");
            exit();
        } else {
            $msg = "Error adding contact: " . $conn->error;
        }

        $stmt->close();
    } else {
        $msg = "Please fill out all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Contact</title>
  <link rel="stylesheet" href="assets/css/add.css">
</head>
<body>
  <div class="container">
    <h2>Add New Contact</h2>
    <?php if ($msg): ?>
      <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Name:</label>
      <input type="text" name="name" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Phone:</label>
      <input type="text" name="phone">

      <label>Address:</label>
      <input type="text" name="address" required>

      <label>Birthdate:</label>
      <input type="date" name="birthdate" required>

   
      </select>

      <label>Status:</label>
      <select name="status">
        <option value="Ongoing">Ongoing</option>
        <option value="Passed">Passed</option>
        <option value="Interviewed">Interviewed</option>
      </select>

      <div style="margin-top:15px;">
        <button type="submit" class="add-btn">Save Contact</button>
        <a href="dashboard.php" class="cancel-link">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
