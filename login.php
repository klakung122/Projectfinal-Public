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
            <form action="login-form" method="post">

                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="re-message">
                        <?php echo $_SESSION['message']; ?>
                    </div>
                    <?php unset($_SESSION['message']); ?>
                <?php endif; ?>

                <h2>Sign In</h2><br>

                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Enter your username" required>

                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>

                <div class="login">
                    <button class="normal" type="submit">Sign In</button>
                    <a href="register">Go to Sign up page</a>
                </div>
            </form>
        </section>
    </section>

    <?php include 'include/footer.php'; ?>

    <script src="assets/js/script.js"></script>

    <?php mysqli_close($conn); ?>
</body>

</html>