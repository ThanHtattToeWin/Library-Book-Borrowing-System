<?php
$servername = "localhost";  // Use 'localhost' for local server
$username = "root";         // Default username for MySQL is 'root'
$password = "";             // Default password is empty for local MySQL
$dbname = "library";     // Your database name

// Connect to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
