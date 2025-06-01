<?php
$conn = new mysqli("localhost", "root", "", "dogadoption");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate input
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($name) || empty($phone) || empty($email) || empty($password)) {
        die("❌ All fields are required.");
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        die("❌ Phone number must be 10 digits.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("❌ Invalid email format.");
    }

    if (strlen($password) < 6) {
        die("❌ Password must be at least 6 characters.");
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        die("❌ Email already registered.");
    }

    // Hash password and insert
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, role) VALUES (?, ?, ?, ?, 'user')");
    $stmt->bind_param("ssss", $name, $phone, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "✅ Registration successful!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
