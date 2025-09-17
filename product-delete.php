<?php
session_start();
include 'config.php';

// กัน warning เด้งออกจอจน header ใช้ไม่ได้
ini_set('display_errors', 0);
ini_set('log_errors', 1);

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];
    $user_id    = $_SESSION['user_id'];

    // ดึงเฉพาะของตัวเอง
    $sql = "SELECT profile_image, profile_image2, profile_image3
            FROM products
            WHERE id = '$product_id' AND user_id = '$user_id'
            LIMIT 1";
    $res = mysqli_query($conn, $sql);

    if ($res && mysqli_num_rows($res) > 0) {
        $product = mysqli_fetch_assoc($res);

        // พาธปลายทางแบบ absolute + เคลียร์ท้ายให้เรียบร้อย
        $folderPath = rtrim(__DIR__ . '/img/product', '/') . '/';
        $folderReal = realpath($folderPath) ?: $folderPath; // เผื่อยังไม่มี realpath

        // รวมชื่อไฟล์ (อาจมีค่าว่าง/ขยะมา)
        $candidates = [
            $product['profile_image']  ?? '',
            $product['profile_image2'] ?? '',
            $product['profile_image3'] ?? '',
        ];

        foreach ($candidates as $raw) {
            // แปลง \ เป็น / แล้ว basename กัน path traversal + ตัดช่องว่าง
            $base = trim(basename(str_replace('\\', '/', (string)$raw)));

            // ข้ามค่าว่าง/จุด/โฟลเดอร์
            if ($base === '' || $base === '.' || $base === '..' || substr($base, -1) === '/') {
                continue;
            }

            $full = $folderPath . $base;

            // เช็กว่าเป็นไฟล์จริง และอยู่ใต้โฟลเดอร์ที่กำหนดเท่านั้น
            $fullReal = realpath($full);
            if ($fullReal !== false
                && str_starts_with($fullReal, rtrim($folderReal, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR)
                && is_file($fullReal)) {
                @unlink($fullReal);
            }
        }

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