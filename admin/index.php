<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">DEV-BAY</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><i class='fa fa-home'></i> Dashboard</li>
    </ol>
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-primary" style="border: none ;border-bottom: 6px blue solid;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">
                                Visitors</div>
                            <div class="h5 mb-0 mt-2 font-weight-bold text-gray-800">
                                <?php
                                $num_visitors = 0;
                                $Query = "select count(*) as numOfRows from visitors_counter";
                                $Result = mysqli_query($connection, $Query);
                                if (mysqli_num_rows($Result) > 0) {
                                    $arr = mysqli_fetch_array($Result);
                                    $num_visitors = $arr['numOfRows'];
                                }
                                echo "$num_visitors";

                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-eye fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-success" style="border: none ;border-bottom: 6px green solid;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                clients
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" data-toggle="counter-up">
                                <?php
                                $num_clients = 0;
                                $Query = "select count(*) as numOfRows from users where role_as = '0'";
                                $Result = mysqli_query($connection, $Query);
                                if (mysqli_num_rows($Result) > 0) {
                                    $arr = mysqli_fetch_array($Result);
                                    $num_clients = $arr['numOfRows'];
                                }
                                echo "$num_clients";

                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-info" style="border: none ;border-bottom: 6px blue solid;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Posts
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <?php
                                        $num_projects = 0;
                                        $Query = "select count(*) as numOfRows from post";
                                        $Result = mysqli_query($connection, $Query);
                                        if (mysqli_num_rows($Result) > 0) {
                                            $arr = mysqli_fetch_array($Result);
                                            $num_projects = $arr['numOfRows'];
                                        }
                                        echo "$num_projects";

                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-rss-square fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card shadow h-100 py-2 border-warning" style="border: none ;border-bottom: 6px blue solid;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">
                                feedbacks</div>
                            <div class="h5 mb-0 mt-2 font-weight-bold text-gray-800">
                                <?php
                                $num_feedbacks = 0;
                                $Query = "select count(*) as numOfRows from testimonial";
                                $Result = mysqli_query($connection, $Query);
                                if (mysqli_num_rows($Result) > 0) {
                                    $arr = mysqli_fetch_array($Result);
                                    $num_feedbacks = $arr['numOfRows'];
                                }
                                echo "$num_feedbacks";

                                ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php

    class post
    {
        function __construct(
            public $id,
            public $likes,
            public $dislikes,
            public $comments,
            public $title,
            public $author,
        ) {
        }
    }

    $postInfo = [];
    $postRanker = [];
    $likeValues = [];
    $dislikeValues = [];
    $commentValues = [];

    $PostQuery = "select * from post where state = '1'";
    $PostResult = mysqli_query($connection, $PostQuery);
    if (mysqli_num_rows($PostResult) > 0) {
        foreach ($PostResult as $post) {
            $id = $post['id'];
            $totalOfLikes = 0;
            $ReactQuery = "select count(*) as numOfRows from post_react where post_id = '$id' and state = '1'";
            $ReactResult = mysqli_query($connection, $ReactQuery);
            if (mysqli_num_rows($ReactResult) > 0) {
                $arr = mysqli_fetch_array($ReactResult);
                $totalOfLikes = $arr['numOfRows'];
            }


            $totalOfDisLikes = 0;
            $ReactQuery = "select count(*) as numOfRows from post_react where post_id = '$id' and state = '-1'";
            $ReactResult = mysqli_query($connection, $ReactQuery);
            if (mysqli_num_rows($ReactResult) > 0) {
                $arr = mysqli_fetch_array($ReactResult);
                $totalOfDisLikes = $arr['numOfRows'];
            }


            $totalOfComment = 0;
            $ReactQuery = "select count(*) as numOfRows from comment where post_id = '$id'";
            $ReactResult = mysqli_query($connection, $ReactQuery);
            if (mysqli_num_rows($ReactResult) > 0) {
                $arr = mysqli_fetch_array($ReactResult);
                $totalOfComment = $arr['numOfRows'];
            }

            $user_id = $post['user_id'];
            $author = '';
            $ReactQuery = "select firstname from users where id = '$user_id'";
            $ReactResult = mysqli_query($connection, $ReactQuery);
            if (mysqli_num_rows($ReactResult) > 0) {
                $arr = mysqli_fetch_array($ReactResult);
                $author = $arr['firstname'];
            }

            array_push($likeValues, $totalOfLikes);
            array_push($dislikeValues, $totalOfDisLikes);
            array_push($commentValues, $totalOfComment);
            $postInfo += [$id => new post($id, $totalOfLikes, $totalOfDisLikes, $totalOfComment, $post['title'], $author)];
            $postRanker += [$id => ($totalOfLikes + $totalOfComment)];
        }
    }

    $max_likeValue = max($likeValues) == 0 ? 1 : max($likeValues);
    $max_dislikeValue = max($dislikeValues) == 0 ? 1 : max($dislikeValues);
    $max_commentValue = max($commentValues) == 0 ? 1 : max($commentValues);

    arsort($postRanker, 0);

    ?>

    <div class="row justify-content-center">
        <hr class="bg-dark m-2 mx-5 shadow" style="height: 2px;">
        <div class="col-lg-6 py-3 shadow my-2 rounded">
            <div class="font-weight-bold text-primary text-center">
                MOST NOTICED POSTS
            </div>
        </div>
        <hr style="visibility: hidden;">
        <?php

        $num = (count($postRanker) >= 4) ? 4 : count($postRanker);

        for ($i = 0; $i < $num; $i++) :
            $post = $postInfo[array_keys($postRanker)[$i]];
        ?>
            <div class="col-lg-6 mb-4">

                <div class="container shadow py-1 my-1 rounded">
                    <h4 class="small font-weight-bold text-center"><?= $post->title ?></h4>

                    <small>Reactions</small>
                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: <?= ($post->comments / $max_commentValue) * 100 ?>%"></div>
                    </div>

                    <small>Ups</small>
                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: <?= ($post->likes / $max_likeValue) * 100 ?>%"></div>
                    </div>

                    <small>Downs</small>
                    <div class="progress mb-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: <?= ($post->dislikes / $max_dislikeValue) * 100 ?>%"></div>
                    </div>

                    <div class="d-flex flex-row justify-content-between">
                        <ol class="d-flex flex-nowrap flex-row justify-content-end list-unstyled">
                            <li class="me-3 text-muted"><i class='fa fa-user me-1 text-primary'></i><?= $post->author ?></li>
                            <li class="me-3"><a class="text-muted post_more_btn" href="#">MORE<i class="fa fa-arrow-right post_more_arrow"></i></a></li>
                        </ol>
                        <ol class="d-flex flex-nowrap flex-row justify-content-end list-unstyled">
                            <li class="ms-3 text-primary"><i class='fa fa-comment me-1 text-primary'></i><?= $post->comments ?></li>
                            <li class="ms-3 text-success"><i class='fa fa-thumbs-up me-1 text-success'></i><?= $post->likes ?></li>
                            <li class="ms-3 text-danger"><i class='fa fa-thumbs-down me-1 text-danger'></i><?= $post->dislikes ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>


    <div class="row justify-content-center">
        <hr class="bg-dark m-2 mx-5 shadow" style="height: 2px;">
        <div class="col-lg-6 py-3 shadow my-2 rounded">
            <div class="font-weight-bold text-primary text-center">
                DIV-BAY USERS' STATISTICS
            </div>
        </div>
        <hr style="visibility: hidden;">
        <?php
        $admins = 0;
        $Query = "select count(*) as numOfRows from users where role_as = '1'";
        $Result = mysqli_query($connection, $Query);
        if (mysqli_num_rows($Result) > 0) {
            $arr = mysqli_fetch_array($Result);
            $admins = $arr['numOfRows'];
        }

        $clints = 0;
        $Query = "select count(*) as numOfRows from users where role_as = '0'";
        $Result = mysqli_query($connection, $Query);
        if (mysqli_num_rows($Result) > 0) {
            $arr = mysqli_fetch_array($Result);
            $clints = $arr['numOfRows'];
        }

        $followers = 0;
        $Query = "select count(*) as numOfRows from users where role_as = '-1'";
        $Result = mysqli_query($connection, $Query);
        if (mysqli_num_rows($Result) > 0) {
            $arr = mysqli_fetch_array($Result);
            $followers = $arr['numOfRows'];
        }

        $TotalUsers = ($followers + $admins + $clints);
        $admins = ($admins/$TotalUsers)*100;
        $clints = ($clints/$TotalUsers)*100;
        $followers = ($followers/$TotalUsers)*100;

        ?>
        <div class="col-lg-9 mb-4">
            <div class="container shadow py-1 my-1 rounded d-flex justify-content-around">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="progress mb-4 flex-column-reverse" style="width: 50px; height: 330px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" style="width: 100%; height: <?= $admins ?>%;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $clints ?>%; background-color: #e9ecef;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $followers ?>%; background-color: #e9ecef;"></div>
                    </div>
                    <h4 class="small font-weight-bold text-uppercase">Admins</span></h4>
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="progress flex-column-reverse mb-4" style="width: 50px; height: 330px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $admins ?>%; background-color: #e9ecef;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 100%; height: <?= $clints ?>%;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $followers ?>%; background-color: #e9ecef;"></div>
                    </div>
                    <h4 class="small font-weight-bold text-uppercase">Clients</h4>
                </div>

                <div class="d-flex flex-column justify-content-center align-items-center">
                    <div class="progress mb-4 flex-column-reverse" style="width: 50px; height: 330px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $admins ?>%; background-color: #e9ecef;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" style="width: 100%; height: <?= $clints ?>%; background-color: #e9ecef;"></div>
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: 100%; height: <?= $followers ?>%;"></div>
                    </div>
                    <h4 class="small font-weight-bold text-uppercase">Followers</span></h4>
                </div>
            </div>
        </div>
    </div>




</div>


<?php
include('./includes/scripts.php');
?>