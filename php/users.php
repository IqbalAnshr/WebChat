<?php

session_start();
require_once __DIR__ . '/config.php';

if (!isset($_SESSION['id'])) {
    header('location: login.php');
}

$outgoing_id = $_SESSION['id'];
$query = "SELECT * FROM users WHERE NOT id = {$outgoing_id} ORDER BY id DESC";
$result = mysqli_query($conn, $query);
$output = "";

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) == 0) {
    $output .= "No users are available to chat";
} else {
    require_once __DIR__ . '/data.php';
}
echo $output;
