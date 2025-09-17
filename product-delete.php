<?php
session_start();
include 'config.php';

// กัน warning โผล่บนจอ (แต่ยังล็อกลง error log)
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

        // ฟังก์ชันลบแบบกันตายสุดๆ
        $deleteIfSafe = function ($name) use ($folderPath) {
            if (!is_string($name) || trim($name) === '') return;

            // เอาเฉพาะชื่อไฟล์ (กัน path traversal)
            $base = trim(basename(str_replace('\\', '/', $name)));
            if ($base === '' || $base === '.' || $base === '..') return;
            if (strpos($base, '/') !== false) return; // ถ้ายังมี / อยู่ ให้ข้าม

            $full = $folderPath . $base;

            // ถ้าเป็นโฟลเดอร์หรือไม่มีไฟล์ ให้ข้ามทันที
            if (is_dir($full) || !is_file($full)) return;

            @unlink($full);
        };

        // ไล่ลบทีละรูป
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