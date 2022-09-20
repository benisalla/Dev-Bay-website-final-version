<?php include('./log_files/header.php') ?>
<?php include('./tellMessage.php'); ?>

<?php
if (isset($_SESSION['user_auth'])) {
    $_SESSION['message'] = [
        'content' => "You Have Already An Account :)",
        'type' => 'alert',
    ];
    echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
    exit(0);
}
?>

<section class="signup">
    <div class="container">
        <div class="position-fixed top-2 end-2 mt-2 ml-2 m-auto">
            <a href="./index.php" class="btn btn-secondary"><i class="zmdi zmdi-home"></i>HOME</a></a>
        </div>
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" action="./registerProcess.php" enctype="multipart/form-data" class="register-form" id="register-form">
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="firstName" id="firstName" placeholder="Your First Name" />
                    </div>
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="lastName" id="lastName" placeholder="Your Last Name" />
                    </div>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupFile01">Upload</label>
                        <input type="file" name="image" class="form-control" id="inputGroupFile01">
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" />
                    </div>
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="pass" id="pass" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="conformPass" id="conformPass" placeholder="Conform your password" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in <a href="#" class="term-service">Terms of service</a></label>
                    </div>


                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="./log_files/images/signUp.png" alt="sing up image"></figure>
                <a href="./login.php" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>

<?php include('./log_files/footer.php') ?>