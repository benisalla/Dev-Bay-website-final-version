<?php
include('../admin/config/databaseConfig.php');

$numOfRows = $_POST['numOfRows'];
$post_id = $_POST['post_id'];
$amount = 3;

$commentQuery = "select * from comment where post_id = '$post_id' order by created_at limit $numOfRows,$amount";
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
                                <div class="d-flex flex-row align-items-center spacial_li px-1 comment-evaluation comment_dislike_it  CRC_<?= $Co_id ?>" iden="CRC_<?= $comment['id'] ?>" author="<?= $Au_id ?>" comment="<?= $Co_id ?>">
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
<?php endif; ?>