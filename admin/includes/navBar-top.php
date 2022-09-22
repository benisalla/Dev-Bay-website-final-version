<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.html">DEV-BAY</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>


    <?php
    $Query = "select count(*) as newReq from email where state = '0'";
    $Result = mysqli_query($connection, $Query);
    if (mysqli_num_rows($Result) > 0) {
        $arr = mysqli_fetch_array($Result);
        $newReq = $arr['newReq'];
    }

    ?>


    <a class="nav-link mx-2" href="./unseen_requests.php">
        <i class="fas fa-envelope text-light"></i>
        <small class="position-absolute top-0 right-0 text-light h-auto rounded px-1" style="height: auto; 
        background-color: red;
        font-size:10px;
        "><?= $newReq ?></small>
    </a>


    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $_SESSION['user']['image'] == '' ? "./../img/users/profile.png" : "./../img/users/".$_SESSION['user']['image'] ?>" alt="admin profile picture" width="50px" height="50px" style="border-radius: 50%;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../index.php">
                        <i class='fas fa-home'></i>
                        HOME
                    </a>
                </li>
                <li><a class="dropdown-item" href="./../Set_Profile/profile.php"><i class='fas fa-cog'></i>
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