<?php
session_start();
include('../admin/config/databaseConfig.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>feedback</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./testimonial.css">
</head>

<body>

    <div class="container-fluid px-4">
        <h1 class="mt-4">Our client's feedback</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <?php
                        $id = $_SESSION['user']['id'];
                        $Query = "select * from testimonial where user_id = '$id' limit 1";
                        $Result = mysqli_query($connection, $Query);
                        if (mysqli_num_rows($Result) > 0) :
                            foreach ($Result as $testimonial) : ?>
                                <h4>Editing Your feedback
                                    <a href='../index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                                </h4>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <h4>Adding a feedback
                                <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                            </h4>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <!-------------------------------------->
                        <div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="fullname">Full Name</label>
                                    <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['name'] : '' ?>" type="text" class="form-control" id="fullname">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Email">Email</label>
                                    <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['email'] : '' ?>" type="email" class="form-control" id="email">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="body">What do you think about DEV-BAY services ?</label>

                                    <?php
                                    $id = $_SESSION['user']['id'];
                                    $Query = "select * from testimonial where user_id = '$id' limit 1";
                                    $Result = mysqli_query($connection, $Query);
                                    if (mysqli_num_rows($Result) > 0) :
                                        foreach ($Result as $testimonial) : ?>
                                            <textarea name="body" required class="form-control" id="body"><?= $testimonial['body'] ?></textarea>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <textarea name="body" required class="form-control" id="body"></textarea>
                                    <?php endif; ?>

                                </div>

                                <div>
                                    <button class="btn fs-4 spatiel-btn m-1 float-end" id="save_btn">
                                        SAVE
                                    </button>
                                </div>
                                <div id="title_and_massage" style="width: 100%; height: 30px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/jquery.min.js"></script>
    <script src="./testimonial.js"></script>

</body>

</html>