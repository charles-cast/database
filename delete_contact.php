<?php
include 'includes/db.php';

// Check if id is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php?msg=Invalid contact ID");
    exit();
}

$id = intval($_GET['id']);

// Prepare delete statement
$stmt = $conn->prepare("DELETE FROM contacts WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: dashboard.php?msg=Contact deleted successfully");
    exit();
} else {
    header("Location: dashboard.php?msg=Error deleting contact");
    exit();
}

$stmt->close();
$conn->close();
?>
