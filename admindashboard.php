<?php
// admin-dashboard.php
session_start();
// Assume you're already logged in as admin

// DB connection (update with your credentials)
$conn = new mysqli("localhost", "root", "", "dogadoption");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add New Dog
if (isset($_POST['add_dog'])) {
    $name = $_POST['dog_name'];
    $breed = $_POST['breed'];
    $age = $_POST['age'];

    $stmt = $conn->prepare("INSERT INTO dogs (name, breed, age) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $breed, $age);
    $stmt->execute();
    $stmt->close();
}

// Handle Adoption Verification
if (isset($_POST['verify_form'])) {
    $request_id = $_POST['request_id'];
    $stmt = $conn->prepare("UPDATE adoption_requests SET verified = 1 WHERE id = ?");
    $stmt->bind_param("i", $request_id);
    $stmt->execute();
    $stmt->close();
}
// for data update
if (isset($_POST['edit_dog'])) {
    $editId = $_POST['edit_id'];
    $dogData = $conn->query("SELECT * FROM dogs WHERE id = $editId")->fetch_assoc();
?>
    <h3>Edit Dog Details (ID: <?= $editId ?>)</h3>
    <form method="POST">
        <input type="hidden" name="update_id" value="<?= $dogData['id'] ?>">
        <label>Name: <input type="text" name="edit_name" value="<?= $dogData['name'] ?>" required></label><br><br>
        <label>Breed: <input type="text" name="edit_breed" value="<?= $dogData['breed'] ?>" required></label><br><br>
        <label>Age: <input type="number" name="edit_age" value="<?= $dogData['age'] ?>" required></label><br><br>
        <label>Status:
            <select name="edit_status">
                <option value="available" <?= $dogData['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="adopted" <?= $dogData['status'] == 'adopted' ? 'selected' : '' ?>>Adopted</option>            </select>
        </label><br><br>
        <input type="submit" name="update_dog" value="Update">
    </form>
<?php }
if (isset($_POST['update_dog'])) {
    $id = $_POST['update_id'];
    $name = $_POST['edit_name'];
    $breed = $_POST['edit_breed'];
    $age = $_POST['edit_age'];
    $status = $_POST['edit_status'];

    $stmt = $conn->prepare("UPDATE dogs SET name=?, breed=?, age=?, status=? WHERE id=?");
    $stmt->bind_param("ssisi", $name, $breed, $age, $status, $id);
    $stmt->execute();
    $stmt->close();

    // Optional: reload to reflect changes
    echo "<script>location.href=location.href;</script>";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Happy Tails Dog Adoption </title>
    <link rel="stylesheet" href="admin.css">

    <!-- <style>
        body { font-family: Arial; padding: 20px; }
        .section { margin-bottom: 40px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; }
    </style> -->
</head>
<body>

    <h1 class = "admin-heading">🐶 Happy Tails Dog Adoption </h1>

    <div class="section">
        <h2>Add New Dog</h2>
        <form method="POST" enctype="multipart/form-data">
    <label>Name: <input type="text" name="dog_name" required></label><br><br>
    <label>Breed: <input type="text" name="breed" required></label><br><br>
    <label>Age: <input  name="age" required></label><br><br>
    <label>Image: <input type="file" name="dog_image" accept="image/*" required></label><br><br>
    <input type="submit" name="add_dog" value="Add Dog">
</form>

    </div>

    <div class="section">
        <h2>Adoption Requests</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Dog ID</th>
                <th>Applicant Name</th>
                <th>Form Submitted</th>
                <th>Verified</th>
                <th>Action</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM adoption_requests");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['dog_id']}</td>
                        <td>{$row['applicant_name']}</td>
                        <td>{$row['form_submitted']}</td>
                        <td>" . ($row['verified'] ? '✅ Yes' : '❌ No') . "</td>
                        <td>
                            " . (!$row['verified'] ? "
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='request_id' value='{$row['id']}'>
                                <button type='submit' name='verify_form'>Verify</button>
                            </form>" : "") . "
                        </td>
                    </tr>";
            }
            ?>
        </table>
        <div class="section">
    <h2>Available Dogs for Adoption</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Status</th>
        </tr>
        <?php
        $availableDogs = $conn->query("SELECT * FROM dogs WHERE status = 'available'");
        while ($dog = $availableDogs->fetch_assoc()) {
           echo "<tr>
    <td>{$dog['id']}</td>
    <td>{$dog['name']}</td>
    <td>{$dog['breed']}</td>
    <td>{$dog['age']}</td>
    <td>{$dog['status']}</td>
    <td><img src='{$dog['image']}' alt='Dog Image' width='100'>
    </td>
    <td>
        <form method='POST' style='display:inline;'>
            <input type='hidden' name='edit_id' value='{$dog['id']}'>
            <button type='submit' name='edit_dog'>Edit</button>
        </form>
    </td>
</tr>";

 }
        ?>
    </table>
</div>

    </div>

</body>
</html>
