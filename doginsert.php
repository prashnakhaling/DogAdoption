<?php
// Database connection
$host = 'localhost';
$db = 'dogadoption';
$user = 'root';       // change if needed
$pass = '';           // change if needed

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $uploadDir = 'dogpic/';  // Changed from 'images/' to 'dogpic/'
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $uniqueName = uniqid('dog_', true) . '.' . $ext;
        $uploadPath = $uploadDir . $uniqueName;

        // Create directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move uploaded file
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {  // Fixed 'dogpic' to 'image'
            // Save to database
            $stmt = $conn->prepare("INSERT INTO dogs (dog_breed, age, dog_image) VALUES (?, ?, ?)");
            $stmt->bind_param("sis", $breed, $age, $uniqueName);

            if ($stmt->execute()) {
                echo "Dog info saved successfully!";
            } else {
                echo "Database error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Failed to upload image.";
        }
    } else {
        echo "No image uploaded or upload error.";
    }
}

$conn->close();
