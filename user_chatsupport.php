<?php
session_start();
include 'dataconnection.php';

if (isset($_POST['message']) && !empty($_POST['message'])) {

    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $sender = $_SESSION['username']; // Logged-in user's name

    mysqli_query($conn, "
        INSERT INTO chat_messages(sender, receiver, message)
        VALUES('$sender', 'Admin', '$message')
    ");
}

$result = mysqli_query($conn, "
    SELECT * FROM chat_messages
    ORDER BY sent_at ASC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chat With Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .chat-container {
            width: 600px;
            margin: 30px auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
        }

        .user {
            color: blue;
            margin-bottom: 10px;
        }

        .admin {
            color: green;
            margin-bottom: 10px;
        }

        input[type=text] {
            width: 80%;
            padding: 10px;
        }

        button {
            padding: 10px 15px;
            background: #adb2d4;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="chat-container">
        <h2>💬 Chat With Admin</h2>

        <div class="chat-box">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="<?php echo strtolower($row['sender']); ?>">
                    <strong><?php echo $row['sender']; ?>:</strong>
                    <?php echo htmlspecialchars($row['message']); ?>
                </div>

            <?php } ?>
        </div>

        <form method="POST">
            <input type="text" name="message" placeholder="Type message..." required>
            <button type="submit">Send</button>
        </form>

        <br>
        <a href="homepage.php">⬅ Back to Home</a>
    </div>

</body>

</html>