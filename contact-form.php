<?php
session_start();
include 'config.php';

$logged_in = isset($_SESSION['user_id']);
$user_id = $logged_in ? $_SESSION['user_id'] : 7; // ถ้าไม่ได้ login, ใช้ user_id = 7

if ($logged_in) {
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

// ตรวจสอบเมื่อมีการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $logged_in ? $user['fullname'] : mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = $logged_in ? $user['email'] : mysqli_real_escape_string($conn, $_POST['email']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO contacts (user_id, email, fullname, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "issss", $user_id, $email, $fullname, $subject, $message);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['message'] = "Your message has been sent successfully!";
    } else {
        $_SESSION['message'] = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: contact");
    exit();
}

mysqli_close($conn);
