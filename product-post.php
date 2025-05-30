<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM products WHERE user_id = '$user_id'");

$rows = mysqli_num_rows($query);

$result = [
    'id' => '',
    'product_name' => '',
    'price' => '',
    'address' => '',
    'product_image' => '',
    'description' => '',
    'garage' => '',
    'pet' => '',
    'tel' => '',
];

if (!empty($_GET['id'])) {
    $query_product = mysqli_query($conn, "SELECT * FROM products WHERE id='{$_GET['id']}' AND user_id = '$user_id'");
    $row_product = mysqli_num_rows($query_product);

    if ($row_product == 0) {
        header('Location: product-post');
        exit();
    }

    $result = mysqli_fetch_assoc($query_product);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-productpost.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu-login.php'; ?>
    <section id="body">
        <section id="form-details">
            <form action="product-form" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $result['id']; ?>">

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="re-message">
                        <?php echo htmlspecialchars($_SESSION['message']); ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <h2>Upload Your Aapartment</h2><br>

                <label class="form-label">Apartment Name</label>
                <input type="text" name="product_name" class="form-control" value="<?php echo $result['product_name']; ?>">

                <label class="form-label">Price</label>
                <input type="text" name="price" class="form-control" value="<?php echo $result['price']; ?>">

                <?php if (!empty($result['profile_image'])): ?>
                    <div>
                        <img src="img/product/<?php echo $result['profile_image']; ?>" width="100" alt="Product_Image">
                    </div>
                <?php endif; ?>

                <label for="formFile" class="form-label">Main Image (Request 678px *460px)</label>
                <input type="file" name="profile_image" class="form-control" accept="image/png, image/jpg, image/jpeg">

                <?php if (!empty($result['profile_image2'])): ?>
                    <div>
                        <img src="img/product/<?php echo $result['profile_image2']; ?>" width="100" alt="Product_Image">
                    </div>
                <?php endif; ?>

                <label for="formFile" class="form-label">Secondary Image (Request 678px *460px)</label>
                <input type="file" name="profile_image2" class="form-control" accept="image/png, image/jpg, image/jpeg">

                <?php if (!empty($result['profile_image3'])): ?>
                    <div>
                        <img src="img/product/<?php echo $result['profile_image3']; ?>" width="100" alt="Product_Image">
                    </div>
                <?php endif; ?>

                <label for="formFile" class="form-label">Tertiary Image (Request 678px *460px)</label>
                <input type="file" name="profile_image3" class="form-control" accept="image/png, image/jpg, image/jpeg">

                <label class="form-label">Address</label>
                <select name="address" class="form-control" value="<?php echo $result['address']; ?>">
                    <option>อำเภอเมือง/ตลาดใหญ่</option>
                    <option>อำเภอเมือง/ตลาดเหนือ</option>
                    <option>อำเภอเมือง/เกาะแก้ว</option>
                    <option>อำเภอเมือง/รัษฎา</option>
                    <option>อำเภอเมือง/วิชิต</option>
                    <option>อำเภอเมือง/ฉลอง</option>
                    <option>อำเภอเมือง/ราไวย์</option>
                    <option>อำเภอเมือง/กะรน</option>
                    <option>อำเภอถลาง/เทพกระษัตรี</option>
                    <option>อำเภอถลาง/ศรีสุนทร</option>
                    <option>อำเภอถลาง/เชิงทะเล</option>
                    <option>อำเภอถลาง/ป่าคลอก</option>
                    <option>อำเภอถลาง/ไม้ขาว</option>
                    <option>อำเภอถลาง/สาคู</option>
                    <option>อำเภอกะทู้/กะทู้</option>
                    <option>อำเภอกะทู้/ป่าตอง</option>
                    <option>อำเภอกะทู้/กมลา</option>
                </select>

                <label class="form-label">Description</label>
                <input type="text" name="description" class="form-control" value="<?php echo $result['description']; ?>">

                <label class="form-label">Garage</label>
                <input type="checkbox" name="garage" class="form-check-input" value="1" <?php echo ($result['garage'] == 1 ? 'checked' : ''); ?>>

                <label class="form-label">Pet Allowed</label>
                <input type="checkbox" name="pet" class="form-check-input" value="1" <?php echo ($result['pet'] == 1 ? 'checked' : ''); ?>>


                <label class="form-label">Tel</label>
                <input type="tel" name="tel" class="form-control" value="<?php echo $result['tel']; ?>">

                <div class="but-form">
                    <?php if (empty($result['id'])): ?>
                        <button class="normal" type="submit"><i class="fa-solid fa-floppy-disk"></i> Create</button>
                    <?php else: ?>
                        <button class="normal" type="submit"><i class="fa-solid fa-floppy-disk"></i> Update</button>
                    <?php endif ?>
                    <a href="product-post"><i class="fa-solid fa-rotate-left"></i></i> Cancel</a>
                </div>

                <div class="logout">
                    <a href="logout">Sign Out</a>
                </div>

            </form>
        </section>

        <section id="form-edit">
            <table>
                <thead>
                    <th style="width: 100px;">Image</th>
                    <th>Product Name</th>
                    <th style="width: 200px;">Price</th>
                    <th style="width: 200px;">Action</th>
                </thead>
                <tbody>
                    <?php if ($rows > 0): ?>
                        <?php while ($product = mysqli_fetch_assoc($query)): ?>
                            <tr>
                                <td>
                                    <?php if (!empty($product['profile_image'])) : ?>
                                        <img src="img/product/<?php echo $product['profile_image']; ?>" width="100" alt="Product_Image">
                                    <?php else : ?>
                                        <img src="img/product/no-image.png" width="100" alt="Product_Image">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($product['product_name']); ?>
                                    <small>ที่อยู่ : <?php echo htmlspecialchars($product['address']); ?></small>
                                    <small>เบอร์โทร : <?php echo htmlspecialchars($product['tel']); ?></small>
                                </td>
                                <td>
                                    <?php echo number_format($product['price']); ?>
                                </td>
                                <td>
                                    <a class="a-edit" role="button" href="product-post?id=<?php echo $product['id']; ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a class="a-de" onclick="return confirm('Are you sure you want to delete');" role="button" href="product-delete?id=<?php echo $product['id']; ?>"><i class="fa-solid fa-delete-left"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">ไม่มีรายการ</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>

    </section>
    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>

    <?php mysqli_close($conn); ?>
</body>

</html>