<?php
session_start();
include 'config.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'");
    $product = mysqli_fetch_assoc($query);
}

// ตรวจสอบสถานะการกด like ของผู้ใช้
$is_liked = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $like_query = "SELECT * FROM `like` WHERE user_id = '$user_id' AND product_id = '$product_id'";
    $like_result = mysqli_query($conn, $like_query);
    $is_liked = mysqli_num_rows($like_result) > 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>
    <link rel="stylesheet" href="assets/css/style-details.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu.php'; ?>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">

            <div class="single-img-col">
                <?php if (!empty($product['profile_image'])) : ?>
                    <img src="img/product/<?php echo $product['profile_image']; ?>" width="100%" id="MainImg" alt="Product Image">
                <?php else : ?>
                    <img src="img/product/no-image.png" width="100%" id="MainImg" alt="Product Image">
                <?php endif; ?>
            </div>

            <div class="small-img-group">
                <div class="small-img-col">
                    <?php if (!empty($product['profile_image'])) : ?>
                        <img src="img/product/<?php echo $product['profile_image']; ?>" width="100%" class="Small-img" alt="Product Image">
                    <?php else : ?>
                        <img src="img/product/no-image.png" width="100%" class="Small-img" alt="Product Image">
                    <?php endif; ?>
                </div>

                <div class="small-img-col">
                    <?php if (!empty($product['profile_image2'])) : ?>
                        <img src="img/product/<?php echo $product['profile_image2']; ?>" width="100%" class="Small-img" alt="Product Image">
                    <?php else : ?>
                        <img src="img/product/no-image.png" width="100%" class="Small-img" alt="Product Image">
                    <?php endif; ?>
                </div>

                <div class="small-img-col">
                    <?php if (!empty($product['profile_image3'])) : ?>
                        <img src="img/product/<?php echo $product['profile_image3']; ?>" width="100%" class="Small-img" alt="Product Image">
                    <?php else : ?>
                        <img src="img/product/no-image.png" width="100%" class="Small-img" alt="Product Image">
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="single-pro-details">
            <h6>ห้องเช่า / <?php echo nl2br($product['address']); ?></h6>
            <h4><?php echo $product['product_name']; ?></h4>
            <h2><?php echo number_format($product['price']); ?> บาท/เดือน</h2>
            <a href="" class="tel"><i class="fa-solid fa-phone"></i> <?php echo nl2br($product['tel']); ?></a>
            <form action="like-form" method="post">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                <button type="submit" name="like" class="like <?php echo $is_liked ? 'liked' : ''; ?>">
                    <i class="fa-regular fa-heart"></i>
                    <i class="fa-solid fa-heart"></i>
                </button>
            </form>

            <h4>Description :</h4>
            <span><?php echo nl2br($product['description']); ?></span>

            <div class="extra-details">
                <?php if ($product['garage'] == 1) : ?>
                    <p><i class="fa-solid fa-car"></i> มีที่จอดรถ</p>
                <?php endif; ?>

                <?php if ($product['pet'] == 1) : ?>
                    <p><i class="fa-solid fa-paw"></i> อนุญาตให้เลี้ยงสัตว์</p>
                <?php endif; ?>
            </div>
        </div>

    </section>

    <?php include 'include/footer.php'; ?>

    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("Small-img");

        smallimg[0].onclick = function() {
            MainImg.src = smallimg[0].src;
        }
        smallimg[1].onclick = function() {
            MainImg.src = smallimg[1].src;
        }
        smallimg[2].onclick = function() {
            MainImg.src = smallimg[2].src;
        }
    </script>

    <?php mysqli_close($conn); ?>
</body>

</html>