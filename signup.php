<?php
// Include database connection
include('dataconnection.php');
session_start();

// Initialize error messages
$errors = [
    'username' => '',
    'email' => '',
    'password' => '',
];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate username
    $username = filter_var(trim($_POST['newUsername'] ?? ''));
    //  FILTER_SANITIZE_STRING);
    if (empty($username)) {
        $errors['username'] = 'Username is required.';
    } elseif (!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)) {
        $errors['username'] = 'Username must be 3-20 characters long and contain only letters, numbers, and underscores.';
    }

    // Sanitize and validate email
    $email = filter_var(trim($_POST['newEmail'] ?? ''), FILTER_SANITIZE_EMAIL);
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }

    // Validate password
    $password = $_POST['newPassword'] ?? '';
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters long.';
    }

    // Check if there are no errors
    if (!array_filter($errors)) {
        // Hash the password securely
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare an SQL statement with placeholders
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

        // Bind parameters (s for string, i for integer, etc.)
        $stmt->bind_param("sss", $username, $email, $hashedPassword);

        // Execute the statement
        if ($stmt->execute()) {
            // Set session variable to indicate successful registration
            $_SESSION['registration_success'] = true;
            // Redirect to the homepage
            header('Location:homepage.php');
            exit;
        } else {
            // Handle insertion failure
            echo "Error: " . $stmt->error;
        }
        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
