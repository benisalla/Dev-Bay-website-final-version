<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">DEV-BAY</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- messages -->
    <?php
    $Query = "select count(*) as newReq from email where state = '0'";
    $Result = mysqli_query($connection, $Query);
    if (mysqli_num_rows($Result) > 0) {
        $arr = mysqli_fetch_array($Result);
        $newReq = $arr['newReq'];
    }

    ?>


    <a class="nav-link" href="#">
        <i class="fas fa-bell text-light"></i>
        <small class="position-absolute top-0 right-0 text-light h-auto rounded px-1" style="height: auto; 
        background-color: red;
         font-size:10px;
         "><?= $newReq ?></small>
    </a>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../index.php">
                        <i class='fas fa-home'></i>
                        HOME
                    </a>
                </li>
                <li><a class="dropdown-item" href="./profile.php"><i class='fas fa-cog'></i>
                        Edit Profile</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li>
                    <form method="POST" action="../code.php">
                        <button type='submit' name='logout_btn' class="dropdown-item">
                            <i class='fas fa-sign-out-alt'></i>
                            Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>