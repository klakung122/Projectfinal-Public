<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// ดึงข้อมูลสินค้าที่ผู้ใช้กด like
$query = "SELECT p.* FROM `like` l JOIN `products` p ON l.product_id = p.id WHERE l.user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// เก็บข้อมูลสินค้าที่ like ไว้ในอาร์เรย์
$liked_products = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $liked_products[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-profile.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu-login.php'; ?>
    <section id="body">
        <section id="profile-details">
            <h2>Welcome, <?php echo htmlspecialchars($user['fullname']); ?>!</h2><br>

            <table>
                <tr>
                    <td style="width: 150px;">Username :</td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>

                <tr>
                    <td>Full Name :</td>
                    <td><?php echo htmlspecialchars($user['fullname']); ?></td>
                </tr>

                <tr>
                    <td>Email :</td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                </tr>

                <tr>
                    <td>Type Account :</td>
                    <td>
                        <?php
                        if ($user['type_id'] == 3) {
                            echo "Admin";
                        } elseif ($user['type_id'] == 2) {
                            echo "ผู้ให้เช่า";
                        } elseif ($user['type_id'] == 1) {
                            echo "ผู้เช่า";
                        } else {
                            echo "ไม่ทราบประเภทบัญชี";
                        }
                        ?>
                    </td>
                </tr>
            </table>

            <?php if ($user['type_id'] >= 2): ?>
                <div class="post">
                    <a href="product-post">Post your Apartment</a>
                </div>
            <?php endif; ?>

            <?php if ($user['type_id'] == 3): ?>
                <div class="admin-panel">
                    <a href="admin">Go to Admin Panel</a>
                </div>
            <?php endif; ?>

            <div class="logout">
                <a href="logout">Sign Out</a>
            </div>
        </section>

        <section id="profile-like">
            <div class="pro-title">
                <h2>รายการที่กดถูกใจ</h2>
            </div>
            <div class="pro-like-con">
                <?php if (count($liked_products) > 0): ?>
                    <?php foreach ($liked_products as $product): ?>
                        <div class="like-con" onclick="window.location.href='product-details?id=<?php echo $product['id']; ?>'">
                            <img src="img/product/<?php echo !empty($product['profile_image']) ? $product['profile_image'] : 'no-image.png'; ?>" alt="Product Image">
                            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                            <form action="profile-like-form" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                                <button type="submit" name="like" class="like liked">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>คุณยังไม่ได้กดถูกใจสินค้าใดๆ</p>
                <?php endif; ?>
            </div>
        </section>

    </section>
    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>

    <?php mysqli_close($conn); ?>
</body>

</html>