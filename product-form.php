<?php
session_start();
include 'config.php';

// แนะนำให้ปิดการแสดง error บนหน้า (กัน header ส่งไม่ได้เวลาเกิด warning)
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'You must be logged in to post a product.';
    header('Location: login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ---- Input ----
    $product_name  = trim($_POST['product_name'] ?? '');
    $price         = $_POST['price'] ?? 1000;
    $address       = trim($_POST['address'] ?? '');
    $description   = trim($_POST['description'] ?? '');
    $garage        = isset($_POST['garage']) ? 1 : 0;
    $pet           = isset($_POST['pet']) ? 1 : 0;
    $tel           = trim($_POST['tel'] ?? '');
    $user_id       = $_SESSION['user_id'];

    // ไฟล์รูป (ใช้ชื่อไฟล์เดิม ไม่สุ่ม)
    $image_name    = $_FILES['profile_image']['name']  ?? '';
    $image_name2   = $_FILES['profile_image2']['name'] ?? '';
    $image_name3   = $_FILES['profile_image3']['name'] ?? '';

    $image_tmp     = $_FILES['profile_image']['tmp_name']  ?? '';
    $image_tmp2    = $_FILES['profile_image2']['tmp_name'] ?? '';
    $image_tmp3    = $_FILES['profile_image3']['tmp_name'] ?? '';

    // ---- Validate ----
    if ($product_name === '' || $price === '' || $address === '' || $tel === '') {
        $_SESSION['message'] = "Apartment name, price, address, and tel are required!";
        header("Location: product-post");
        exit();
    }

    // ---- Paths (Absolute) ----
    $uploadDir = __DIR__ . '/img/product/'; // พาธจริงในเครื่อง
    if (!is_dir($uploadDir)) {
        // สร้างโฟลเดอร์ถ้ายังไม่มี
        @mkdir($uploadDir, 0775, true);
    }

    // ---- Query: INSERT/UPDATE ----
    if (!empty($_POST['id'])) {
        // Update mode
        $id = $_POST['id'];

        $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$id}' AND user_id='{$user_id}'");
        $result = mysqli_fetch_assoc($query_product);

        if (!$result) {
            $_SESSION['message'] = 'Product not found or no permission.';
            header('Location: product-post');
            mysqli_close($conn);
            exit();
        }

        // ถ้าไม่ได้อัปโหลดไฟล์ใหม่ ให้ใช้ชื่อเดิม
        $image_name  = $image_name  !== '' ? $image_name  : ($result['profile_image']  ?? '');
        $image_name2 = $image_name2 !== '' ? $image_name2 : ($result['profile_image2'] ?? '');
        $image_name3 = $image_name3 !== '' ? $image_name3 : ($result['profile_image3'] ?? '');

        // ลบไฟล์เก่าถ้ามีอัปโหลดใหม่
        if (!empty($_FILES['profile_image']['name'])  && !empty($result['profile_image']))  { @unlink($uploadDir . $result['profile_image']); }
        if (!empty($_FILES['profile_image2']['name']) && !empty($result['profile_image2'])) { @unlink($uploadDir . $result['profile_image2']); }
        if (!empty($_FILES['profile_image3']['name']) && !empty($result['profile_image3'])) { @unlink($uploadDir . $result['profile_image3']); }

        $query = mysqli_query($conn, "
            UPDATE products SET
                product_name='{$product_name}',
                price='{$price}',
                profile_image='{$image_name}',
                profile_image2='{$image_name2}',
                profile_image3='{$image_name3}',
                address='{$address}',
                description='{$description}',
                tel='{$tel}',
                garage='{$garage}',
                pet='{$pet}',
                approved=0
            WHERE id='{$id}' AND user_id='{$user_id}'
        ");
    } else {
        // Insert mode
        $query = mysqli_query($conn, "
            INSERT INTO products
                (product_name, price, profile_image, profile_image2, profile_image3, address, description, tel, user_id, garage, pet, approved)
            VALUES
                ('{$product_name}', '{$price}', '{$image_name}', '{$image_name2}', '{$image_name3}', '{$address}', '{$description}', '{$tel}', '{$user_id}', '{$garage}', '{$pet}', 0)
        ");
    }

    // ---- Move files (ชัวร์ด้วย absolute path + เช็ค is_uploaded_file) ----
    if ($query) {
        if ($image_name  !== '' && is_uploaded_file($image_tmp))  { @move_uploaded_file($image_tmp,  $uploadDir . $image_name); }
        if ($image_name2 !== '' && is_uploaded_file($image_tmp2)) { @move_uploaded_file($image_tmp2, $uploadDir . $image_name2); }
        if ($image_name3 !== '' && is_uploaded_file($image_tmp3)) { @move_uploaded_file($image_tmp3, $uploadDir . $image_name3); }

        $_SESSION['message'] = !empty($_POST['id']) ? 'Product updated successfully.' : 'Product added successfully.';
    } else {
        $_SESSION['message'] = 'Failed to save the product. Please try again.';
    }

    header('Location: product-post');
    mysqli_close($conn); // ปิดครั้งเดียวพอ
    exit(); // กัน header ซ้ำ และกันโค้ดข้างล่างรันต่อ
}