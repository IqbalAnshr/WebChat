<?php
while ($row = mysqli_fetch_assoc($result)) {

    $query = 'SELECT * FROM messages WHERE (id_incoming_message = ' . $row['id'] . ' AND id_outgoing_message = ' . $_SESSION['id'] . ') OR (id_incoming_message = ' . $_SESSION['id'] . ' AND id_outgoing_message = ' . $row['id'] . ') ORDER BY id DESC LIMIT 1';
    $messageResult = mysqli_query($conn, $query);

    if ($messageResult) {
        if (mysqli_num_rows($messageResult) > 0) {
            $messageRow = mysqli_fetch_assoc($messageResult);
            $message = $messageRow['message'] ?? "No message available";
            if ($messageRow['id_outgoing_message'] == $_SESSION['id']) {
                $message = "You: " . $message;
            }
            $message = strlen($message) > 20 ? substr($message, 0, 20) . '...' : $message;
        } else {
            $message = "No message available";
        }
    } else {
        $message = "Error retrieving messages";
    }

    $output .= '
    <a href="/chat.php?id=' . $row['id'] . '">
    <div class="user">
        <div class="user-wrapper">
            <img src="' . $row['photo_profile'] . '" alt="user">
            <div class="user-info">
                <p class="name">' . $row['username'] . '</p>
                <p class="message">' . $message . '</p>
            </div>

        </div>
        <p class="status">' . $row['status'] . '</p>
    </div>
    </a>
    ';

}

