<?php
// ตรวจสอบว่าผู้ใช้ล็อกอินหรือยัง
if (isset($_SESSION['user_id'])) {
    // หากล็อกอินแล้ว ให้ลิงก์ไปที่หน้าโปรไฟล์
    $link = "profile";
} else {
    // หากยังไม่ได้ล็อกอิน ให้ลิงก์ไปที่หน้า login
    $link = "login";
}
?>

<footer class="section-p1">
    <div class="col">
        <img src="img/logo1.png" class="logo" width="100" alt="">
        <h4>Contact</h4>
        <p><strong>Address: </strong> 55/5 Phuket Thailand</p>
        <p><strong>Phone: </strong> 096 327 4026 / 098 069 6960</p>
        <p><strong>Hours: </strong> 24/7</p>
        <div class="follow">
            <h4>Follow us</h4>
            <div class="icon">
                <i class="fab fa-facebook-f"></i>
                <i class="fab fa-x-twitter"></i>
                <i class="fab fa-instagram"></i>
                <i class="fab fa-pinterest-p"></i>
                <i class="fab fa-youtube"></i>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>About</h4>
        <a href="about">About Us</a>
        <a href="contact">Contact Us</a>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="<?php echo $link; ?>">Sign in</a>
        <a href="register">Sign up</a>
    </div>

    <div class="col install">
        <h4>Install App</h4>
        <p>Form App Store or Google Play</p>
        <div class="row">
            <img src="img/pay/app.jpg" alt="">
            <img src="img/pay/play.jpg" alt="">
        </div>
    </div>

    <div class="copyright">
        <p>© Living Condo Company,Inc</p>
    </div>
</footer>

<link rel="stylesheet" href="assets/css/style-index.css">
<script src="assets/js/script.js"></script>