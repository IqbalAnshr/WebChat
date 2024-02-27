<?php

require_once __DIR__ . '/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

    $usernames = mysqli_query($conn, 'SELECT username FROM users WHERE username = "' . $username . '"');
    $emails = mysqli_query($conn, 'SELECT email FROM users WHERE email = "' . $email . '"');

    if (!empty($username) && !empty($email) && !empty($password) && !empty($password2) && !empty($_FILES["photo-profile"])) {
        if ($password == $password2) {
            if (mysqli_num_rows($usernames) > 0) {
                echo "Username already exists";
            } else if (mysqli_num_rows($emails) > 0) {
                echo "Email already exists";
            } else {
                // Handle file upload
                if (isset($_FILES["photo-profile"])) {
                    // Informasi file
                    $file_name = $_FILES["photo-profile"]["name"];
                    $file_tmp = $_FILES["photo-profile"]["tmp_name"];
                    $file_type = $_FILES["photo-profile"]["type"];
                    $file_size = $_FILES["photo-profile"]["size"];
                    $file_error = $_FILES["photo-profile"]["error"];

                    // Validasi ekstensi file
                    $allowed_extensions = array("jpg", "jpeg", "png");
                    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    if (!in_array($file_extension, $allowed_extensions)) {
                        echo "Error: Hanya file JPG, JPEG, dan PNG yang diperbolehkan.";
                        exit;
                    }

                    // Validasi ukuran file
                    $max_file_size = 5 * 1024 * 1024; // 5MB dalam bytes
                    if ($file_size > $max_file_size) {
                        echo "Error: Ukuran file terlalu besar. Maksimum 5MB.";
                        exit;
                    }

                    $target_dir = "../uploads/";
                    $target_file = $target_dir . basename($file_name);
                    $file_path = "uploads/" . basename($file_name);

                    if (move_uploaded_file($file_tmp, $target_file)) {
                        $status = "Active now";
                        // Simpan data ke database
                        $query = "INSERT INTO users (username, email, password, photo_profile, status) VALUES ('$username', '$email', '$password', '$file_path', '$status')";
                        $result = mysqli_query($conn, $query);
                        if ($result) {
                            $query2 = "SELECT * FROM users WHERE username = '$username'";
                            $result2 = mysqli_query($conn, $query2);
                            if (mysqli_num_rows($result2) > 0) {
                                $row = mysqli_fetch_assoc($result2);
                                $_SESSION['id'] = $row['id'];
                                echo "success";
                            }
                        }
                    } else {
                        echo "Maaf, terjadi kesalahan saat mengunggah file.";
                    }
                }
            }
        } else {
            echo "Passwords do not match";
        }
    } else {
        echo "All fields must be filled";
    }
}