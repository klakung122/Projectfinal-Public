<?php
session_start();
include 'config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-about.css">

    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>

</head>

<body>

    <?php include 'include/menu-about.php'; ?>

    <section id="page-header" class="about-header">
        <h2>#รู้จักเรา</h2>
        <p>โปรแกรมจัดหาห้องเช่า</p>
    </section>

    <section id="about-head" class="section-p1">
        <div>
            <h2>เราคือใคร?</h2>
            <p>เราคือ เว็บไซต์จัดหาห้องเช่า เป็นบริการหรือแพลตฟอร์มที่ช่วยให้ผู้ที่กำลังมองหาห้องเช่าสามารถค้นหาและเลือกห้องที่ตรงตามความต้องการได้อย่างสะดวก โดยส่วนใหญ่จะมีฟังก์ชันต่าง ๆ เช่น การค้นหาห้องตามทำเล ราคา ขนาด หรือประเภทของห้องเช่า เช่น ห้องแอร์, ห้องแชร์, หรือคอนโดมิเนียม เป็นต้น ผู้ใช้งานสามารถเข้าถึงข้อมูลห้องเช่าหลาย ๆ แห่งในที่เดียวได้ และ ผู้ให้เช่าสามารถใช้เว็บไซต์จัดหาห้องเช่าเพื่อโปรโมตและจัดการการเช่าห้องของตนได้อย่างสะดวก</p>

            <abbr title="">ขอบคุณที่ให้ความสนใจในเว็บไซต์ของเรา</abbr>

            <br><br>

            <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">หากพบเจอปัญหา หรือ สอบถามเพิ่มเติม สามรถติดต่อเราได้ผ่าน ช่องทาง Contact</marquee>
        </div>
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

    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>
    <?php mysqli_close($conn); ?>
</body>

</html>