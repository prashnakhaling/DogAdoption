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

    /* Modal background */
    .modal {
      display: none;
      /* Hidden by default */
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgba(0, 0, 0, 0.5);
    }

    /* Modal content box */
    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    /* Close button */
    .closeBtn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 24px;
      cursor: pointer;
      color: #888;
    }

    .closeBtn:hover {
      color: #000;
    }

    /* Inputs */
    input[type="text"],
    input[type="number"],
    input[type="file"] {
      width: 80%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    /* Submit button */
    button[type="submit"] {
      background-color: #28a745;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #218838;
    }

    /* Dogs button */
    #dogsBtn {
      padding: 10px 20px;
      background-color: #2d89ef;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
  </style>
</head>



<body>

  <div id="dogModal" class="modal">
    <div class="modal-content">
      <span class="closeBtn">&times;</span>
      <h2>Enter Dog Info</h2>
      <form id="dogInfoForm" action="doginsert.php" method="POST" enctype="multipart/form-data">

        <label>
          Breed:
          <input type="text" name="breed" placeholder="e.g. Labrador" required>
        </label>
        <label>
          Age:
          <input type="number" name="age" placeholder="e.g. 3" required>
        </label>
        <label>
          Image:
          <input type="file" name="image" accept="image/*" required>
        </label>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

  <div class="sidebar">
    <h2>Dog Admin</h2>
    <a href="#">Dashboard</a>
    <a href="#" id="dogsBtn">Dogs</a>
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
    <?php
    // Database connection parameters
    $host = 'localhost';
    $db = 'dogadoption';  // Your DB name
    $user = 'root';       // Change if needed
    $pass = '';           // Change if needed

    // Create connection
    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $result = $conn->query("SELECT dog_breed, age, dog_image, added_date FROM dogs ORDER BY added_date DESC");

    if ($result === false) {
      die("Query failed: " . $conn->error);
    }
    ?>
    <h2>Dog Listings</h2>
    <table cellpadding="8" cellspacing="0">
      <thead>
        <tr>
          <th>Breed</th>
          <th>Image</th>
          <th>Age</th>
          <th>Added Date</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['dog_breed']); ?></td>
            <td>
              <?php
              $imageName = trim($row['dog_image']);
              $imagePath = '/dogpic/' . htmlspecialchars($imageName);
              $serverImagePath = $_SERVER['DOCUMENT_ROOT'] . $imagePath;

              if (!file_exists($serverImagePath) || empty($imageName)) {
                // Show placeholder if image missing
                $imagePath = '/dogpic/placeholder.png';
              }
              ?>
              <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($row['dog_breed']); ?>" style="width: 50px; height: 50px; object-fit: cover;">
            </td>
            <td><?php echo (int)$row['age']; ?></td>
            <td><?php echo htmlspecialchars($row['added_date']); ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <?php
    $result->free();
    $conn->close();
    ?>

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

<script>
  const dogsBtn = document.getElementById('dogsBtn');
  const modal = document.getElementById('dogModal');
  const closeBtn = document.querySelector('.closeBtn');

  dogsBtn.addEventListener('click', () => {
    modal.style.display = 'block';
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  // Optional: Close modal when clicking outside content
  window.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.style.display = 'none';
    }
  });
</script>


</html>