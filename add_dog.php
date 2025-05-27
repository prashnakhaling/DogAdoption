<?php
include 'configure.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO dogs (name, breed, age, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['breed'],
        $_POST['age'],
        $_POST['status']
    ]);
}

header("Location: admindashboard.php");
