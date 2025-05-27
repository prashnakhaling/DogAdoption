<?php
include 'configure.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $stmt = $pdo->prepare("UPDATE dogs SET name=?, breed=?, age=?, status=? WHERE id=?");
        $stmt->execute([
            $_POST['name'],
            $_POST['breed'],
            $_POST['age'],
            $_POST['status'],
            $id
        ]);
        header("Location: admindashboard.php");
    }

    $stmt = $pdo->prepare("SELECT * FROM dogs WHERE id = ?");
    $stmt->execute([$id]);
    $dog = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Dog</title></head>
<body>
<h2>Edit Dog</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $dog['name'] ?>" required>
    <input type="text" name="breed" value="<?= $dog['breed'] ?>" required>
    <input type="number" name="age" value="<?= $dog['age'] ?>" required>
    <input type="text" name="status" value="<?= $dog['status'] ?>" required>
    <button type="submit">Update</button>
</form>
</body>
</html>
