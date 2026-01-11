<?php
include 'includes/db.php';
include 'includes/navbar.php';

// Fetch all contacts
$sql = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - HR Contact Management</title>
  <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
  <div class="container">
    <header>
      <h1>Records</h1>
      <a href="add_contact.php"><button class="add-btn">+ Add Contact</button></a>
    </header>

    <table class="contacts-table">
      <thead>
        <tr>
  <th>Name</th>
  <th>Email</th>
  <th>Phone</th>
  <th>Address</th>
  <th>Birthdate</th>

  <th>Status</th>
  <th>Actions</th>
</tr>

      </thead>
      <tbody>
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']); ?></td>
              <td><?= htmlspecialchars($row['email']); ?></td>
              <td><?= htmlspecialchars($row['phone']); ?></td>
             <td><?= htmlspecialchars($row['address'] ?? ''); ?></td>
             <td><?= htmlspecialchars($row['birthdate'] ?? ''); ?></td>

              <td>
                <?php
                  $status = $row['status'];
                  $badgeClass = strtolower($status);
                ?>
                <span class="badge <?= $badgeClass; ?>"><?= $status; ?></span>
              </td>
             <td>
  <div class="action-buttons">
    <a href="edit_contact.php?id=<?= $row['id']; ?>" class="edit-btn">Edit</a>

    <a href="delete_contact.php?id=<?= $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
  </div>
</td>

            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6" style="text-align:center;">No contacts found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
