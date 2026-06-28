<?php
session_start();
include 'dataconnection.php';

$user = $_SESSION['username'] ?? '';

if ($user == '') {
    header("Location: login.php");
    exit();
}

/* ================= SEND MESSAGE ================= */
if (isset($_POST['message']) && !empty($_POST['message'])) {

    $message = mysqli_real_escape_string($conn, $_POST['message']);

    mysqli_query($conn, "
        INSERT INTO chat_messages(sender, receiver, message)
        VALUES('$user', 'Admin', '$message')
    ");

    header("Location: user_chatsupport.php");
    exit();
}

/* ================= DELETE MESSAGE ================= */
if (isset($_GET['delete'])) {

    $id = (int) $_GET['delete'];

    mysqli_query($conn, "
        DELETE FROM chat_messages 
        WHERE id=$id AND sender='$user'
    ");

    header("Location: user_chatsupport.php");
    exit();
}

/* ================= LOAD EDIT ================= */
$editData = null;

if (isset($_GET['edit'])) {

    $id = (int) $_GET['edit'];

    $res = mysqli_query($conn, "
        SELECT * FROM chat_messages 
        WHERE id=$id AND sender='$user'
    ");

    $editData = mysqli_fetch_assoc($res);
}

/* ================= UPDATE MESSAGE ================= */
if (isset($_POST['edit_id']) && isset($_POST['edit_message'])) {

    $id = (int) $_POST['edit_id'];
    $msg = mysqli_real_escape_string($conn, $_POST['edit_message']);

    mysqli_query($conn, "
        UPDATE chat_messages 
        SET message='$msg'
        WHERE id=$id AND sender='$user'
    ");

    header("Location: user_chatsupport.php");
    exit();
}

/* ================= FETCH CHAT ================= */
$result = mysqli_query($conn, "
    SELECT *
    FROM chat_messages
    WHERE
        (sender='$user' AND receiver='Admin')
        OR
        (sender='Admin' AND receiver='$user')
    ORDER BY sent_at ASC
");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Chat With Admin</title>

    <style>
        body {
            font-family: Arial;
            margin: 0;
            background: #f5f5f5;
        }

        .chat-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: #fff;
            position: relative;
        }

        .chat-box {
            height: 600px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background: #fafafa;
        }

        /* MESSAGE BUBBLE FIX */
        .message-box {
            position: relative;
            padding: 10px 40px 10px 10px;
            margin: 10px 0;
        }

        .user {
            background: #4a90e2;
            color: white;
            padding: 10px;
            border-radius: 15px;
            max-width: 70%;
            margin-left: auto;
        }

        .admin {
            background: #e5e5ea;
            color: black;
            padding: 10px;
            border-radius: 15px;
            max-width: 70%;
        }

        .msg-text {
            word-wrap: break-word;
        }

        /* 3 DOT MENU FIXED */
        .menu-container {
            position: absolute;
            top: 5px;
            right: 8px;
            cursor: pointer;
        }

        .dots {
            font-size: 18px;
            color: #555;
        }

        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            top: 20px;
            background: white;
            min-width: 120px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
            z-index: 10;
        }

        .dropdown a {
            display: block;
            padding: 10px;
            font-size: 13px;
            text-decoration: none;
            color: black;
        }

        .dropdown a:hover {
            background: #f2f2f2;
        }

        .menu-container:hover .dropdown {
            display: block;
        }

        .delete {
            color: red;
        }

        /* INPUT AREA */
        form {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        input[type=text] {
            flex: 1;
            padding: 10px;
            border-radius: 20px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            background: #4a90e2;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        button:hover {
            background: #357bd8;
        }

        .back-home {
            position: absolute;
            top: 15px;
            right: 15px;
            background: #4a90e2;
            color: white;
            padding: 8px 12px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 13px;
            z-index: 20;
            transition: 0.2s;
        }

        .back-home:hover {
            background: #357bd8;
        }
    </style>
</head>

<body>

    <div class="chat-container">

        <h2>💬 Chat With Admin</h2>

        <div class="chat-box">

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>

                <div class="message-box <?php echo strtolower($row['sender']); ?>">

                    <div class="msg-text">
                        <strong><?php echo htmlspecialchars($row['sender']); ?>:</strong><br>
                        <?php echo htmlspecialchars($row['message']); ?>
                    </div>

                    <?php if ($row['sender'] == $user) { ?>

                        <div class="menu-container">
                            <span class="dots">⋮</span>

                            <div class="dropdown">
                                <a href="?edit=<?php echo $row['id']; ?>">Edit</a>

                                <a href="?delete=<?php echo $row['id']; ?>"
                                    class="delete"
                                    onclick="return confirm('Delete this message?');">
                                    Delete
                                </a>
                            </div>
                        </div>

                    <?php } ?>

                </div>

            <?php } ?>

        </div>

        <!-- FORM -->
        <form method="POST">

            <?php if ($editData) { ?>

                <input type="hidden" name="edit_id" value="<?php echo $editData['id']; ?>">

                <input type="text"
                    name="edit_message"
                    value="<?php echo htmlspecialchars($editData['message']); ?>"
                    required>

                <button type="submit">Update</button>

                <a href="user_chatsupport.php">Cancel</a>

            <?php } else { ?>

                <input type="text" name="message" placeholder="Type message..." required>
                <button type="submit">Send</button>

            <?php } ?>
            <a href="userdashboard.php" class="back-home">⬅ Back to Home</a>

        </form>

    </div>

</body>

</html>