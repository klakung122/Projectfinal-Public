<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = 'Please log in first!';
    header('Location: login');
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '{$user_id}'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user['type_id'] != 3) {
    $_SESSION['message'] = 'Access denied! You are not an admin.';
    header('Location: login');
    exit();
}

if (isset($_GET['approve'])) {
    $product_id = $_GET['approve'];

    $query = "UPDATE products SET approved = 1 WHERE id = '{$product_id}'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = 'Product approved successfully.';
    } else {
        $_SESSION['message'] = 'Failed to approve the product.';
    }
    header('Location: admin');
    exit();
}

$pending_products = mysqli_query($conn, "
    SELECT p.*, u.username 
    FROM products p 
    JOIN users u ON p.user_id = u.id
    WHERE p.approved = 0
");

if (isset($_GET['toggle_ads'])) {
    $product_id = $_GET['toggle_ads'];
    $current_status = $_GET['current_status'];
    $new_status = $current_status == 1 ? 0 : 1;

    $query = "UPDATE products SET ads = '{$new_status}' WHERE id = '{$product_id}'";
    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = $new_status == 1 ? 'Product added to Ads successfully.' : 'Product removed from Ads successfully.';
    } else {
        $_SESSION['message'] = 'Failed to update Ads status.';
    }
    header('Location: admin');
    exit();
}

$query = "SELECT p.*, u.username FROM products p JOIN users u ON p.user_id = u.id";
$all_products = mysqli_query($conn, $query);

$query = "SELECT * FROM contacts";
$contacts = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>
    <link rel="stylesheet" href="assets/css/style-admin.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu-login.php'; ?>

    <section id="body">
        <main>
            <h1>Admin Panel</h1>
            <p>Welcome, Admin <?php echo htmlspecialchars($user['fullname']); ?>!</p>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="message">
                    <?php echo $_SESSION['message'];
                    unset($_SESSION['message']); ?>
                </div>
            <?php endif; ?>

            <h2>Pending Product Approvals</h2>
            <table class="approved">
                <thead>
                    <tr>
                        <th style="width: 100px;">Image</th>
                        <th>Product Name</th>
                        <th style="width: 200px;">Price</th>
                        <th style="width: 200px;">Username</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($pending_products) > 0): ?>
                        <?php while ($product = mysqli_fetch_assoc($pending_products)): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($product['profile_image'])): ?>
                                        <img src="img/product/<?php echo $product['profile_image']; ?>" width="100" alt="Product Image">
                                    <?php else: ?>
                                        <img src="img/product/no-image.png" width="100" alt="Product Image">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                    <small>ที่อยู่: <?php echo htmlspecialchars($product['address']); ?></small><br>
                                    <small>เบอร์โทร: <?php echo htmlspecialchars($product['tel']); ?></small>
                                </td>
                                <td>
                                    <?php echo number_format($product['price']); ?> บาท
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($product['username']); // แสดงชื่อผู้ใช้ 
                                    ?>
                                </td>
                                <td>
                                    <a class="a-approve" href="admin?approve=<?php echo $product['id']; ?>" role="button">
                                        <i class="fa-solid fa-check"></i>
                                    </a> |
                                    <a class="a-reject" href="admin-delete?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to reject and delete this product?');" role="button">
                                        <i class="fa-solid fa-xmark"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">ไม่มีรายการสินค้าที่รอการอนุมัติ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table><br><br>

            <h2>All Massege</h2>
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($contacts) > 0): ?>
                        <?php while ($contact = mysqli_fetch_assoc($contacts)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contact['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                                <td><?php echo nl2br(htmlspecialchars($contact['message'])); ?></td>
                                <td>
                                    <a class="a-reject" href="admin-delete-contact?id=<?php echo $contact['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" role="button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">ไม่มีข้อความในระบบ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table><br><br>

            <h2>All Products</h2>
            <table class="all-pro">
                <thead>
                    <tr>
                        <th style="width: 100px;">Image</th>
                        <th>Product Name</th>
                        <th style="width: 200px;">Price</th>
                        <th>Ads</th>
                        <th style="width: 200px;">Username</th>
                        <th style="width: 200px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($all_products) > 0): ?>
                        <?php while ($product = mysqli_fetch_assoc($all_products)): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($product['profile_image'])): ?>
                                        <img src="img/product/<?php echo $product['profile_image']; ?>" width="100" alt="Product Image">
                                    <?php else: ?>
                                        <img src="img/product/no-image.png" width="100" alt="Product Image">
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                                <td><?php echo number_format($product['price']); ?> บาท</td>
                                <td><?php echo $product['ads'] == 1 ? 'Yes' : 'No'; ?></td>
                                <td><?php echo htmlspecialchars($product['username']); ?></td>
                                <td>
                                    <a class="a-approve" href="admin?toggle_ads=<?php echo $product['id']; ?>&current_status=<?php echo $product['ads']; ?>"
                                        onclick="return confirm('Are you sure you want to <?php echo $product['ads'] == 1 ? 'remove' : 'add'; ?> this product from Ads?');">
                                        <?php echo $product['ads'] == 1 ? '<i class="fa-solid fa-delete-left"></i> Ads' : '<i class="fa-brands fa-square-threads"></i> Ads'; ?>
                                    </a> |
                                    <a class="a-reject" href="admin-delete?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure you want to reject and delete this product?');" role="button">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">ไม่มีสินค้าในระบบ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </section>

    <?php include 'include/footer.php'; ?>
    <script src="assets/js/script.js"></script>
    <?php mysqli_close($conn); ?>
</body>

</html>