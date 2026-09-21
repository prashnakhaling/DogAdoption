<?php
// Connection
include 'dataconnection.php';

// Function to return image path (assuming full path is already stored in DB)
function getValidImagePath($imagePath)
{
  $imagePath = trim($imagePath);
  return (!empty($imagePath) && file_exists(__DIR__ . '/' . $imagePath)) ? $imagePath : 'placeholder.jpg';
}

// Total dog count
$totalDogsResult = $conn->query("SELECT COUNT(*) AS total FROM dogs");
$totalDogs = ($totalDogsResult && $row = $totalDogsResult->fetch_assoc()) ? (int)$row['total'] : 0;

// Get dog data
$dogsResult = $conn->query("SELECT dog_id, dog_breed, age, dog_image, added_date FROM dogs ORDER BY added_date DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Happy Tails - Admin Dashboard</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #f9f9f9;
    }

    .sidebar {
      width: 220px;
      background: #adb2d4;
      color: white;
      height: 100vh;
      position: fixed;
      padding-top: 20px;
    }

    .sidebar h2 {
      text-align: center;
    }

    .sidebar a {
      display: block;
      color: white;
      padding: 12px 20px;
      text-decoration: none;
    }

    .sidebar a:hover {
      background: #adb2d4;
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

    img {
      border-radius: 6px;
      object-fit: cover;
      width: 60px;
      height: 60px;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      overflow-y: hidden;
    }

    .modal-content {
      background-color: #fff;
      margin: 30px auto;
      padding: 20px;
      border-radius: 10px;
      width: 90%;
      max-width: 500px;
      max-height: 85vh;
      overflow-y: hidden;
      position: relative;
      box-sizing: border-box;
    }

    .closeBtn {
      position: absolute;
      top: 8px;
      right: 15px;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      color: #555;
    }

    .closeBtn:hover {
      color: red;
    }

    input,
    button {
      width: 90%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }

    button[type="submit"],
    #addDogBtn {
      background-color: #858ec6;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover,
    #addDogBtn:hover background-color: :rgb(109, 3, 72);

    .delete-btn {
      background-color: red;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
    }

    .delete-btn:hover {
      background-color: darkred;
    }

    .datetime-box {
      background: #8b92c0;



      color: white;
      padding: 15px;
      border-radius: 10px;
      width: 250px;
      text-align: center;
      margin-bottom: 20px;
    }

    #clock {
      font-size: 28px;
      font-weight: bold;
    }

    #calendar {
      font-size: 15px;
      margin-top: 5px;
    }

    .datetime-box {
      position: absolute;
      top: 20px;
      right: 20px;
      background: #adb2d4;


      color: white;
      padding: 15px 25px;
      border-radius: 10px;
      text-align: center;
    }

    /* Applications Modal */
    .applications-modal-content {
      background-color: white;
      margin: 5vh auto;
      padding: 18px;
      border-radius: 10px;

      width: 90%;
      max-width: 950px;

      position: relative;
      box-sizing: border-box;
    }

    /* Smaller table area */
    .applications-table-container {
      width: 100%;
      max-height: 55vh;
      overflow-x: hidden;
      overflow-y: hidden;

      border: 1px solid #ddd;
      border-radius: 6px;
    }

    /* Smaller application table */
    .applications-table {
      width: 100%;
      min-width: 850px;
      border-collapse: collapse;
      background: white;
      font-size: 12px;
    }

    /* Smaller headings */
    .applications-table th {
      background-color: #858ec6;
      color: white;
      padding: 8px 6px;
      text-align: left;
      position: sticky;
      top: 0;
      z-index: 2;
    }

    /* Smaller cells */
    .applications-table td {
      padding: 7px 6px;
      border-bottom: 1px solid #ddd;
      white-space: nowrap;
    }

    /* Smaller status */
    .status-pending,
    .status-accepted,
    .status-rejected {
      padding: 4px 7px;
      border-radius: 4px;
      font-size: 11px;
    }

    /* Pending */
    .status-pending {
      background: #fff3cd;
      color: #856404;
    }

    /* Accepted */
    .status-accepted {
      background: #d4edda;
      color: #155724;
    }

    /* Rejected */
    .status-rejected {
      background: #f8d7da;
      color: #721c24;
    }

    /* Smaller buttons */
    .accept-btn,
    .reject-btn {
      width: auto;
      padding: 5px 8px;
      margin: 1px;
      border: none;
      border-radius: 4px;
      color: white;
      font-size: 11px;
      cursor: pointer;
    }

    .accept-btn {
      background-color: #4CAF50;
    }

    .reject-btn {
      background-color: #e74c3c;
    }

    .accept-btn:hover {
      background-color: #388e3c;
    }

    .reject-btn:hover {
      background-color: #c0392b;
    }

    .completed-text {
      font-size: 11px;
      color: #777;
    }
  </style>
</head>

<body>

  <!-- Modal Form -->
  <div id="dogModal" class="modal">
    <div class="modal-content">
      <span class="closeBtn" data-modal="dogModal">&times;</span>
      <h2>Add New Dog</h2>
      <form action="doginsert.php" method="POST" enctype="multipart/form-data">
        <label>Breed:<br><input type="text" name="breed" required></label><br>
        <label>Age:<br><input type="number" name="age" required></label><br>
        <label>Image:<br><input type="file" name="image" accept="image/*" required></label><br>
        <button type="submit">Submit</button>
      </form>
    </div>
  </div>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Dog Admin</h2>
    <a href="#">Dashboard</a>
    <a href="#" id="addDogBtn">Add Dog</a>
    <a href="#" id="pendingAppBtn">Applications</a>
    <a href="admin_chatsupport.php">Chat</a>
    <a href="#">Settings</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <h1>Welcome, Admin</h1>
    <div class="cards">
      <div class="card">
        <h3>Total Dogs</h3>
        <p><?= $totalDogs ?></p>
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
    <div class="datetime-box">
      <div id="clock"></div>
      <div id="calendar"></div>
    </div>
    <h2>Dog Listings</h2>
    <table>
      <thead>
        <tr>
          <th>Breed</th>
          <th>Image</th>
          <th>Age</th>
          <th>Added Date</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $dogsResult->fetch_assoc()):
          $imagePath = getValidImagePath($row['dog_image']); ?>
          <tr>
            <td><?= htmlspecialchars($row['dog_breed']) ?></td>
            <td><img src="<?= htmlspecialchars($imagePath) ?>" alt="Dog Image"></td>
            <td><?= (int)$row['age'] ?></td>
            <td><?= htmlspecialchars($row['added_date']) ?></td>
            <td>
              <form method="POST" action="deletedog.php" onsubmit="return confirm('Are you sure you want to delete this dog?');">
                <input type="hidden" name="dog_id" value="<?= (int)$row['dog_id'] ?>">

                <button type="submit" style="background-color: red;" class="delete-btn">Delete</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <footer>
      <p>Adopt love — it has four paws and a wagging tail.<br>
        You can't buy happiness, but you can adopt it.<br>
        Give a homeless dog a forever home.</p>
    </footer>
  </div>


  <script>
    document.addEventListener("DOMContentLoaded", function() {

      // Add Dog button
      document.getElementById("addDogBtn").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("dogModal").style.display = "block";
      });

      // Applications button
      document.getElementById("pendingAppBtn").addEventListener("click", function(e) {
        e.preventDefault();
        document.getElementById("applicationsModal").style.display = "block";
      });

      // Close buttons
      document.querySelectorAll(".closeBtn").forEach(function(button) {

        button.addEventListener("click", function() {

          const modalId = button.getAttribute("data-modal");

          if (modalId) {
            document.getElementById(modalId).style.display = "none";
          }

        });

      });

      // Close modal when clicking outside
      window.addEventListener("click", function(event) {

        if (event.target.classList.contains("modal")) {
          event.target.style.display = "none";
        }

      });

      // Clock and calendar
      function updateDateTime() {

        const now = new Date();

        const time = now.toLocaleTimeString("en-US", {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit"
        });

        const date = now.toLocaleDateString("en-US", {
          weekday: "long",
          year: "numeric",
          month: "long",
          day: "numeric"
        });

        document.getElementById("clock").innerHTML = time;
        document.getElementById("calendar").innerHTML = date;
      }

      updateDateTime();
      setInterval(updateDateTime, 1000);

    });
  </script>

  </div> <!-- end main -->


  <!-- Applications Modal -->
  <div id="applicationsModal" class="modal">

    <div class="applications-modal-content">

      <span class="closeBtn" data-modal="applicationsModal">&times;</span>

      <h2>Adoption Applications</h2>

      <?php
      $applicationsResult = $conn->query("
          SELECT id, fullname, email, phone, address, dogname, status
          FROM adoptions
          ORDER BY id DESC
      ");
      ?>

      <div class="applications-table-container">

        <table class="applications-table">

          <thead>
            <tr>
              <th>ID</th>
              <th>Full Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Dog</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody>

            <?php if ($applicationsResult && $applicationsResult->num_rows > 0): ?>

              <?php while ($application = $applicationsResult->fetch_assoc()): ?>

                <tr>

                  <td><?= (int)$application['id'] ?></td>

                  <td>
                    <?= htmlspecialchars($application['fullname']) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($application['email']) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($application['phone']) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($application['address']) ?>
                  </td>

                  <td>
                    <?= htmlspecialchars($application['dogname']) ?>
                  </td>

                  <td>

                    <?php if ($application['status'] === 'Pending'): ?>

                      <span class="status-pending">
                        Pending
                      </span>

                    <?php elseif ($application['status'] === 'Accepted'): ?>

                      <span class="status-accepted">
                        Accepted
                      </span>

                    <?php elseif ($application['status'] === 'Rejected'): ?>

                      <span class="status-rejected">
                        Rejected
                      </span>

                    <?php endif; ?>

                  </td>

                  <td>

                    <?php if ($application['status'] === 'Pending'): ?>

                      <form action="accept_application.php"
                        method="POST"
                        style="display:inline;">

                        <input type="hidden"
                          name="application_id"
                          value="<?= (int)$application['id'] ?>">

                        <button type="submit"
                          class="accept-btn">
                          Accept
                        </button>

                      </form>

                      <form action="reject_application.php"
                        method="POST"
                        style="display:inline;">

                        <input type="hidden"
                          name="application_id"
                          value="<?= (int)$application['id'] ?>">

                        <button type="submit"
                          class="reject-btn">
                          Reject
                        </button>

                      </form>

                    <?php else: ?>

                      <span class="completed-text">
                        Completed
                      </span>

                    <?php endif; ?>

                  </td>

                </tr>

              <?php endwhile; ?>

            <?php else: ?>

              <tr>
                <td colspan="8" style="text-align:center;">
                  No adoption applications found.
                </td>
              </tr>

            <?php endif; ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>


</body>

</html>

<?php
$dogsResult->free();
$conn->close();
?>
</body>


</html>

<?php
$dogsResult->free();
$conn->close();
?>