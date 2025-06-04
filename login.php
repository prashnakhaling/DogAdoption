<?php
session_start();

$host = 'localhost';
$dbname = 'dogadoption';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'user') {
            header("Location: adoptdog.php");
        } else {
            header("Location: admindashboard.php");
        }
        exit();
    } else {
        $_SESSION['login_attempted'] = true;
        $_SESSION['login_error'] = "Invalid username or password.";
        header("Location: homepage.php");
        exit();
    }

    // session_destroy();


}
