<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $type_id = intval($_POST['type_id']);

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username) || empty($password) || empty($fullname) || empty($email) || empty($type_id)) {
        $_SESSION['message'] = "All fields are required.";
        header("Location: register");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match. Please try again.";
        header('Location: register');
        exit();
    }

    $type_check_query = "SELECT id FROM type WHERE id = $type_id";
    $type_check_result = mysqli_query($conn, $type_check_query);
    if (mysqli_num_rows($type_check_result) == 0) {
        $_SESSION['message'] = "Invalid user type selected.";
        header("Location: register");
        exit();
    }

    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    if (mysqli_num_rows(mysqli_query($conn, $check_email_query)) > 0) {
        $_SESSION['message'] = "Email already exists.";
        header("Location: register");
        exit();
    }

    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    if (mysqli_num_rows(mysqli_query($conn, $check_username_query)) > 0) {
        $_SESSION['message'] = "Username already exists.";
        header("Location: register");
        exit();
    }

    $insert_query = "INSERT INTO users (username, password, fullname, email, type_id) 
                     VALUES ('$username', '$hashed_password', '$fullname', '$email', $type_id)";
    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: login");
        exit();
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
        header("Location: register");
        exit();
    }
}
mysqli_close($conn);
