<?php
include('../admin/config/databaseConfig.php');

if (isset($_POST['msg'])) :
    $body = $_POST['msg'];
    $author_id = $_POST['author_id'];
    $comment_id = $_POST['comment_id'];

    $query = "INSERT INTO reply (author_id, comment_id, body) VALUES ('$author_id','$comment_id','$body')";
    $result = mysqli_query($connection, $query);
    if ($result) :

        $replyQuery = "select * from reply where comment_id = '$comment_id' order by created_at limit 3";
        $replyResult = mysqli_query($connection, $replyQuery);
        if (mysqli_num_rows($replyResult) > 0) :
            foreach ($replyResult as $reply) :
                $author_id = $reply['author_id'];

                $allRows = 0;

                $Query = "select count(*) as numOfRows from reply where comment_id = '$comment_id'";
                $Result = mysqli_query($connection, $Query);
                if (mysqli_num_rows($Result) > 0) {
                    $arr = mysqli_fetch_array($Result);
                    $allRows = $arr['numOfRows'];
                }

                $authorQuery = "select * from users where id = '$author_id'";
                $authorResult = mysqli_query($connection, $authorQuery);
                if (mysqli_num_rows($authorResult) > 0) :
                    foreach ($authorResult as $author) : ?>
                        <div class="d-flex flex-start mt-4 ms-5 p-2 shadow rounded reply_data_class_<?= $comment_id ?>">

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
                    <div class="d-flex flex-start mt-4 ms-5 p-2 shadow rounded reply_data_class_<?= $comment_id ?>">
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
                                            $lastTime = DateTime::createFromFormat('Y-m-d h:i:s', $reply['created_at']);
                                            $currentTime = new DateTime();
                                            $diff = $currentTime->diff($currentTime);
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
                <div class="show_more_<?= $comment_id ?>">
                    <p class="<?= $allRows > 3 ? 'display_more' : '' ?> text-dark" id="<?= $comment_id ?>">
                        <?= $allRows > 3 ? 'Show More Replies' : 'No More Replies' ?>
                    </p>
                    <input type="hidden" class="numOfRows" value="0">
                    <input type="hidden" class="allRows" value="<?= $allRows ?>">
                    <input type="hidden" class="fileName" value="fetchData_reply.php">
                </div>
            </div>

        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>