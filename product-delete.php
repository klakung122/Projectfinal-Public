<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // ดึงข้อมูลสินค้าเฉพาะของตัวเอง
    $sql  = "SELECT profile_image, profile_image2, profile_image3 FROM products WHERE id = '$product_id' AND user_id = '$user_id' LIMIT 1";
    $res  = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);

        // ใช้ absolute path กัน current dir งอแง
        $folderPath = __DIR__ . "/img/product/";

        // รวมชื่อไฟล์ที่อาจมี (ข้ามค่าว่าง)
        $names = array_filter([
            $product['profile_image'] ?? '',
            $product['profile_image2'] ?? '',
            $product['profile_image3'] ?? '',
        ], fn($v) => $v !== '' && $v !== null);

        foreach ($names as $name) {
            // กัน traversal เบื้องต้น + ต่อพาธ
            $base = basename($name);
            $full = $folderPath . $base;

            // ลบเฉพาะ "ไฟล์" ที่มีอยู่จริงเท่านั้น
            if (is_file($full)) {
                @unlink($full);
            }
        }

        // ลบเรคคอร์ด
        $delete_query = "DELETE FROM products WHERE id = '$product_id' AND user_id = '$user_id'";
        if (mysqli_query($conn, $delete_query)) {
            $_SESSION['message'] = "Product and images deleted successfully!";
        } else {
            $_SESSION['message'] = "Error deleting product.";
        }
    } else {
        $_SESSION['message'] = "You do not have permission to delete this product.";
    }
}

header("Location: product-post");
mysqli_close($conn);
exit();