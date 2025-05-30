<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "Both fields are required.";
        header("Location: login");
        exit();
    }

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: profile");
            exit();
        } else {
            $_SESSION['message'] = "Incorrect password.";
            header("Location: login");
            exit();
        }
    } else {
        $_SESSION['message'] = "User not found.";
        header("Location: login");
        exit();
    }
}
mysqli_close($conn);
