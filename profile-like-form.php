<?php
session_start();
include 'config.php';

if (isset($_POST['like'])) {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    // ตรวจสอบว่ามี Like อยู่หรือไม่
    $check_like = "SELECT * FROM `like` WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $check_like);

    if (mysqli_num_rows($result) > 0) {
        // ลบ Like
        $delete_like = "DELETE FROM `like` WHERE user_id = '$user_id' AND product_id = '$product_id'";
        mysqli_query($conn, $delete_like);
    } else {
        // เพิ่ม Like
        $insert_like = "INSERT INTO `like` (user_id, product_id) VALUES ('$user_id', '$product_id')";
        mysqli_query($conn, $insert_like);
    }

    header("Location: profile");
    exit();
}
