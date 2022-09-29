<?php
include("./config/databaseConfig.php");


if (isset($_POST['label']) && isset($_POST['tool'])) :
    $tool = $_POST['tool'];
    $label = $_POST['label'];

    if($label == ''){
        echo '__ERROR__';
        exit(0);
    }

    $userTest = "user" == $tool;
    $postTest = "post" == $tool;
    $requestTest = "request" == $tool;
    $testimonialTest = "testimonial" == $tool;

    if($tool == 'all'){
        $userTest = true;
        $postTest = true;
        $requestTest = true;
        $testimonialTest = true;
    }


    if ($userTest) :
        $user_query = "select * from users where firstname like '%$label%' or lastname like '%$label%' limit 5";
        $user_result = mysqli_query($connection, $user_query);
        if (mysqli_num_rows($user_result) > 0) :
            foreach ($user_result as $user) :
                $date = new DateTime($user['created_at']); ?>
                <li class=" search-item d-flex align-items-center justify-content-between no-block card-body shadow rounded mb-1">
                    <img class="m-2" src="../../img/users/<?= $user['image'] != '' ? $user['image'] : "profile.png" ?>" alt="user picture" height="36px" width="36px" style="border-radius: 50%;">
                    <div class="">
                        <a href="#" class="font-medium p-0 mb-1 d-block text-decoration-none text-muted search-hover"><?= $user['profession'] ?></a>
                        <small class="text-dark d-block text-uppercase fs-8"><?= $user['firstname'] . " " . $user['lastname'] ?></small>
                    </div>
                    <div class="">
                        <div class="text-end ms-1">
                            <h5 class="text-muted">
                                <?= $date->format('d') ?>
                            </h5>
                            <span class="text-muted font-16">
                                <?= $date->format('M') ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($postTest) :

        $post_query = "select * from post where title like '%$label%' or excerpt like '%$label%' or body like '%$label%' limit 5";
        $post_result = mysqli_query($connection, $post_query);
        if (mysqli_num_rows($post_result) > 0) :
            foreach ($post_result as $post) :
                $date = new DateTime($post['created_at']); ?>
                <li class=" search-item d-flex align-items-center justify-content-between no-block card-body shadow rounded mb-1">
                    <img class="m-2" src="../img/blog/<?= $post['image'] != '' ? $post['image'] : "event.png" ?>" alt="user picture" height="36px" width="36px" style="border-radius: 2px;">
                    <div class="">
                        <a href="#" class="font-medium p-0 mb-1 d-block text-decoration-none text-muted search-hover"><?= $post['title'] ?></a>
                        <small class="text-dark d-block text-uppercase fs-8">
                            <?php
                            $id = $post['user_id'];
                            $query = "select * from users where id = '$id'";
                            $result = mysqli_query($connection, $query);
                            if (mysqli_num_rows($result) > 0) {
                                foreach ($result as $user) {
                                    echo $user['firstname'] . " " . $user['lastname'];
                                }
                            } else {
                                echo "Unknown Author";
                            }
                            ?>
                        </small>
                    </div>
                    <div class="">
                        <div class="text-end ms-1">
                            <h5 class="text-muted">
                                <?= $date->format('d') ?>
                            </h5>
                            <span class="text-muted font-16">
                                <?= $date->format('M') ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($requestTest) :

        $request_query = "select * from email where title like '%$label%' or service like '%$label%' or body like '%$label%' limit 5";
        $request_result = mysqli_query($connection, $request_query);
        if (mysqli_num_rows($request_result) > 0) :
            foreach ($request_result as $request) :
                $date = new DateTime($request['created_at']); ?>
                <li class=" search-item d-flex align-items-center justify-content-between no-block card-body shadow rounded mb-1">
                    <div class="bg-dark d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; border-radius: 18px;">
                        <i class="fa fa-envelope m-2 text-light"></i>
                    </div>
                    <div class="">
                        <a href="#" class="font-medium p-0 mb-1 d-block text-decoration-none text-muted search-hover"><?= $request['title'] ?></a>
                        <small class="text-dark d-block text-uppercase fs-8">
                            <?= $request['fullname'] ?>
                        </small>
                    </div>
                    <div class="">
                        <div class="text-end ms-1">
                            <h5 class="text-muted">
                                <?= $date->format('d') ?>
                            </h5>
                            <span class="text-muted font-16">
                                <?= $date->format('M') ?>
                            </span>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php if ($testimonialTest) :

        $user_query = "select * from users where firstname like '%$label%' or lastname like '%$label%' limit 5";
        $user_result = mysqli_query($connection, $user_query);
        if (mysqli_num_rows($user_result) > 0) :
            foreach ($user_result as $user) :
                $id = $user['id'];
                $testimonial_query = "select * from testimonial where user_id = '$id' limit 6";
                $testimonial_result = mysqli_query($connection, $testimonial_query);
                if (mysqli_num_rows($testimonial_result) > 0) :
                    foreach ($testimonial_result as $testimonial) :
                        $date = new DateTime($testimonial['created_at']); ?>
                        <li class=" search-item d-flex align-items-center justify-content-between no-block card-body shadow rounded mb-1">
                            <div class="bg-dark d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; border-radius: 18px;">
                                <i class="fa fa-message m-2 text-light"></i>
                            </div>
                            <div class="">
                                <a href="#" class="font-medium p-0 mb-1 d-block text-decoration-none text-muted search-hover">
                                    <?php
                                    $arr = explode(' ', $testimonial['body']);
                                    if (count($arr) > 2) {
                                        echo $arr[0] . " " . $arr[1] . " " . $arr[2] . " ...";
                                    } else {
                                        echo $testimonial['body'];
                                    }
                                    ?>
                                </a>
                                <small class="text-dark d-block text-uppercase fs-8">
                                    <?= $user['firstname'] . " " . $user['lastname'] ?>
                                </small>
                            </div>
                            <div class="">
                                <div class="text-end ms-1">
                                    <h5 class="text-muted">
                                        <?= $date->format('d') ?>
                                    </h5>
                                    <span class="text-muted font-16">
                                        <?= $date->format('M') ?>
                                    </span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

    <?php endif; ?>
<?php endif; ?>