<?php
session_start();
include('../admin/config/databaseConfig.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Dev-Bay company</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./post.css">
</head>

<body>

    <div class="container pb50 bg-light rounded pt-2 shadow">
        <div class="bg-dark p-2 rounded d-flex justify-content-between flex-nowrap mb-5 p-1 align-items-center">
            <div class="btn btn-outline-primary">
                <a href="../index.php" class="text-white"><i class="fa fa-home text-white me-2"></i>HOME</a>
            </div>
            <div class="search_tool">
                <input type="text" placeholder="Search...">
                <button class="searsh_btn"><i class="fa fa-search"></i></button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-9 mb40">
                <article>
                    <?php
                    if (isset($_GET['id'])) :
                        $post_id = $_GET['id'];
                        $postQuery = "select * from post where id = '$post_id' and state = '1'";
                        $postResult = mysqli_query($connection, $postQuery);
                        if (mysqli_num_rows($postResult) > 0) :
                            foreach ($postResult as $post) :
                                $author_id = $post['user_id'];
                                $category_id = $post['category_id'];
                    ?>
                                <div class="m-1 d-flex justify-content-center">
                                    <img src="../img/blog/<?= $post['image'] == '' ? 'event.png' : $post['image'] ?>" alt="" class="img-fluid mb30">
                                </div>
                                <div class="post-content">
                                    <h3 class="text-center"><?= $post['title'] ?></h3>
                                    <ul class="post-meta my-4 p-0 d-flex justify-content-around text-center">
                                        <li class="list-inline-item w-100 m-0">
                                            <i class="fa fa-user-circle-o text-primary"></i> <a href="#">
                                                <?php
                                                $authorQuery = "select * from users where id = '$author_id'";
                                                $authorResult = mysqli_query($connection, $authorQuery);
                                                if (mysqli_num_rows($authorResult) > 0) {
                                                    foreach ($authorResult as $author) {
                                                        echo $author['firstname'] . " " . $author['lastname'];
                                                    }
                                                } else {
                                                    echo "UnKnown";
                                                } ?>
                                            </a>
                                        </li>
                                        <li class="list-inline-item w-100 spacial_li m-0">
                                            <i class="fa fa-calendar-o text-primary"></i> <a href="#">
                                                <?php
                                                $date = DateTime::createFromFormat('Y-m-d h:i:s', $post['created_at']);
                                                echo $date->format('d') . " " . $date->format('M') . " " . $date->format('Y');
                                                ?>
                                            </a>
                                        </li>
                                        <li class="list-inline-item w-100 m-0">
                                            <i class="fa fa-tag text-primary"></i> <a href="#">
                                                <?php
                                                $categoryQuery = "select * from category where id = '$category_id'";
                                                $categoryResult = mysqli_query($connection, $categoryQuery);
                                                if (mysqli_num_rows($categoryResult) > 0) {
                                                    foreach ($categoryResult as $category) {
                                                        echo $category['name'];
                                                    }
                                                } else {
                                                    echo "UnKnown";
                                                }
                                                ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="post-body border border-primary p-1 px-2 my-1 mb-4 rounded">

                                        <p class="m-3 my-4"><?= $post['body'] ?></p>

                                        <div class="position-relative">
                                            <div class="bg-light p-2 ">
                                                <div class="d-flex flex-row fs-12 justify-content-end">
                                                    <?php
                                                    $FQuery = "select state from post_react where author_id = '$author_id' and post_id = '$post_id'";
                                                    $FResult = mysqli_query($connection, $FQuery);
                                                    if (mysqli_num_rows($FResult) > 0) :
                                                        $state = mysqli_fetch_array($FResult)['state'];
                                                    ?>
                                                        <div class="post_like_it <?= $state == 1 ? 'active' : '' ?> p-2 me-2 btn btn-square">
                                                            <i class="fa fa-thumbs-o-up fs-4 w-bolder"></i>
                                                            <input type="hidden" class="author_id" value="<?= $author_id ?>">
                                                            <input type="hidden" class="post_id" value="<?= $post_id ?>">
                                                        </div>
                                                        <div class="post_dislike_it <?= $state == -1 ? 'active' : '' ?> p-2 me-2 btn btn-square">
                                                            <i class="fa fa-thumbs-o-down fs-4 "></i>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="post_like_it p-2 me-2 btn btn-square">
                                                            <i class="fa fa-thumbs-o-up fs-4 w-bolder"></i>
                                                            <input type="hidden" class="author_id" value="<?= $author_id ?>">
                                                            <input type="hidden" class="post_id" value="<?= $post_id ?>">
                                                        </div>
                                                        <div class="post_dislike_it p-2 me-2 btn btn-square">
                                                            <i class="fa fa-thumbs-o-down fs-4 "></i>
                                                        </div>
                                                    <?php endif; ?>
                                                    <a class="share_it p-2 btn btn-square">
                                                        <i class="fa fa-share fs-4 "></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="share_post ">
                                                <a href="#" class="item"><i class="fa fa-facebook bg-info border border-primary p-2 w-fit-content text-light"></i></a>
                                                <a href="#" class="item"><i class="fa fa-twitter bg-info border border-primary p-2 text-light"></i></a>
                                                <a href="#" class="item"><i class="fa fa-linkedin bg-info border border-primary p-2 text-light"></i></a>
                                                <a href="#" class="item"><i class="fa fa-instagram bg-info border border-primary p-2 text-light"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="mb40">

                                    <h4 class="mb30 text-uppercase font500">About The Author</h4>
                                    <?php
                                    $authorQuery = "select * from users where id = '$author_id'";
                                    $authorResult = mysqli_query($connection, $authorQuery);
                                    if (mysqli_num_rows($authorResult) > 0) :
                                        foreach ($authorResult as $author) : ?>
                                            <div class="media mb40 shadow rounded p-2">
                                                <div class="d-flex justify-content-start align-items-center mb-4">
                                                    <img src="../img/users/<?= $author['image'] == '' ? 'profile.png' : $author['image'] ?>" width="80px" height="80px" style="border-radius: 50%;" alt="author picture">
                                                    <div class="ms-4">
                                                        <h2 class="text-primary font700"><?= $author['lastname'] . " " . $author['firstname'] ?></h2>
                                                        <small><?= $author['profession'] ?></small>
                                                    </div>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mx-1"><?= $author['description'] ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="media mb40 shadow rounded p-2">
                                            <div class="d-flex justify-content-start align-items-center mb-4">
                                                <img src="../img/users/profile.png" width="80px" height="80px" style="border-radius: 50%;" alt="author picture">
                                                <div class="ms-4">
                                                    <h2 class="text-primary font700">UnKnown Author</h2>
                                                    <small>his/her profession</small>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <p class="mx-1">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                                            </div>
                                        </div>
                                    <?php endif; ?>



                                    <hr class="mb40">


                                    <h4 class="mb40 text-uppercase font500">Comments</h4>


                                    <h4 class="mb40 text-uppercase font500">Add A Comment</h4>
                                    <form role="form">
                                        <div class="form-group">
                                            <textarea class="form-control comment-message" placeholder="Type your comment here"></textarea>
                                        </div>
                                        <div class="clearfix float-right">
                                            <button type="button" class="btn btn-dark text-light btn-lg float-end mt-3 add-comment-btn">Post</button>
                                        </div>
                                        <input type="hidden" class="comment_author_id" value="<?= $_SESSION['user']['id'] ?>">
                                        <input type="hidden" class="comment_post_id" value="<?= $post['id'] ?>">
                                    </form>

                                    <div class="comment-container">

                                        <?php

                                        $post_id = $post['id'];

                                        $allRows_comment = 0;

                                        $Query = "select count(*) as numOfRows from comment where post_id = '$post_id'";
                                        $Result = mysqli_query($connection, $Query);
                                        if (mysqli_num_rows($Result) > 0) {
                                            $arr = mysqli_fetch_array($Result);
                                            $allRows_comment = $arr['numOfRows'];
                                        }

                                        $num_rows = 3;


                                        $commentQuery = "select * from comment where post_id = '$post_id' order by created_at limit $num_rows";
                                        $commentResult = mysqli_query($connection, $commentQuery);
                                        if (mysqli_num_rows($commentResult) > 0) :
                                            foreach ($commentResult as $comment) :
                                                $author_id = $comment['author_id'];
                                        ?>
                                                <div class="comment_data_class">
                                                    <div class="card border border-dark mb-4 mt-5">
                                                        <div class="card-body">
                                                            <p><?= $comment['body'] ?></p>
                                                            <div class="d-flex justify-content-between">
                                                                <?php
                                                                $authorQuery = "select * from users where id = '$author_id'";
                                                                $authorResult = mysqli_query($connection, $authorQuery);
                                                                if (mysqli_num_rows($authorResult) > 0) :
                                                                    foreach ($authorResult as $author) : ?>
                                                                        <div class="d-flex flex-row align-items-center">
                                                                            <img src="../img/users/<?= $author['image'] == '' ? 'profile.png' : $author['image'] ?>" alt="user" width="25" height="25" />
                                                                            <p class="small mb-0 ms-2 text-primary">
                                                                                <?= $author['firstname'] . " " . $author['lastname'] ?>
                                                                            </p>
                                                                            <span class="small ms-1 text-primary">
                                                                                <?php
                                                                                $lastTime = new DateTime($comment['created_at']);
                                                                                $currentTime = new DateTime();
                                                                                $diff = $lastTime->diff($currentTime, true);
                                                                                $year = $diff->format('%Y');
                                                                                $month = $diff->format('%m');
                                                                                $day = $diff->format('%d');
                                                                                $hour = $diff->format('%H');
                                                                                $minute = $diff->format('%i');
                                                                                $second = $diff->format('%s');
                                                                                if ($year != 0) {
                                                                                    echo  " - " . $year . " years ";
                                                                                } elseif ($month != 0) {
                                                                                    echo  " - " . $month . " months ";
                                                                                } elseif ($day != 0) {
                                                                                    echo  " - " . $day . " days ";
                                                                                } elseif ($hour != 0) {
                                                                                    echo  " - " . $hour . " hours ";
                                                                                } elseif ($minute != 0) {
                                                                                    echo  " - " . $minute . " minutes ";
                                                                                } else {
                                                                                    echo  " - " . $second . " seconds ";
                                                                                }
                                                                                ?>
                                                                                ago
                                                                            </span>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <div class="d-flex flex-row align-items-center">
                                                                        <img src="../img/users/profile.png" alt="user" width="25" height="25" />
                                                                        <p class="small mb-0 ms-2 text-primary">
                                                                            UnKnonw
                                                                        </p>
                                                                        <span class="small text-primary">
                                                                            <?php
                                                                            $lastTime = new DateTime($comment['created_at']);
                                                                            $currentTime = new DateTime();
                                                                            $diff = $lastTime->diff($currentTime, true);
                                                                            $year = $diff->format('%Y');
                                                                            $month = $diff->format('%m');
                                                                            $day = $diff->format('%d');
                                                                            $hour = $diff->format('%H');
                                                                            $minute = $diff->format('%i');
                                                                            $second = $diff->format('%s');
                                                                            if ($year != 0) {
                                                                                echo  " - " . $year . " years ";
                                                                            } elseif ($month != 0) {
                                                                                echo  " - " . $month . " months ";
                                                                            } elseif ($day != 0) {
                                                                                echo  " - " . $day . " days ";
                                                                            } elseif ($hour != 0) {
                                                                                echo  " - " . $hour . " hours ";
                                                                            } elseif ($minute != 0) {
                                                                                echo  " - " . $minute . " minutes ";
                                                                            } else {
                                                                                echo  " - " . $second . " seconds ";
                                                                            }
                                                                            ?>
                                                                            ago
                                                                        </span>
                                                                    </div>
                                                                <?php endif; ?>


                                                                <div class="d-flex flex-row border border-primary rounded">
                                                                    <div class="px-1 comment-evaluation reply-to-comment" id="code_<?= $comment['id'] ?>" value="<?= $comment['id'] ?>">
                                                                        <i class="fa fa-share mx-2 fa-xs text-dark"></i>
                                                                    </div>
                                                                    <?php
                                                                    $Au_id = $_SESSION['user']['id'];
                                                                    $Co_id = $comment['id'];

                                                                    $countLikes = 0;
                                                                    $countDisLikes = 0;

                                                                    $CountQuery = "select state from comment_react where comment_id = '$Co_id'";
                                                                    $CountResult = mysqli_query($connection, $CountQuery);
                                                                    if (mysqli_num_rows($CountResult) > 0) {
                                                                        foreach ($CountResult as $arrResult) {
                                                                            if ($arrResult['state'] == 1) {
                                                                                $countLikes += 1;
                                                                            } elseif ($arrResult['state'] == -1) {
                                                                                $countDisLikes += 1;
                                                                            }
                                                                        }
                                                                    }


                                                                    $CQuery = "select state from comment_react where author_id = '$Au_id' and comment_id = '$Co_id'";
                                                                    $CResult = mysqli_query($connection, $CQuery);
                                                                    if (mysqli_num_rows($CResult) > 0) :
                                                                        $state = mysqli_fetch_array($CResult)['state'];
                                                                    ?>
                                                                        <div class="d-flex flex-row align-items-center spacial_li px-1 comment-evaluation comment_dislike_it <?= $state == -1 ? 'active' : '' ?>  CRC_<?= $Co_id ?>" iden="CRC_<?= $Co_id ?>" author="<?= $Au_id ?>" comment="<?= $Co_id ?>">
                                                                            <i class="fa fa-thumbs-o-down mx-2 fa-xs"></i>
                                                                            <p class="small text-muted mb-0 comment_dislike_num"><?= $countDisLikes ?></p>
                                                                        </div>
                                                                        <div class="d-flex flex-row align-items-center px-1 comment-evaluation comment_like_it <?= $state == 1 ? 'active' : '' ?>  CRC_<?= $Co_id ?>" iden="CRC_<?= $Co_id ?>" author="<?= $Au_id ?>" comment="<?= $Co_id ?>">
                                                                            <i class="fa fa-thumbs-o-up mx-2 fa-xs "></i>
                                                                            <p class="small text-muted mb-0 comment_like_num"><?= $countLikes ?></p>
                                                                        </div>
                                                                    <?php else : ?>
                                                                        <div class="d-flex flex-row align-items-center spacial_li px-1 comment-evaluation comment_dislike_it  CRC_<?= $Co_id ?>" iden="CRC_<?= $Co_id ?>" author="<?= $Au_id ?>" comment="<?= $Co_id ?>">
                                                                            <i class="fa fa-thumbs-o-down mx-2 fa-xs"></i>
                                                                            <p class="small text-muted mb-0 comment_dislike_num"><?= $countDisLikes ?></p>
                                                                        </div>
                                                                        <div class="d-flex flex-row align-items-center px-1 comment-evaluation comment_like_it CRC_<?= $Co_id ?>" iden="CRC_<?= $Co_id ?>" author="<?= $Au_id ?>" comment="<?= $Co_id ?>">
                                                                            <i class="fa fa-thumbs-o-up mx-2 fa-xs "></i>
                                                                            <p class="small text-muted mb-0 comment_like_num"><?= $countLikes ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="reply_code_<?= $comment['id'] ?>">
                                                        <?php
                                                        $comment_id = $comment['id'];

                                                        $allRows = 0;

                                                        $Query = "select count(*) as numOfRows from reply where comment_id = '$comment_id'";
                                                        $Result = mysqli_query($connection, $Query);
                                                        if (mysqli_num_rows($Result) > 0) {
                                                            $arr = mysqli_fetch_array($Result);
                                                            $allRows = $arr['numOfRows'];
                                                        }

                                                        $num_rows = 3;

                                                        $replyQuery = "select * from reply where comment_id = '$comment_id' order by created_at limit $num_rows";
                                                        $replyResult = mysqli_query($connection, $replyQuery);
                                                        if (mysqli_num_rows($replyResult) > 0) :
                                                            foreach ($replyResult as $reply) :
                                                                $author_id = $reply['author_id'];

                                                                $authorQuery = "select * from users where id = '$author_id'";
                                                                $authorResult = mysqli_query($connection, $authorQuery);
                                                                if (mysqli_num_rows($authorResult) > 0) :
                                                                    foreach ($authorResult as $author) : ?>
                                                                        <div class="d-flex flex-start mt-4 ms-5 p-2 shadow rounded reply_data_class_<?= $comment['id'] ?>">

                                                                            <a class="me-3" href="#">
                                                                                <img src="../img/users/<?= $author['image'] == '' ? 'profile.png' : $author['image'] ?>" alt="commet" width="60px" height="60px" />
                                                                            </a>
                                                                            <div class="flex-grow-1 flex-shrink-1">
                                                                                <div>
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <p class="mb-1 text-primary">
                                                                                            <?= $author['firstname'] . " " . $author['lastname'] ?>
                                                                                            <span class="small">
                                                                                                <?php
                                                                                                $lastTime = new DateTime($reply['created_at']);
                                                                                                $currentTime = new DateTime();
                                                                                                $diff = $lastTime->diff($currentTime, true);
                                                                                                $year = $diff->format('%Y');
                                                                                                $month = $diff->format('%m');
                                                                                                $day = $diff->format('%d');
                                                                                                $hour = $diff->format('%H');
                                                                                                $minute = $diff->format('%i');
                                                                                                $second = $diff->format('%s');
                                                                                                if ($year != 0) {
                                                                                                    echo  " - " . $year . " years ";
                                                                                                } elseif ($month != 0) {
                                                                                                    echo  " - " . $month . " months ";
                                                                                                } elseif ($day != 0) {
                                                                                                    echo  " - " . $day . " days ";
                                                                                                } elseif ($hour != 0) {
                                                                                                    echo  " - " . $hour . " hours ";
                                                                                                } elseif ($minute != 0) {
                                                                                                    echo  " - " . $minute . " minutes ";
                                                                                                } else {
                                                                                                    echo  " - " . $second . " seconds ";
                                                                                                }
                                                                                                ?>
                                                                                                ago
                                                                                            </span>
                                                                                        </p>
                                                                                    </div>
                                                                                    <p class="small mb-0"><?= $reply['body'] ?></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                <?php else : ?>
                                                                    <div class="d-flex flex-start mt-4 ms-5 p-2 shadow rounded reply_data_class_<?= $comment['id'] ?>">
                                                                        <a class="me-3" href="#">
                                                                            <img src="../img/users/profile.png" alt="commet" width="60px" height="60px" />
                                                                        </a>
                                                                        <div class="flex-grow-1 flex-shrink-1">
                                                                            <div>
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <p class="mb-1 text-primary">
                                                                                        UnKnown
                                                                                        <span class="small">
                                                                                            <?php
                                                                                            $lastTime = new DateTime($reply['created_at']);
                                                                                            $currentTime = new DateTime();
                                                                                            $diff = $lastTime->diff($currentTime, true);
                                                                                            $year = $diff->format('%Y');
                                                                                            $month = $diff->format('%m');
                                                                                            $day = $diff->format('%d');
                                                                                            $hour = $diff->format('%H');
                                                                                            $minute = $diff->format('%i');
                                                                                            $second = $diff->format('%s');
                                                                                            if ($year != 0) {
                                                                                                echo  " - " . $year . " years ";
                                                                                            } elseif ($month != 0) {
                                                                                                echo  " - " . $month . " months ";
                                                                                            } elseif ($day != 0) {
                                                                                                echo  " - " . $day . " days ";
                                                                                            } elseif ($hour != 0) {
                                                                                                echo  " - " . $hour . " hours ";
                                                                                            } elseif ($minute != 0) {
                                                                                                echo  " - " . $minute . " minutes ";
                                                                                            } else {
                                                                                                echo  " - " . $second . " seconds ";
                                                                                            }
                                                                                            ?>
                                                                                            ago
                                                                                        </span>
                                                                                    </p>
                                                                                </div>
                                                                                <p class="small mb-0"><?= $reply['body'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                            <?php endforeach; ?>


                                                            <div class="d-flex flex-row justify-content-end align-items-center my-2">
                                                                <div class="show_more_<?= $comment['id'] ?>">
                                                                    <p class="<?= $num_rows < $allRows ? 'display_more' : '' ?> text-dark" id="<?= $comment['id'] ?>">
                                                                        <?= $num_rows < $allRows ? 'Show More Replies' : 'No More Replies' ?>
                                                                    </p>
                                                                    <input type="hidden" class="numOfRows" value="0">
                                                                    <input type="hidden" class="allRows" value="<?= $allRows ?>">
                                                                    <input type="hidden" class="fileName" value="fetchData_reply.php">
                                                                </div>
                                                            </div>


                                                        <?php else : ?>
                                                            <div class="d-flex flex-row justify-content-end">
                                                                <p class="text-dark">No Replies</p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>


                                                    <form class="reply-form m-2 mt-4 ms-5" id="code_<?= $comment['id'] ?>">
                                                        <input class="author_id" type="hidden" value="<?= $_SESSION['user']['id'] ?>">
                                                        <input class="comment_id" type="hidden" value="<?= $comment['id'] ?>">
                                                        <div class="form-group">
                                                            <textarea class="reply-message form-control" rows="5" placeholder="type your reply here ..."></textarea>
                                                        </div>
                                                        <div class="clearfix float-right">
                                                            <button type="button" class="reply-btn btn btn-dark text-light btn-sm float-end mt-2">reply</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            <?php endforeach; ?>

                                            <hr>

                                            <div class="d-flex flex-row justify-content-between align-items-center my-2">
                                                <div class="more_comment_message">
                                                    <?= $allRows_comment <= 3 ? 'No More Comments' : 'Show More Comments' ?>
                                                </div>
                                                <div class="show_more_comment">
                                                    <p class="<?= $allRows_comment <= 3 ? '' : 'display_more_comment' ?> btn btn-dark text-light" id="<?= $post['id'] ?>">
                                                        <i class="fa fa-chevron-down"></i>
                                                    </p>
                                                    <input type="hidden" class="numOfRows" value="0">
                                                    <input type="hidden" class="allRows" value="<?= $allRows_comment ?>">
                                                    <input type="hidden" class="fileName" value="fetchData_comment.php">
                                                </div>
                                            </div>

                                        <?php else : ?>
                                            <div class="text-dark d-flex float-end">
                                                No Comments
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                <?php endforeach; ?>
                            <?php else : ?>
                                <?php
                                $_SESSION['message'] = [
                                    'content' => "Something went wrong, Please Try again :)",
                                    'type' => 'alert',
                                ];
                                echo "<script type='text/javascript'>  window.location='../index.php'; </script>";
                                exit(0);
                                ?>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php
                            $_SESSION['message'] = [
                                'content' => "sorry there is no result :)",
                                'type' => 'alert',
                            ];
                            echo "<script type='text/javascript'>  window.location='../index.php'; </script>";
                            exit(0);
                            ?>
                        <?php endif; ?>
                </article>
            </div>



            <div class="col-md-3 mb40">
                <div>
                    <h4 class="sidebar-title text-center">Other Interesting Posts</h4>
                    <hr>
                    <ul class="list-unstyled">
                        <?php
                        $id = $_GET['id'];
                        $sidePostQuery = "SELECT * FROM post where id != '$id' and state = '1' ORDER BY RAND() LIMIT 3;";
                        $sidePostResult = mysqli_query($connection, $sidePostQuery);

                        if (mysqli_num_rows($sidePostResult) > 0) :
                            foreach ($sidePostResult as $sidePost) : ?>
                                <li class="media mt-4 d-flex justify-content-start align-items-center flex-wrap">
                                    <a href="/posts/post.php?id=<?= $sidePost['id'] ?>"><img width="60px" height="60px" src="../img/blog/<?= $sidePost['image'] == '' ? 'event.png' : $sidePost['image'] ?>" alt="Generic placeholder image"></a>
                                    <div class="media-body ms-2 d-flex flex-column">
                                        <h5 class="mb-0 text-dark">
                                            <?php
                                            $categoryQuery = "select * from category where id = '$category_id'";
                                            $categoryResult = mysqli_query($connection, $categoryQuery);
                                            if (mysqli_num_rows($categoryResult) > 0) {
                                                foreach ($categoryResult as $category) {
                                                    echo $category['name'];
                                                }
                                            } else {
                                                echo "UnKnown";
                                            }
                                            ?>
                                        </h5>
                                        <small>
                                            <?php
                                            $date = new DateTime($sidePost['created_at']);
                                            echo $date->format('M') . " " . $date->format('d') . ", " . $date->format('Y');
                                            ?>
                                        </small>
                                    </div>
                                    <p class="my-1"><a href="/posts/post.php?id=<?= $sidePost['id'] ?>"><?= $sidePost['excerpt'] ?></a></p>
                                </li>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <li class="media mt-4 d-flex justify-content-start align-items-center flex-wrap">
                                There is no suggestions
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div>
                    <h4 class="mt-5 sidebar-title text-center bold">Checkout Our Services</h4>
                    <hr>
                    <ul class="list-unstyled">
                        <li class="media d-flex justify-content-start flex-wrap mt-2">
                            <div class="service-icon media-body me-3">
                                <i class="fa fa-shield text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Cyber Security</h5>
                                <a href="" class="More_btn bg-info rounded text-white text-nowrap">Discover Now<i class="fa fa-chevron-right ms-2 text-white"></i></a>
                            </div>
                        </li>
                        <li class="media d-flex justify-content-start flex-wrap mt-4">
                            <div class="service-icon media-body me-3">
                                <i class="fa fa-cog text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Maintenance</h5>
                                <a href="" class="More_btn bg-info rounded text-white text-nowrap">Discover Now<i class="fa fa-chevron-right ms-2 text-white"></i></a>
                            </div>
                        </li>
                        <li class="media d-flex justify-content-start flex-wrap mt-4">
                            <div class="service-icon media-body me-3">
                                <i class="fa fa-code text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Web Development</h5>
                                <a href="" class="More_btn bg-info rounded text-white text-nowrap">Discover Now<i class="fa fa-chevron-right ms-2 text-white"></i></a>
                            </div>
                        </li>
                        <li class="media d-flex justify-content-start flex-wrap mt-4">
                            <div class="service-icon media-body me-3">
                                <i class="fa fa-android text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">Web & Mobile Apps</h5>
                                <a href="" class="More_btn bg-info rounded text-white text-nowrap">Discover Now<i class="fa fa-chevron-right ms-2 text-white"></i></a>
                            </div>
                        </li>
                        <li class="media d-flex justify-content-start flex-wrap mt-4">
                            <div class="service-icon media-body me-3">
                                <i class="fa fa-search text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-2">SEO Optimization</h5>
                                <a href="" class="More_btn bg-info rounded text-white text-nowrap">Discover Now<i class="fa fa-chevron-right ms-2 text-white"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>

        <div class="container my-1">
            <footer class="text-center text-lg-start text-white bg-light">
                <div class="container p-4 pb-0">
                    <section class="">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                                <h6 class="text-uppercase mb-4 font-weight-bold">
                                    DIV-BAY
                                </h6>
                                <p class="text-muted">
                                    dev-bay is an IT company that has developed totally new ways to dealing with IT
                                    solutions and providing all necessary IT services to its clients in order to present their
                                    services to the globe.
                                </p>
                            </div>

                            <hr class="w-100 clearfix d-md-none" />

                            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Services</h6>
                                <p><a class="text-muted">Web Development</a></p>
                                <p><a class="text-muted">Mobile Development</a></p>
                                <p><a class="text-muted">IT Maintenance</a></p>
                                <p><a class="text-muted">...</a></p>
                            </div>

                            <hr class="w-100 clearfix d-md-none" />

                            <hr class="w-100 clearfix d-md-none" />

                            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Contact info</h6>
                                <p class="text-muted"><i class="fas fa-home mr-3 text-warning"></i> Mouzer route, moulay abdellah avenue, fes, morocoS</p>
                                <p class="text-muted"><i class="fas fa-envelope mr-3 text-warning"></i> dev-bay@gmail.com</p>
                                <p class="text-muted"><i class="fas fa-phone mr-3 text-warning"></i> + 01 234 567 88</p>
                            </div>

                            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                                <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>
                                <a class="btn btn-outline-primary m-1" href="#!"><i class="fab fa-facebook"></i></a>
                                <a class="btn btn-outline-primary m-1" href="#!"><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-outline-primary m-1" href="#!"><i class="fab fa-instagram"></i></a>
                                <a class="btn btn-outline-primary m-1" href="#!"><i class="fab fa-linkedin-in"></i></a>
                                <a class="btn btn-outline-primary m-1" href="#!"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="text-center p-3 text-dark">
                    © 2022 Copyright:
                    <a class="text-primary" href="../index.php">DIV-BAY</a>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="./post.js"></script>
</body>

</html>