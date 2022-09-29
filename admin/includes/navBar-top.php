<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand ps-3" href="index.html">DEV-BAY</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>


    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control search-index" type="text" placeholder="Search for..." />
            <button class="btn btn-outline-light search-invoker" style="border: 1px #fff solid;">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
    <!--------------------------------------------------------------------------->
    <div class="row justify-content-center position-absolute top-0 end-0 w-100 hide-search-content" style="margin-top: 4rem; display: none;">

        <div class="col-lg-6 col-md-6 position-relative">
            <div class="card">
                <div class="card-header text-center text-muted p-1 m-0">
                    <h5 class="card-title search-title">Search Result</h5>
                    <button class="btn btn-outline-danger hide-search-btn float-end position-absolute end-0 top-0">
                        <i class="fa fa-x"></i>
                    </button>
                </div>
                <ul class="list-style-none bg-white p-2 scroll search-result">
                    

                </ul>


                <!-- <div class="card-footer m-0 p-0 d-flex justify-content-end align-items-center">
                    <div class="show_more_result me-1 mt-1">
                        <p class="more_result text-dark">
                            Show More
                        </p>
                        <input type="hidden" class="numOfRows" value="0">
                        <input type="hidden" class="allRows" value="">
                        <input type="hidden" class="fileName" value="fetchData_reply.php">
                    </div>
                </div> -->

            </div>

        </div>
    </div>

    <!--------------------------------------------------------------------------->

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
                <img src="<?= $_SESSION['user']['image'] == '' ? "./../img/users/profile.png" : "./../img/users/" . $_SESSION['user']['image'] ?>" alt="admin profile picture" width="45px" height="45px" style="border-radius: 50%; border: 1px #fff solid;">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../index.php">
                        <i class='fas fa-home'></i>HOME</a>
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