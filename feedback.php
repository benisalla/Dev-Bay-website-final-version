<?php 
    session_start();
    include('./admin/config/databaseConfig.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>feedback</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
                        $Query = "select * from comment where user_id = '$id' limit 1";
                        $Result = mysqli_query($connection, $Query);
                        if(mysqli_num_rows($Result) > 0):
                            foreach($Result as $comment):?>
                                <h4>editing Your feedback
                                    <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                                </h4>

                            <?php endforeach; ?>
                        <?php else: ?>
                            <h4>adding a feedback
                                <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
                            </h4>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">
                        <!-------------------------------------->
                        <form action="./feedback_code.php" method="POST">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="Fullname">Full Name</label>
                                    <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['name'] : ''?>" type="text" name="fullname" class="form-control" id="Fullname">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="Email">Email</label>
                                    <input value="<?= isset($_SESSION['user']) ? $_SESSION['user']['email'] : ''?>" type="email" name="email" class="form-control" id="Email">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="Body">What do you think about DEV-BAY services ?</label>

                                    <?php  
                                    $id = $_SESSION['user']['id'];
                                    $Query = "select * from comment where user_id = '$id' limit 1";
                                    $Result = mysqli_query($connection, $Query);
                                    if(mysqli_num_rows($Result) > 0):
                                        foreach($Result as $comment):?>
                                            <textarea name="body" required class="form-control" id="Body"><?= $comment['body'] ?></textarea>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <textarea name="body" required class="form-control" id="Body"></textarea>
                                    <?php endif; ?>
                                    
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button type="submit" name="save_btn" class="btn btn-primary">Send</button>
                                </div>
                            </div>
                        </form>

                        <!-------------------------------------->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>