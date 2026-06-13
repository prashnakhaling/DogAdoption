<?php
include 'dataconnection.php';

if (isset($_POST['message'])) {
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    mysqli_query($conn, "
        INSERT INTO chat_messages(sender,receiver,message)
        VALUES('Admin','User','$message')
    ");
}

$result = mysqli_query($conn, "
    SELECT * FROM chat_messages
    WHERE sender='Admin' OR receiver='Admin'
    ORDER BY sent_at ASC
");
?>

<h2>Admin Chat Panel</h2>

<div style="height:300px;overflow-y:auto;border:1px solid #ccc;padding:10px;">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <p>
            <b><?php echo $row['sender']; ?>:</b>
            <?php echo htmlspecialchars($row['message']); ?>
        </p>
    <?php } ?>
</div>

<form method="POST">
    <input type="text" name="message" placeholder="Reply..." required>
    <button type="submit">Send</button>
</form>