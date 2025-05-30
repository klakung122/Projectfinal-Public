<?php
session_start();
include 'config.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'Please log in first!';
    header('Location: login');
    exit();
}

// ตรวจสอบว่าได้รับค่าจาก URL ว่า id ของสินค้าที่จะลบ
if (!empty($_GET['id'])) {
    $product_id = $_GET['id'];

    // ตรวจสอบว่าผู้ใช้มีสิทธิ์ลบสินค้านี้หรือไม่
    $query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // ดึงข้อมูลสินค้า
        $product = mysqli_fetch_assoc($result);

        // ตรวจสอบสถานะการอนุมัติของสินค้า ถ้าไม่อนุมัติ (approved = 0) ถึงจะลบได้
        if ($product['approved'] == 0) {

            // กำหนดที่อยู่โฟลเดอร์ของภาพ
            $folderPath = "img/product/";

            // สร้างอาเรย์ที่เก็บไฟล์ภาพทั้งหมด
            $imagePaths = [
                $folderPath . $product['profile_image'],
                $folderPath . $product['profile_image2'],
                $folderPath . $product['profile_image3']
            ];

            // ลบไฟล์ภาพถ้ามี
            foreach ($imagePaths as $imagePath) {
                if (!empty($imagePath) && file_exists($imagePath)) {
                    unlink($imagePath); // ลบไฟล์
                }
            }

            // ลบข้อมูลสินค้าจากฐานข้อมูล
            $delete_query = "DELETE FROM products WHERE id = '$product_id'";
            if (mysqli_query($conn, $delete_query)) {
                $_SESSION['message'] = "Product and images deleted successfully!";
            } else {
                $_SESSION['message'] = "Error deleting product.";
            }
        } else {
            $_SESSION['message'] = "This product is already approved and cannot be deleted.";
        }
    } else {
        $_SESSION['message'] = "Product not found or you don't have permission to delete it.";
    }
} else {
    $_SESSION['message'] = "Invalid product ID.";
}

header("Location: admin");
exit();
mysqli_close($conn);
