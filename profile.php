<?php
include('./tellMessage.php');
include('./admin/config/databaseConfig.php');
$id = $_SESSION['user']['id'];

if (isset($_FILES['image'])) {
    $image = $_FILES['image']['name'];
    $img = str_replace(' ', '', explode('.', $image)[0] . rand() . "." . pathinfo($image, PATHINFO_EXTENSION));

    $id = $_SESSION['user']['id'];

    $query = "select * from users where id='$id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $user) {
            if (unlink("./img/users/" . $user['image'])) {
            }
        }
    }

    $query = "update users set image = '$img' where id='$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], './img/users/' . $img);
    }
}

if (isset($_POST['save_btn'])) {

    $Fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $Lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $Email = mysqli_real_escape_string($connection, $_POST['email']);
    $Prof = mysqli_real_escape_string($connection, $_POST['profession']);
    $Pass = mysqli_real_escape_string($connection, $_POST['pass']);
    $ConfPass = mysqli_real_escape_string($connection, $_POST['cpass']);


    if ($Fname === '' || $Lname === '' || $Email === '' || ($Pass === '' && $ConfPass !== '') || ($Pass !== '' && $ConfPass === '') || $Prof === '') {
        $_SESSION['message'] = [
            'content' => 'Please fill in all the fields (except password is optional) !!',
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
        exit(0);
    }


    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = [
            'content' => "email is not in a proper form :)",
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
        exit(0);
    }


    if (!preg_match("/^[a-zA-Z-' ]*$/", $Fname)) {
        $_SESSION['message'] = [
            'content' => "first name should contain just letters and white-space :)",
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
        exit(0);
    }


    if (!preg_match("/^[a-zA-Z-' ]*$/", $Lname)) {
        $_SESSION['message'] = [
            'content' => "last name should contain just letters and white-space :)",
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
        exit(0);
    }


    if ($Pass !== '' || $ConfPass !== '') {
        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if (!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            $_SESSION['message'] = [
                'content' => "ths password is too weak :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if ($Pass !== $ConfPass) {
            $_SESSION['message'] = [
                'content' => "you didn't conform password correctly :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }

        $encPass = crypt($Pass, "dev-bay");

        $Query = "update users set firstname='$Fname',lastname='$Lname',email='$Email',password='$encPass' where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if ($Result) {
            $_SESSION['message'] = [
                'content' => "UpDated Seccussfully :)",
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
            exit(0);
        } else {
            $_SESSION['message'] = [
                'content' => "something went wrong during registration :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
            exit(0);
        }
    } else {
        $Query = "update users set firstname='$Fname',lastname='$Lname',email='$Email' where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if ($Result) {
            $_SESSION['message'] = [
                'content' => "UpDated Seccussfully :)",
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
            exit(0);
        } else {
            $_SESSION['message'] = [
                'content' => "something went wrong during registration :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./profile.php'; </script>";
            exit(0);
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="dev_bay website" name="description">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin-top: 20px;
            background-color: #f2f6fc;
            color: #69707a;
        }

        input {
            color: #000 !important;
        }

        .img-account-profile {
            height: 10rem;
            width: 10rem;
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .card {
            box-shadow: 0 0.15rem 1.75rem 0 rgb(33 40 50 / 15%);
        }

        .card .card-header {
            font-weight: 500;
        }

        .card-header:first-child {
            border-radius: 0.35rem 0.35rem 0 0;
        }

        .card-header {
            padding: 1rem 1.35rem;
            margin-bottom: 0;
            background-color: rgba(33, 40, 50, 0.03);
            border-bottom: 1px solid rgba(33, 40, 50, 0.125);
        }

        .form-control,
        .dataTable-input {
            display: block;
            width: 100%;
            padding: 0.875rem 1.125rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1;
            color: #69707a;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #c5ccd6;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            border-radius: 0.35rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .nav-borders .nav-link.active {
            color: #0061f2;
            border-bottom-color: #0061f2;
        }

        .nav-borders .nav-link {
            color: #69707a;
            border-bottom-width: 0.125rem;
            border-bottom-style: solid;
            border-bottom-color: transparent;
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            padding-left: 0;
            padding-right: 0;
            margin-left: 1rem;
            margin-right: 1rem;
        }
    </style>
</head>

<body>


    <div class="container-xl px-4 mt-4">
        <hr class="mt-0 mb-4">
        <div class="row">
            <h4>Edit Your Profile
                <a href='./index.php'><button class="btn btn-primary float-end rounded">Back</button></a>
            </h4>
            <div class="col-xl-4">
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header text-center">Profile Picture</div>
                    <div class="card-body text-center">
                        <form id="MyForm" action="./profile.php" method="POST" enctype="multipart/form-data">
                            <?php
                            $id = $_SESSION['user']['id'];
                            $query = "select * from users where id = '$id'";
                            $result = mysqli_query($connection, $query);
                            if (mysqli_num_rows($result)) :
                                foreach ($result as $user) :
                                    $img = $user['image']; ?>
                                    <img class="img-account-profile rounded-circle mb-2" src="./img/users/<?= $img ?>" alt="">
                                <?php endforeach; ?>
                            <?php else : ?>
                                <img class="img-account-profile rounded-circle mb-2" src="./img/users/profile.png" alt="">
                            <?php endif; ?>


                            <input type="file" name="image" id="Image" style="display: none;">

                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                        </form>

                        <button class="btn btn-primary" type="button" id="UpLoad">Upload new image</button>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header text-center">Your Info</div>
                    <div class="card-body">
                        <form action="./profile.php" method="POST">

                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="Fname">First name</label>
                                    <input value="<?= $_SESSION['user']['firstname'] ?>" name="fname" class="form-control" id="Fname" class="fname" type="text" placeholder="Enter your first name">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="Lname">Last name</label>
                                    <input value="<?= $_SESSION['user']['lastname'] ?>" name="lname" class="form-control" id="Lname" class="lname" type="text" placeholder="Enter your last name">
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="Profession">Profession/job</label>
                                    <?php
                                    $id = $_SESSION['user']['id'];
                                    $query = "select * from users where id = '$id'";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result)) :
                                        foreach ($result as $user) :
                                            $prof = $user['profession']; ?>
                                            <input value="<?= $prof != '' ? $prof : '' ?>" class="form-control" name="profession" id="Profession" type="text" placeholder="Enter your profession name">
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <input class="form-control" name="profession" id="Profession" type="text" placeholder="Enter your profession name">
                                    <?php endif; ?>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input value="<?= $_SESSION['user']['email'] ?>" name="email" class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address">
                            </div>
                            <div class="small font-italic text-muted mb-1">fill these fields if you want to change the password</div>
                            <div class="row gx-3 mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1" for="Pass">Password</label>
                                    <input class="form-control" name="pass" id="Pass" type="text" placeholder="Enter your password address">
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="Cpass">Confirm Password</label>
                                    <input class="form-control" name="cpass" id="Cpass" type="text" placeholder="Enter your password address">
                                </div>
                            </div>

                            <button class="btn btn-primary" name="save_btn" type="submit">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector("#UpLoad").addEventListener('click', () => {
            document.querySelector("#Image").click();
        });

        document.querySelector("#Image").addEventListener('change', () => {
            document.querySelector("#MyForm").submit();
        });
    </script>

</body>

</html>