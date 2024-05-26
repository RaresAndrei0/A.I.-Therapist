<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "users";
$socket = "/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8;unix_socket=$socket", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "User found: " . htmlspecialchars($user['username']) . "<br>";
            echo "Input password: " . htmlspecialchars($inputPassword) . "<br>";

            if ($inputPassword === $user['password']) {
                echo "Login successful! Welcome, " . htmlspecialchars($inputUsername) . ".";
                header("Location: http://localhost:3000");

                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }
    }
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


$conn = null;
?>
