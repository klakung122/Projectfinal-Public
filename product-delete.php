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

    $query = "SELECT * FROM products WHERE id = '$product_id' AND user_id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);

        $folderPath = "img/product/";

        $imagePaths = [
            $folderPath . $product['profile_image'],
            $folderPath . $product['profile_image2'],
            $folderPath . $product['profile_image3']
        ];

        foreach ($imagePaths as $imagePath) {
            if (!empty($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

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
exit();
mysqli_close($conn);
