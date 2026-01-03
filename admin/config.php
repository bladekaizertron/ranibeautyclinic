<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database configuration for Rani Beauty Clinic CMS
// Adjust credentials to match your local XAMPP MySQL setup if needed.
$host = "localhost";            // Typically `localhost` on XAMPP
$user = "u993466733_ranicmsDB";                 // Default XAMPP MySQL user
$pass = "raniDBcms123";                     // Default XAMPP MySQL has no password
$dbname = "u993466733_ranicmsDB";            // Database that stores CMS data

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
