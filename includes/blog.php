<?php include('./admin/config/databaseConfig.php'); ?>

<div class="container-fluid m-3 wow fadeInUp" data-wow-delay="0.1s" id="blog">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Our Latest Bloges</h5>
            <h1 class="mb-0">Read our most recent mobile and web development blogs</h1>
        </div>
        <div class="row ">

            <?php
            $postQuery = "select * from post where state = '1' ORDER BY RAND() LIMIT 3";
            $postResult = mysqli_query($connection, $postQuery);

            if (mysqli_num_rows($postResult) > 0) :
                $i = 0;
                foreach ($postResult as $post) :
                    $i += 0.3; ?>

                    <div class="col-lg-4 g-3 wow " data-wow-delay="<?= $i ?>s">
                        <div class="blog-item slideInUp bg-light rounded overflow-hidden">
                            <div class="blog-img position-relative overflow-hidden">
                                <div class="py-2" style="width: 100%; height: 200px; overflow: hidden; position: relative;">
                                    <img class="img-fluid" src="img/blog/<?= $post['image'] == '' ? 'event.png' : $post['image'] ?>" alt="event picture" style="object-fit: cover; position: absolute; top:50%; left: 50%; transform: translate(-50%, -50%);">
                                </div>
                                <a class="side-btn text-white rounded-end mt-5 py-2 px-4" href="">
                                    <?php
                                    $id = $post['category_id'];
                                    $categoryQuery = "select * from category where id = '$id' ";
                                    $categoryResult = mysqli_query($connection, $categoryQuery);

                                    if (mysqli_num_rows($categoryResult) > 0) {
                                        foreach ($categoryResult as $category) {
                                            echo $category['name'];
                                        }
                                    } else {
                                        echo "UnKnown Category";
                                    }
                                    ?>
                                </a>
                            </div>
                            <div class="p-4 w-100">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i class="far fa-user text-primary me-2"></i>
                                        <?php
                                        $id = $post['user_id'];
                                        $userQuery = "select * from users where id = '$id' ";
                                        $userResult = mysqli_query($connection, $userQuery);

                                        if (mysqli_num_rows($userResult) > 0) {
                                            foreach ($userResult as $user) {
                                                echo $user['firstname'] . " " . $user['lastname'];
                                            }
                                        } else {
                                            echo "UnKnown author";
                                        }
                                        ?>
                                    </small>
                                    <small><i class="far fa-calendar-alt text-primary me-2"></i>
                                        <?php
                                        $date = new DateTime($post['created_at']);
                                        echo $date->format('d') . " " . $date->format('M') . ", " . $date->format('Y');
                                        ?>
                                    </small>
                                </div>
                                <h4 class="mb-3"><?= $post['title'] ?></h4>
                                <p><?= $post['excerpt'] ?></p>
                                <a class="text-uppercase" href="./posts/post.php?id=<?= $post['id'] ?>">Read More <i class='fa fa-chevron-circle-right' style='color: blue'></i></a>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else : ?>

                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.3s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog/blog-1.jpg" alt="">
                            <a class="side-btn text-white rounded-end mt-5 py-2 px-4" href="">Web & mobile Design</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="#">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.6s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog/blog-2.jpg" alt="">
                            <a class="side-btn text-white rounded-end mt-5 py-2 px-4" href="">mobile Development</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="#">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 wow slideInUp" data-wow-delay="0.9s">
                    <div class="blog-item bg-light rounded overflow-hidden">
                        <div class="blog-img position-relative overflow-hidden">
                            <img class="img-fluid" src="img/blog/blog-3.jpg" alt="">
                            <a class="side-btn text-white rounded-end mt-5 py-2 px-4" href="">common problems</a>
                        </div>
                        <div class="p-4">
                            <div class="d-flex mb-3">
                                <small class="me-3"><i class="far fa-user text-primary me-2"></i>John Doe</small>
                                <small><i class="far fa-calendar-alt text-primary me-2"></i>01 Jan, 2045</small>
                            </div>
                            <h4 class="mb-3">How to build a website</h4>
                            <p>Dolor et eos labore stet justo sed est sed sed sed dolor stet amet</p>
                            <a class="text-uppercase" href="#">Read More <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>