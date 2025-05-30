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

<section id="header">
    <a href="http://localhost/project/">
        <img src="img/logo1.png" class="logo" alt="Company Logo" width="100">
    </a>

    <div>
        <ul id="navbar">
            <li><a class="active" href="http://localhost/project/">Home</a></li>
            <li><a href="about">About</a></li>
            <li><a href="contact">Contact</a></li>
            <li><a href="<?php echo $link; ?>"><i class="fa-solid fa-user"></i></a></li>
            <li><a href="#" id="close"><i class="fa-solid fa-xmark"></i></a></li>
        </ul>
    </div>
    <div id="mobile">
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>

<link rel="stylesheet" href="assets/css/style-index.css">
<script src="assets/js/script.js"></script>