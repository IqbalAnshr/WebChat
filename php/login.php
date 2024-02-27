<?php

require_once __DIR__ . '/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    if (!empty($email) && !empty($password)) {
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            mysqli_query($conn, 'UPDATE users SET status = "Active Now" WHERE id = ' . $_SESSION['id']);
            echo "success";
        } else {
            echo "Incorrect email or password";
        }
    } else {
        echo "All fields must be filled";
    }
}