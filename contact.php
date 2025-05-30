<?php
session_start();
include 'config.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
$logged_in = isset($_SESSION['user_id']);

if ($logged_in) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
} else {
    // ถ้าไม่ได้ล็อกอิน กำหนด user_id = 7
    $user_id = 7;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-contact.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu-contact.php'; ?>

    <section id="page-header" class="about-header">
        <h2>#มาพูดคุยกัน</h2>
        <p>ฝากข้อความไว้ เรายินดีรับฟังจากคุณ!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <h3>ติดต่อเรา</h3>
            <h2>เยี่ยมชมสถานที่ตั้งหน่วยงานของเราหรือติดต่อเราได้วันนี้</h2>
            <h3>สำนักงานใหญ่</h3>
            <div>
                <li><i class="fa-regular fa-map"></i>
                    <p>55/5 Phuket Thailand</p>
                </li>
                <li><i class="fa-regular fa-envelope"></i>
                    <p>65202040032@phuketvc.ac.th</p>
                </li>
                <li><i class="fa-solid fa-phone"></i>
                    <p>096 327 4026 / 098 069 6960</p>
                </li>
                <li><i class="fa-regular fa-clock"></i>
                    <p>10:00 - 18:00, Mon - Sat</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d415.443855291614!2d98.35067452814118!3d7.8541562796346645!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sth!2sth!4v1732270409912!5m2!1sth!2sth" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="contact-form.php" method="post">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="re-message">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <h3>ฝากข้อความไว้</h3>
            <h2>เรายินดีรับฟังจากคุณ</h2>

            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <?php if ($logged_in): ?>
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
                </table>
            <?php else: ?>
                <label for="fullname">Fullname :</label>
                <input type="text" name="fullname" placeholder="Fullname" required>

                <label for="email">Email :</label>
                <input type="text" name="email" placeholder="example@email.com" required>
            <?php endif; ?>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" cols="30" rows="10" placeholder="Your Message" required></textarea>
            <button class="normal">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="img/people/1.JPG" alt="">
                <p><span>Watcharakon Chaveewongprateep</span> <br> Web Developer <br> Phone: 096-327-4026 <br>Email: watcharakonch13@gmail.com</p>
            </div>
        </div>
    </section>

    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>

    <?php mysqli_close($conn); ?>
</body>

</html>