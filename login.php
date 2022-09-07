<?php include('./log_files/header.php') ?>

<section class="sign-in">

    <?php include('./tellMessage.php') ?>


    <?php
        if (isset($_SESSION['user_auth'])) {
            $_SESSION['message'] = "You Are Already Logged In :)";
            echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
            exit(0);
        }
    ?>

    <div class="container">
        <div class="position-fixed top-2 end-2 mt-2 ml-2 m-auto">
            <a href="./index.php" class="btn btn-secondary">DEV-BAY</a>
        </div>
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="./log_files/images/Data_security_24.jpg" alt="sing up image"></figure>
                <a href="./register.php" class="signup-image-link">Create an account</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>
                <form method="POST" action="loginProcess.php" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="<?= isset($_COOKIE['log-in-email']) ? $_COOKIE['log-in-email'] : "" ?>" type="email" name="email" id="your_name" placeholder="Your Email" />
                    </div>
                    <div class="form-group">
                        <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                        <input value="<?= isset($_COOKIE['log-in-password']) ? $_COOKIE['log-in-password'] : "" ?>" type="password" name="password" id="your_pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <input <?= isset($_COOKIE['log-in-email']) && isset($_COOKIE['log-in-password']) ? "checked" : "" ?> type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>

                <div class="social-login">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('./log_files/footer.php'); ?>