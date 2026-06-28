<?php
session_start();
include 'dataconnection.php';

// Send message
if (isset($_POST['send'])) {

    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    if (!empty($message)) {

        mysqli_query($conn, "
            INSERT INTO chat_messages(sender, receiver, message)
            VALUES('Admin', '$user', '$message')
        ");

        header("Location: admin_chatsupport.php?user=" . urlencode($user));
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Chat Panel</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: #f2f2f2;
        }

        .container {
            width: 1000px;
            margin: 20px auto;
            display: flex;
        }

        .left {
            width: 250px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
        }

        .left h3 {
            margin-top: 0;
        }

        .left a {
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            background: #eee;
            text-decoration: none;
            color: black;
            border-radius: 5px;
        }

        .left a:hover {
            background: #adb2d4;
            color: white;
        }

        .right {
            flex: 1;
            margin-left: 20px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
        }

        .chatbox {
            height: 400px;
            border: 1px solid #ccc;
            overflow-y: auto;
            padding: 10px;
            margin-bottom: 15px;
        }

        .admin {
            color: green;
            margin: 8px 0;
        }

        .user {
            color: blue;
            margin: 8px 0;
        }

        input[type=text] {
            width: 80%;
            padding: 10px;
        }

        button {
            padding: 10px 20px;
            background: #adb2d4;
            border: none;
            color: white;
            cursor: pointer;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="left">

            <h3>Users</h3>

            <?php

            $users = mysqli_query($conn, "
            SELECT DISTINCT sender
            FROM chat_messages
            WHERE receiver='Admin'
            ORDER BY sender
        ");

            while ($row = mysqli_fetch_assoc($users)) {
            ?>
                <a href="admin_chatsupport.php?user=<?php echo urlencode($row['sender']); ?>">
                    <?php echo htmlspecialchars($row['sender']); ?>
                </a>
            <?php
            }

            ?>

        </div>

        <div class="right">

            <?php

            if (isset($_GET['user'])) {
                $user = mysqli_real_escape_string($conn, $_GET['user']);

                echo "<h3>Chat with " . htmlspecialchars($user) . "</h3>";

                $chat = mysqli_query($conn, "
                SELECT *
                FROM chat_messages
                WHERE
                (sender='$user' AND receiver='Admin')
                OR
                (sender='Admin' AND receiver='$user')
                ORDER BY sent_at ASC
            ");

            ?>

                <div class="chatbox">

                    <?php

                    while ($msg = mysqli_fetch_assoc($chat)) {

                        $class = strtolower($msg['sender']);

                        echo "<div class='$class'>";
                        echo "<strong>" . htmlspecialchars($msg['sender']) . ": </strong>";
                        echo htmlspecialchars($msg['message']);
                        echo "</div>";
                    }

                    ?>

                </div>

                <form method="POST">

                    <input type="hidden" name="user" value="<?php echo htmlspecialchars($user); ?>">

                    <input type="text" name="message" placeholder="Type reply..." required>

                    <button type="submit" name="send">Send</button>

                </form>

            <?php

            } else {
                echo "<h3>Select a user from the left.</h3>";
            }

            ?>

        </div>

    </div>

</body>

</html>