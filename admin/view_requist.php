<?php
include('./authCode.php');
include('../tellMessage.php');
include('./includes/header.php');
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-3">
            <div class="d-flex  justify-content-between bg-light py-2">
                <h4>Messages</h4>
                <a href='./view_email.php'><button class="btn btn-primary float-end rounded">Back</button></a>
            </div>


            <?php if (isset($_GET['id'])) :

                $UpdateQuery = "update email set state = '1' where id = " . $_GET['id'];
                $UpdateResult = mysqli_query($connection, $UpdateQuery);

                if($UpdateResult)
                    echo "<script> alert(seen) </script>";

                $Query = "select * from email where id = " . $_GET['id'];
                $Result = mysqli_query($connection, $Query);
                if (mysqli_num_rows($Result) > 0) :
                    foreach ($Result as $email) : ?>
                        <div class="card shadow-none mt-3 border border-light">
                            <div class="card-body px-4">
                                <div class="media mb-3 d-flex justify-content-between flex-wrap-reverse">
                                    <div class="mb-3 d-flex ">
                                        <div class="me-4">
                                            <?php
                                            $userEmail = $email['email'];
                                            $UserQuery = "select * from users where email = '$userEmail'";
                                            $UserResult = mysqli_query($connection, $UserQuery);
                                            if (mysqli_num_rows($UserResult) > 0) :
                                                foreach ($UserResult as $user) : ?>
                                                    <img src="../img/users/<?= $user['image'] ?>" class="rounded-circle mr-3 mail-img shadow" alt="sender picture" width="80" height="80">
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <img src="../img/users/profile.png" class="rounded-circle mr-3 mail-img shadow" alt="sender picture" width="80" height="80">
                                            <?php endif; ?>
                                        </div>
                                        <div class="media-body">
                                            <span class="media-meta float-right">
                                                <?php
                                                $date = DateTime::createFromFormat('Y-m-d h:m:s', $email['created_at']);
                                                if ($date->format('h') <= 12)
                                                    echo $date->format('h:m') . "  AM";
                                                else
                                                    echo $date->format('h:m') . "  PM";
                                                ?>
                                            </span>
                                            <h4 class="text-primary m-0"><?= $email['fullname'] ?></h4>
                                            <small class="text-muted">From : <?= $email['email'] ?></small>
                                        </div>
                                    </div>

                                    <div class="btn-toolbar" role="toolbar">
                                        <div class="btn-group mb-4 d-flex align-items-center" style="height: 2rem;">
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-envelope"></i></button>
                                            <button type="button" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-mail-forward"></i></button>
                                            <form action="./delete_email.php" method="POST">
                                                <button type="submit" name="delete_btn" value="<?= $email['id'] ?>" class="btn btn-outline-primary waves-effect waves-light"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <h5>Subject</h5>
                                    <p class="ms-4"><?= $email['title'] ?></p>
                                </div>

                                <div>
                                    <h5>Type of service</h5>
                                    <p class="ms-4"><?= $email['service'] ?></p>
                                </div>

                                <hr>

                                <p><b>Hi <?= $_SESSION['user']['name'] ?></b></p>
                                <p><?= $email['body'] ?></p>

                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div colspan="12" class="bg-danger text-light py-3 text-center container">
                        No Records !!
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <div colspan="12" class="bg-danger text-light py-3 text-center container">
                    No Records !!
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
include('./includes/footer.php');
include('./includes/scripts.php');
?>