<?php include('./admin/config/databaseConfig.php'); ?>

<div id="testimonial" class="container-fluid  wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
            <h5 class="fw-bold text-primary text-uppercase">Testimonial</h5>
            <h1 class="mb-0">What Our Clients Say About Our Digital Services</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">


        <?php
            $CommentQuery = "select * from comment where state = '1' ";
            $CommentResult = mysqli_query($connection, $CommentQuery);

            if (mysqli_num_rows($CommentResult) > 0) :
                foreach ($CommentResult as $comment) : ?>

                    <div class="testimonial-item bg-light my-4">
                        <?php 
                        $id = $comment['user_id'];
                        $userQuery = "select * from users where id = '$id' ";
                        $userResult = mysqli_query($connection, $userQuery);
            
                        if (mysqli_num_rows($userResult) > 0):
                            foreach ($userResult as $user):?>
                                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                                    <img class="img-fluid rounded" src="img/users/<?= $user['image'] ?>" style="width: 60px; height: 60px;">
                                    <div class="ps-4">
                                        <h4 class="text-primary mb-1"><?= $user['firstname']." ".$user['lastname'] ?></h4>
                                        <small class="text-uppercase"><?= $user['profession']?></small>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php else:?>
                                <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                                    <img class="img-fluid rounded" src="" style="width: 60px; height: 60px;">
                                    <div class="ps-4">
                                        <h4 class="text-primary mb-1">UnKnown Author</h4>
                                        <small class="text-uppercase">thus Unknown profession</small>
                                    </div>
                                </div>
                        <?php endif;?>
                        <div class="pt-4 pb-5 px-5">
                            <?= $comment['body'] ?>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php else: ?>

                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;">
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
            
            <?php endif; ?>
            
        </div>
    </div>
</div>