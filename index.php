<?php
session_start();

// If HR admin is already logged in, go to the main dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit();
} else {
    // If not logged in, go to login page
    header("Location: login.php");
    exit();
}
?>
