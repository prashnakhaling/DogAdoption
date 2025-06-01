<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "dogadoption");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Only process if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    // Validate empty fields
    if (empty($name) || empty($password)) {
        die("❌ Both name and password are required.");
    }

    // Prepare and execute query to find user by name
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admindashboard.php");
            } else {
                header("Location: homepage.php");
            }
            exit;
        } else {
            echo "❌ Incorrect password.";
        }
    } else {
        echo "❌ User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>
