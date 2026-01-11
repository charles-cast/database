<?php
$host = "localhost";
$user = "root";      // change if needed
$pass = "";          // set your password if applicable
$dbname = "carlito";

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
