<?php include('./admin/config/databaseConfig.php'); ?>

<nav class="navbar navbar-expand-md navbar-dark px-5 py-lg-0 ">
    <div class="container d-flex justify-content-between flex-lg-nowrap">
        <a href="index.html" class="navbar-brand ">
            <img src="./img/logos/logo.svg" class="logo" alt="logo-Dev-Bay">
        </a>
        <div class="navbar-toggler collapsed " type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <div class="humberger">
                <div class="hum-content-1"></div>
                <div class="hum-content-2"></div>
                <div class="hum-content-3"></div>
            </div>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="#" class="nav-item nav-link active PressedLink">Home</a>
            <hr class="MenuUnderLine">
            <a href="#about" class="nav-item nav-link PressedLink">About</a>
            <hr class="MenuUnderLine">
            <a href="#service" class="nav-item nav-link PressedLink">Services</a>
            <hr class="MenuUnderLine">
            <a href="#blog" class="nav-item nav-link PressedLink">Blog</a>
            <hr class="MenuUnderLine">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">More</a>
                <div class="dropdown-menu m-0">
                    <a href="#contact" class="dropdown-item PressedLink">Contact Us</a>
                    <a href="#plan" class="dropdown-item PressedLink">Pricing Plan</a>
                    <a href="#team" class="dropdown-item PressedLink">Team Members</a>
                    <a href="#testimonial" class="dropdown-item PressedLink">testimonial</a>
                </div>
            </div>
            <hr class="MenuUnderLine">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Settings</a>
                <div class="dropdown-menu m-0">
                    <div class="dark_mode_btn">
                        <div class="btn-dark-light">
                            <div class="light-mode"><i class="fa fa-sun"></i></div>
                            <div class="dark-mode"><i class="fa fa-moon"></i></div>
                        </div>
                    </div>
                    <a href="#" class="dropdown-item PressedLink"><i class="fa fa-globe text-primary setting_icons"></i> Frensh</a>

                    
                    <?php if($_SESSION['user_auth']): ?>
                        <?php if($_SESSION['user_Role'] == '1'): ?>
                            <a href="./admin/index.php" class="dropdown-item PressedLink"><i class="fa fa-tachometer-alt text-primary setting_icons"></i> DashBoard</a>
                            <form method="POST" action="./code.php" >
                                <button href="#" type="submit" name="logout_btn" class="dropdown-item PressedLink"><i class="fa fa-sign-out-alt text-primary setting_icons"></i> Log-Out</button>
                            </form>
                        <?php elseif($_SESSION['user_Role'] == '0'): ?>
                            <form method="POST" action="./code.php" >
                                <button href="#" type="submit" name="logout_btn" class="dropdown-item PressedLink"><i class="fa fa-sign-out-alt text-primary setting_icons"></i> Log-Out</button>
                            </form>                        
                        <?php else: ?>
                            <a href="#" class="dropdown-item PressedLink"><i class="fa fa-sign-in-alt text-primary setting_icons"></i> Sign-In</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="./login.php" class="dropdown-item PressedLink"><i class="fa fa-sign-in-alt text-primary setting_icons"></i> Sign-In</a>
                        <a href="./register.php" class="dropdown-item PressedLink"><i class="fa fa-user-plus text-primary setting_icons"></i> Register</a>
                    <?php endif; ?>

                    
                </div>
            </div>
        </div>
    </div>
</nav>