<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "users";
$socket = "/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;unix_socket=$socket", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection
$conn = null;
?>
