<?php
// dataconnection.php (inline for simplicity)
$host = 'localhost';
$dbname = 'dogadoption';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Add Dog
if (isset($_POST['add_dog'])) {
    $stmt = $pdo->prepare("INSERT INTO dogs (name, breed, age) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['name'], $_POST['breed'], $_POST['age']]);
    $message = "Dog added successfully!";
}

// Delete Dog
if (isset($_GET['delete_dog'])) {
    $stmt = $pdo->prepare("DELETE FROM dogs WHERE id = ?");
    $stmt->execute([$_GET['delete_dog']]);
    $message = "Dog deleted successfully!";
}

// Edit Dog
if (isset($_POST['edit_dog'])) {
    $stmt = $pdo->prepare("UPDATE dogs SET name = ?, breed = ?, age = ? WHERE id = ?");
    $stmt->execute([$_POST['name'], $_POST['breed'], $_POST['age'], $_POST['id']]);
    $message = "Dog updated successfully!";
}

// Handle Adoption Request Action
if (isset($_GET['update_request'])) {
    $status = $_GET['status'];
    $id = $_GET['update_request'];
    $stmt = $pdo->prepare("UPDATE adoption_requests SET status = ? WHERE id = ?");
    $stmt->execute([$status, $id]);
    $message = "Request updated to '$status'";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dog Adoption Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <h1>🐾 Dog Adoption Admin Panel</h1>

    <?php if (!empty($message)): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="adminTab" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#add">➕ Add Dog</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#dogs">🐶 View/Edit Dogs</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#requests">📥 Adoption Requests</button></li>
    </ul>

    <div class="tab-content mt-4">
        <!-- Add Dog -->
        <div class="tab-pane fade show active" id="add">
            <form method="POST" class="w-50">
                <input type="hidden" name="add_dog" value="1">
                <input type="text" name="name" class="form-control mb-2" placeholder="Dog Name" required>
                <input type="text" name="breed" class="form-control mb-2" placeholder="Breed" required>
                <input type="number" name="age" class="form-control mb-2" placeholder="Age" required>
                <button type="submit" class="btn btn-primary">Add Dog</button>
            </form>
        </div>

        <!-- View/Edit/Delete Dogs -->
        <div class="tab-pane fade" id="dogs">
            <h4 class="mt-3">🐶 Dog List</h4>
            <table class="table table-bordered">
                <thead><tr><th>Name</th><th>Breed</th><th>Age</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php
                    $dogs = $pdo->query("SELECT * FROM dogs")->fetchAll();
                    foreach ($dogs as $dog): ?>
                        <tr>
                            <form method="POST">
                                <td><input name="name" value="<?= htmlspecialchars($dog['name']) ?>" class="form-control" required></td>
                                <td><input name="breed" value="<?= htmlspecialchars($dog['breed']) ?>" class="form-control" required></td>
                                <td><input name="age" type="number" value="<?= $dog['age'] ?>" class="form-control" required></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= $dog['id'] ?>">
                                    <button name="edit_dog" class="btn btn-sm btn-success">Update</button>
                                    <a href="?delete_dog=<?= $dog['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this dog?')">Delete</a>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Adoption Requests -->
        <div class="tab-pane fade" id="requests">
            <h4 class="mt-3">📥 Adoption Requests</h4>
            <table class="table table-striped">
                <thead><tr><th>Dog ID</th><th>Name</th><th>Email</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                    <?php
                    $requests = $pdo->query("SELECT * FROM adoption_requests")->fetchAll();
                    foreach ($requests as $req): ?>
                        <tr>
                            <td><?= $req['dog_id'] ?></td>
                            <td><?= htmlspecialchars($req['name']) ?></td>
                            <td><?= htmlspecialchars($req['email']) ?></td>
                            <td><?= $req['status'] ?></td>
                            <td>
                                <?php if ($req['status'] === 'Pending'): ?>
                                    <a href="?update_request=<?= $req['id'] ?>&status=Approved" class="btn btn-sm btn-success">Approve</a>
                                    <a href="?update_request=<?= $req['id'] ?>&status=Rejected" class="btn btn-sm btn-danger">Reject</a>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Handled</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
