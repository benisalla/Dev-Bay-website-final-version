<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class='fa fa-tachometer' style='color: white'></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="registered_users.php">
                    <div class="sb-nav-link-icon"><i class='fa fa-users' style='color: white;'></i></div>
                    Users
                </a>

                <div class="sb-sidenav-menu-heading">Interface</div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class='fas fa-layer-group' style='color: white'></i></div>
                    Category
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav d-flex flex-row">
                        <a class="nav-link" href="./add_category.php">
                            <button class="btn btn-light">
                                <i class='fa fa-plus' style='color: red'></i>
                            </button>
                        </a>
                        <a class="nav-link" href="./view_category.php">
                            <button class="btn btn-light">
                                <i class='fa fa-eye' style='color: blue'></i>
                            </button>
                        </a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class='fa fa-newspaper' style='color: white'></i></div>
                    Post
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav d-flex flex-row">
                        <a class="nav-link" href="./add_post.php">
                            <button class="btn btn-light">
                                <i class='fa fa-plus' style='color: red'></i>
                            </button>
                        </a>
                        <a class="nav-link" href="./view_post.php">
                            <button class="btn btn-light">
                                <i class='fa fa-eye' style='color: blue'></i>
                            </button>
                        </a>
                    </nav>
                </div>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseComments" aria-expanded="false" aria-controls="collapseComments">
                    <div class="sb-nav-link-icon"><i class='fas fa-comment' style='color: white'></i></div>
                    Comment
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseComments" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav d-flex flex-row">
                        <a class="nav-link" href="layout-static.html">
                            <button class="btn btn-light">
                                <i class='fa fa-plus' style='color: red'></i>
                            </button>
                        </a>
                        <a class="nav-link" href="layout-static.html">
                            <button class="btn btn-light">
                                <i class='fa fa-eye' style='color: blue'></i>
                            </button>
                        </a>
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            DEV-BAY Admin
        </div>
    </nav>
</div>