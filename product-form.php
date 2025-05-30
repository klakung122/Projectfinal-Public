<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'You must be logged in to post a product.';
    header('Location: login');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = trim($_POST['product_name']);
    $price = $_POST['price'] ?: 1000;
    $address = trim($_POST['address']);
    $description = trim($_POST['description']);
    $garage = isset($_POST['garage']) ? 1 : 0;
    $pet = isset($_POST['pet']) ? 1 : 0;
    $tel = trim($_POST['tel']);
    $image_name = $_FILES['profile_image']['name'];
    $image_name2 = $_FILES['profile_image2']['name'];
    $image_name3 = $_FILES['profile_image3']['name'];

    if (empty($product_name) || empty($price) || empty($address) || empty($tel)) {
        $_SESSION['message'] = "Apartment name, price, address, and tel are required!";
        header("Location: product-post");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $folder = 'img/product/';
    $image_tmp = $_FILES['profile_image']['tmp_name'];
    $image_tmp2 = $_FILES['profile_image2']['tmp_name'];
    $image_tmp3 = $_FILES['profile_image3']['tmp_name'];
    $image_location = $folder . $image_name;
    $image_location2 = $folder . $image_name2;
    $image_location3 = $folder . $image_name3;

    if (!empty($_POST['id'])) {
        $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_POST['id']}' AND user_id='{$user_id}'");
        $result = mysqli_fetch_assoc($query_product);

        $image_name = empty($image_name) ? $result['profile_image'] : $image_name;
        $image_name2 = empty($image_name2) ? $result['profile_image2'] : $image_name2;
        $image_name3 = empty($image_name3) ? $result['profile_image3'] : $image_name3;

        if (!empty($_FILES['profile_image']['name'])) @unlink($folder . $result['profile_image']);
        if (!empty($_FILES['profile_image2']['name'])) @unlink($folder . $result['profile_image2']);
        if (!empty($_FILES['profile_image3']['name'])) @unlink($folder . $result['profile_image3']);

        $query = mysqli_query($conn, "UPDATE products 
                            SET product_name='{$product_name}', price='{$price}', profile_image='{$image_name}', 
                            profile_image2='{$image_name2}', profile_image3='{$image_name3}', address='{$address}', 
                            description='{$description}', tel='{$tel}', garage='{$garage}', pet='{$pet}', approved=0 
                            WHERE id='{$_POST['id']}' AND user_id='{$user_id}'");
    } else {
        $query = mysqli_query($conn, "INSERT INTO products 
                            (product_name, price, profile_image, profile_image2, profile_image3, address, description, tel, user_id, garage, pet, approved) 
                            VALUES ('{$product_name}', '{$price}', '{$image_name}', '{$image_name2}', '{$image_name3}', '{$address}', '{$description}', '{$tel}', '{$user_id}', '{$garage}', '{$pet}', 0)");
    }

    if ($query) {
        if (!empty($image_name)) move_uploaded_file($image_tmp, $image_location);
        if (!empty($image_name2)) move_uploaded_file($image_tmp2, $image_location2);
        if (!empty($image_name3)) move_uploaded_file($image_tmp3, $image_location3);

        $_SESSION['message'] = !empty($_POST['id']) ? 'Product updated successfully.' : 'Product added successfully.';
    } else {
        $_SESSION['message'] = 'Failed to save the product. Please try again.';
    }

    header('Location: product-post');
    mysqli_close($conn);
}
mysqli_close($conn);
