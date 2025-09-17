<?php
session_start();
include 'config.php';

// กัน warning โผล่จน header ใช้ไม่ได้
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id    = $_SESSION['user_id'];

    $sql = "SELECT profile_image, profile_image2, profile_image3
            FROM products
            WHERE id = '$product_id' AND user_id = '$user_id'
            LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);

        // ใช้ absolute path เสมอ
        $folderPath = rtrim(__DIR__, '/\\') . '/img/product/';

        // ฟังก์ชันลบแบบกันตาย
        $deleteIfSafe = function ($name) use ($folderPath) {
            if (!is_string($name) || $name === '') return;

            // เอาเฉพาะชื่อไฟล์ (กัน path traversal)
            $base = trim(basename(str_replace('\\', '/', $name)));

            // ถ้ากลายเป็นค่าว่าง/จุด/ขึ้นไดเรกทอรี ให้ข้าม
            if ($base === '' || $base === '.' || $base === '..') return;

            // ห้ามมีสแลชเหลืออยู่ (กันหลุดโฟลเดอร์)
            if (strpos($base, '/') !== false) return;

            $full = $folderPath . $base;

            // ต้องเป็น "ไฟล์" จริงเท่านั้น (ถ้าเป็นโฟลเดอร์/ไม่มีไฟล์ จะไม่ลบ)
            if (is_file($full)) {
                @unlink($full);
            }
        };

        // ไล่ลบทีละรูป (ถ้ามี)
        $deleteIfSafe($product['profile_image']  ?? '');
        $deleteIfSafe($product['profile_image2'] ?? '');
        $deleteIfSafe($product['profile_image3'] ?? '');

        // ลบเรคคอร์ด
        $del = mysqli_query($conn, "DELETE FROM products WHERE id = '$product_id' AND user_id = '$user_id'");
        $_SESSION['message'] = $del ? "Product and images deleted successfully!" : "Error deleting product.";
    } else {
        $_SESSION['message'] = "You do not have permission to delete this product.";
    }
}

header("Location: product-post");
mysqli_close($conn);
exit();