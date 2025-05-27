<?php
include 'configure.php';

// Fetch all dogs
$dogs = $pdo->query("SELECT * FROM dogs ORDER BY id DESC")->fetchAll();

// Fetch adoption requests
$requests = $pdo->query("SELECT r.*, d.name AS dog_name FROM adoption_requests r
                         JOIN dogs d ON r.dog_id = d.id
                         ORDER BY r.id DESC")->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Dog Adoption</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 40px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        form { margin-bottom: 30px; }
    </style>
</head>
<body>

<h1>Admin Dashboard</h1>

<h2>Add New Dog</h2>
<form method="POST" action="add_dog.php">
    <input type="text" name="name" placeholder="Dog Name" required>
    <input type="text" name="breed" placeholder="Breed" required>
    <input type="number" name="age" placeholder="Age" required>
    <input type="text" name="status" placeholder="Status (Available/Adopted)" required>
    <button type="submit">Add Dog</button>
</form>

<h2>Dog List</h2>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Breed</th><th>Age</th><th>Status</th><th>Actions</th>
    </tr>
    <?php foreach ($dogs as $dog): ?>
    <tr>
        <td><?= $dog['id'] ?></td>
        <td><?= htmlspecialchars($dog['name']) ?></td>
        <td><?= htmlspecialchars($dog['breed']) ?></td>
        <td><?= $dog['age'] ?></td>
        <td><?= htmlspecialchars($dog['status']) ?></td>
        <td>
            <a href="edit_dog.php?id=<?= $dog['id'] ?>">Edit</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Adoption Requests</h2>
<table>
    <tr>
        <th>ID</th><th>Dog</th><th>Adopter</th><th>Email</th><th>Status</th><th>Actions</th>
    </tr>
    <?php foreach ($requests as $req): ?>
    <tr>
        <td><?= $req['id'] ?></td>
        <td><?= htmlspecialchars($req['dog_name']) ?></td>
        <td><?= htmlspecialchars($req['adopter_name']) ?></td>
        <td><?= htmlspecialchars($req['adopter_email']) ?></td>
        <td><?= $req['status'] ?></td>
        <td>
            <?php if ($req['status'] === 'Pending'): ?>
                <a href="approve_request.php?id=<?= $req['id'] ?>">Approve</a>
            <?php else: ?>
                Approved
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
