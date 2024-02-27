<?php

session_start();
require_once __DIR__ . '/config.php';

if (isset($_GET['search'])) {
    $query = 'SELECT * FROM users WHERE NOT id = "' . $_SESSION['id'] . '" AND  username LIKE "%' . $_GET['search'] . '%"';
    $result = mysqli_query($conn, $query);
    $output = "";
    if (mysqli_num_rows($result) == 0) {
        $output .= "No username found";
    } elseif (mysqli_num_rows($result) > 0) {
        require_once __DIR__ . '/data.php';
    }
    echo $output;
} else {
    echo "shiballll";
}


