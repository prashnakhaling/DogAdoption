<?php
include 'configure.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("UPDATE adoption_requests SET status='Approved' WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admindashboard.php");
