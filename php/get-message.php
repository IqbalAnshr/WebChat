<?php

session_start();
if (isset($_SESSION['id'])) {
    require_once __DIR__ . '/config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $outgoing_id = $_SESSION['id'];
        $output = "";

        $query = "SELECT * FROM messages
        LEFT JOIN users ON users.id = messages.id_outgoing_message
        WHERE (id_incoming_message = {$incoming_id} AND id_outgoing_message = {$outgoing_id}) OR (id_incoming_message = {$outgoing_id} AND id_outgoing_message = {$incoming_id})
        ORDER BY messages.id ASC";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['id_outgoing_message'] == $outgoing_id) {
                    $output .= '<div class="message outgoing">
                <div class="text">
                    <p>' . $row['message'] . ' </p>
                </div>
            </div>';
                } else {
                    $output .= '<div class="message incoming">
                <img class="photo"
                    src="' . $row['photo_profile'] . '"
                    alt="user">
                <div class="text">
                    <p>' . $row['message'] . ' </p>
                </div>
            </div>';
                }
            }
            echo $output;
        } else {
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
            echo $output;
        }

    } else {
        $output .= 'bad request';
    }

} else {

    header("location: ../login.php");

}