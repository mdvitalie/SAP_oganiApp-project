<?php
session_start();

// Define secure database credentials
$servername = "localhost";
$username = "root";
// $password = "mypassword";
$password = "";
// $dbname = "mydatabase";
$dbname = "oganiapp_insecure";

// Create a new database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the database connection
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

?>