<?php
// Include database connection
include('dataconnection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get and sanitize input
    $username = trim($_POST["username"] ?? '');
    $password = trim($_POST["password"] ?? '');

    $errors = [];

    // Validate fields
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    // If no errors, check credentials
    if (empty($errors)) {
        // Check username
        if ($username === $storedUsername) {
            // Verify password hash
            if (password_verify($password, $storedPasswordHash)) {
                // Success - Set session or redirect
                $_SESSION['username'] = $username;
                echo "Login successful. Welcome, " . htmlspecialchars($username) . "!";
                // Redirect to dashboard (uncomment this in real use)
                header("Location:adoptdog.php");
                exit;
            } else {
                $errors[] = "Invalid password.";
            }
        } else {
            $errors[] = "Username not found.";
        }
    }

    // Show errors if any

}
