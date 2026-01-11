<?php
include 'includes/db.php';
include 'includes/navbar.php';

$msg = "";

// ✅ Fetch all departments
$departments = [];
$dept_result = $conn->query("SELECT id, name FROM departments ORDER BY name ASC");
if ($dept_result && $dept_result->num_rows > 0) {
    while ($rowDept = $dept_result->fetch_assoc()) {
        $departments[] = $rowDept;
    }
}

// ✅ Check if an ID was provided in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // prevent SQL injection

    // Fetch contact details
    $stmt = $conn->prepare("SELECT * FROM contacts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("<p style='color:red;'>Contact not found.</p>");
    }

    $stmt->close();
} else {
    die("<p style='color:red;'>No contact ID provided.</p>");
}

// ✅ Handle form submission (update record)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $birthdate = $_POST['birthdate'];

    $status = $_POST['status'];

    if ($name && $email && $department) {
        $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, phone=?, address=?, birthdate=?, status=? WHERE id=?");
        $stmt->bind_param("ssssssi", $name, $email, $phone, $address, $birthdate, $status, $id);

        if ($stmt->execute()) {
            header("Location: dashboard.php?msg=Contact updated successfully");
            exit();
        } else {
            $msg = "Error updating contact: " . $conn->error;
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
  <title>Edit Contact</title>
  <link rel="stylesheet" href="assets/css/edit.css">
</head>
<body>
  <div class="container">
    <h2>Edit Contact</h2>

    <?php if ($msg): ?>
      <p style="color:red;"><?= htmlspecialchars($msg) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
      <label>Name:</label>
      <input type="text" name="name" value="<?= htmlspecialchars($row['name'] ?? '') ?>" required>

      <label>Email:</label>
      <input type="email" name="email" value="<?= htmlspecialchars($row['email'] ?? '') ?>" required>

      <label>Phone:</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($row['phone'] ?? '') ?>">

      <label>Address:</label>
      <input type="text" name="address" value="<?= htmlspecialchars($row['address'] ?? '') ?>">

      <label>Birthdate:</label>
      <input type="date" name="birthdate" value="<?= htmlspecialchars($row['birthdate'] ?? '') ?>">

      <!-- ✅ Department Dropdown -->
      <label>Department:</label>
      <select name="department" required>
        <option value="">-- Select Department --</option>
        <?php foreach ($departments as $dept): ?>
          <option value="<?= htmlspecialchars($dept['name']) ?>"
            <?= ($row['department'] ?? '') === $dept['name'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($dept['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Status:</label>
      <select name="status">
        <option value="Ongoing" <?= ($row['status'] ?? '') === 'Ongoing' ? 'selected' : '' ?>>Ongoing</option>
        <option value="Passed" <?= ($row['status'] ?? '') === 'Passed' ? 'selected' : '' ?>>Passed</option>
        <option value="Interviewed" <?= ($row['status'] ?? '') === 'Interviewed' ? 'selected' : '' ?>>Interviewed</option>
      </select>

      <div style="margin-top:15px;">
        <button type="submit" class="save-btn">Save Changes</button>
        <a href="dashboard.php" class="cancel-link">Cancel</a>
      </div>
    </form>
  </div>
</body>
</html>
