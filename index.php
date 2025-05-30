<?php
session_start();
include 'config.php';

$productsPerPage = 20;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $productsPerPage;

$priceMin = isset($_GET['price-min']) ? intval($_GET['price-min']) : 1000;
$priceMax = isset($_GET['price-max']) ? intval($_GET['price-max']) : 50000;

$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM products WHERE approved = 1");
$totalRow = mysqli_fetch_assoc($totalQuery);
$totalProducts = $totalRow['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

$query = mysqli_query($conn, "SELECT * FROM products WHERE approved = 1 ORDER BY ads DESC LIMIT $offset, $productsPerPage");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-index.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>

</head>

<body>

    <?php include 'include/menu.php'; ?>

    <section id="hero">
        <h2>เว็บประกาศ ให้เช่า</h2>
        <h1>คอนโด บ้าน</h1>
        <form action="search" method="GET">
            <input type="text" class="search" name="query" placeholder="Search for addresses...">

            <label for="garage">
                <input type="checkbox" name="garage" id="garage" <?php echo isset($_GET['garage']) ? 'checked' : ''; ?> /> <i class="fa-solid fa-car"></i>
            </label>

            <label for="pet">
                <input type="checkbox" name="pet" id="pet" <?php echo isset($_GET['pet']) ? 'checked' : ''; ?> /> <i class="fa-solid fa-paw"></i>
            </label>

            <div class="price-range">
                <label for="price-range">Price Range:</label>
                <div class="slider-container">
                    <input type="range" name="price-min" id="price-min" min="1000" max="50000" step="500"
                        value="<?php echo htmlspecialchars($priceMin); ?>" oninput="updatePriceLabels()" />
                    <input type="range" name="price-max" id="price-max" min="1000" max="50000" step="500"
                        value="<?php echo htmlspecialchars($priceMax); ?>" oninput="updatePriceLabels()" />
                    <div class="price-labels">
                        <span id="price-min-label"><?php echo $priceMin; ?></span> -
                        <span id="price-max-label"><?php echo $priceMax; ?></span>
                    </div>
                </div>
            </div>
            </div>

            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/features/f1.png" alt="">
            <h6>Convenient to use</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f2.png" alt="">
            <h6>Save time</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="img/features/f6.png" alt="">
            <h6>F24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>หาห้องเช่า</h2>
        <p>ที่คุณถูกใจ</p>
        <div class="pro-container">
            <?php if (mysqli_num_rows($query) > 0) : ?>
                <?php while ($product = mysqli_fetch_assoc($query)) : ?>
                    <div class="pro" onclick="window.location.href='product-details?id=<?php echo $product['id']; ?>'">

                        <?php if ($product['ads'] == 1) : ?>
                            <div class="ads-label">Premium</div>
                        <?php endif; ?>

                        <?php if (!empty($product['profile_image'])) : ?>
                            <img src="img/product/<?php echo $product['profile_image']; ?>" alt="Product_Image">
                        <?php else : ?>
                            <img src="img/product/no-image.png" alt="Product_Image">
                        <?php endif; ?>
                        <div class="des">
                            <span><?php echo nl2br($product['address']); ?></span>
                            <h5><?php echo $product['product_name']; ?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4><?php echo number_format($product['price']); ?> บาท/เดือน</h4>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages) : ?>
                <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
            <?php endif; ?>
        </div>
    </section>

    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <script>
        function updatePriceLabels() {
            const minSlider = document.getElementById('price-min');
            const maxSlider = document.getElementById('price-max');
            const minLabel = document.getElementById('price-min-label');
            const maxLabel = document.getElementById('price-max-label');

            minLabel.textContent = minSlider.value;
            maxLabel.textContent = maxSlider.value;

            if (parseInt(minSlider.value) > parseInt(maxSlider.value)) {
                maxSlider.value = minSlider.value;
                maxLabel.textContent = maxSlider.value;
            }
        }
        window.onload = updatePriceLabels;
    </script>

    <?php mysqli_close($conn); ?>
</body>

</html>