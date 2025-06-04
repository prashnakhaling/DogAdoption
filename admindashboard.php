<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "dogadoption");

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

// Fetch dog data
$result = $mysqli->query("SELECT * FROM adoptions");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Happy Tails Dog Adoption - Admin Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
    }

    .sidebar {
      width: 220px;
      background: #2e3b4e;
      color: white;
      height: 100vh;
      position: fixed;
      padding-top: 20px;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
    }

    .sidebar a:hover {
      background: #1e2a38;
    }

    .main {
      margin-left: 240px;
      padding: 20px;
    }

    .cards {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      flex: 1;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f0f0f0;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      padding: 20px;
      font-size: 14px;
      color: #666;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <h2>Dog Admin</h2>
    <a href="#">Dashboard</a>
    <a href="#">Dogs</a>
    <a href="#">Applications</a>
    <a href="#">Adoptions</a>
    <a href="#">Settings</a>
  </div>

  <div class="main">
    <h1>Welcome, Admin</h1>

    <div class="cards">
      <div class="card">
        <h3>Total Dogs</h3>
        <p><?php echo $result->num_rows; ?></p>
      </div>
      <div class="card">
        <h3>Pending Applications</h3>
        <p>12</p>
      </div>
      <div class="card">
        <h3>Completed Adoptions</h3>
        <p>89</p>
      </div>
    </div>

    <h2>Dog Listings</h2>
    <table>
      <thead>
        <tr>
          <th>Name</th>
          <th>Breed</th>
          <th>Age</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['breed']); ?></td>
            <td><?php echo (int)$row['age']; ?></td>
            <td><?php echo htmlspecialchars($row['status']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <footer>
      <p>Adopt love — it has four paws and a wagging tail.</p>
      <p>You can't buy happiness, but you can adopt it.</p>
      <p>Give a homeless dog a forever home.</p>
      <p>They may have had a rough start, but you can give them a beautiful future.</p>
      <p>Be the hero they’ve been waiting for — adopt, don’t shop.</p>
      <p>Save a life — adopt your new best friend today.</p>
    </footer>
  </div>

</body>

</html>