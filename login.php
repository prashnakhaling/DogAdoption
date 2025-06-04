<?php
session_start();
ob_start();

$host = 'localhost';
$dbname = 'dogadoption';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = "Both fields are required.";
        header("Location: homepage.php");
        exit();
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['login_success'] = "Login successful!";
        header("Location: userdashboard.php"); // Redirect to user dashboard
        exit();
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: homepage.php");
        exit();
    }
}
