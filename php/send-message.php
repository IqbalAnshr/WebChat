<?php

session_start();
require_once __DIR__ . '/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $sql = "INSERT INTO messages (id_incoming_message, id_outgoing_message, message) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}')";
    $result = mysqli_query($conn, $sql);
}