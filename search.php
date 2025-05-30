<?php
session_start();
include 'config.php';

$query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';
$garage = isset($_GET['garage']) ? 1 : 0;
$pet = isset($_GET['pet']) ? 1 : 0;
$priceMin = isset($_GET['price-min']) ? intval($_GET['price-min']) : 1000;
$priceMax = isset($_GET['price-max']) ? intval($_GET['price-max']) : 50000;

$searchMessage = $query ? "Search results for: " . htmlspecialchars($query) : "Search results for:";

$sql = "SELECT * FROM products WHERE approved = 1";

if ($query) {
    $sql .= " AND (product_name LIKE '%$query%' OR address LIKE '%$query%')";
}

if ($garage) {
    $sql .= " AND garage = 1";
}

if ($pet) {
    $sql .= " AND pet = 1";
}

$sql .= " AND price >= $priceMin AND price <= $priceMax";

$sql .= " ORDER BY ads DESC";

$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);
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
        <h2>Search Results</h2>
        <p><?php echo $searchMessage; ?></p>

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

    <section id="filters">

    </section>

    <section id="product1" class="section-p1">
        <h2>หาห้องเช่า</h2>
        <p>ที่คุณถูกใจ</p>
        <div class="pro-container">
            <?php if ($rows > 0) : ?>
                <?php while ($product = mysqli_fetch_assoc($result)) : ?>
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
                <p>No products found for your search.</p>
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