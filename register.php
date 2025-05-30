<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Living Condo</title>

    <link rel="stylesheet" href="assets/css/style-login.css">
    <script src="https://kit.fontawesome.com/0fc8938b8e.js" crossorigin="anonymous"></script>
</head>

<body>

    <?php include 'include/menu-login.php'; ?>

    <section id="body">
        <section id="form-details">
            <form action="register-form" method="post">

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="re-message">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <h2>Sign Up</h2><br>

                <label class="form-label">Full Name:</label>
                <input type="text" name="fullname" class="form-control" placeholder="Enter your fullname" required>

                <label class="form-label">Username:</label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>

                <label class="form-label">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>

                <label class="form-label">Confirm Password:</label>
                <input type="password" name="confirm_password" class="form-control" placeholder="Re-enter your password" required>

                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>

                <label class="form-label">Type</label>
                <select name="type_id" class="form-control">
                    <option value="1">ผู้เช่า</option>
                    <option value="2">ผู้ให้เช่า</option>
                </select>

                <div class="register">
                    <button class="normal" type="submit">Sign Up</button>
                    <a href="login">Go to Sign in page</a>
                </div>
            </form>
        </section>
    </section>

    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>

    <?php mysqli_close($conn); ?>
</body>

</html>