<?php
session_start();
include('../admin/config/databaseConfig.php');
$id = $_SESSION['user']['id'];


echo "from the profile_process";
// echo $_FILES['image']['name'];
var_dump($_POST['image']);
if (($_POST['profile_image'])) {
    echo "seccuss";
    // $image = $_FILES['image']['name'];
    echo($_POST['profile_image']);
    // $img = str_replace(' ', '', explode('.', $image)[0] . rand() . "." . pathinfo($image, PATHINFO_EXTENSION));

    // $query = "select * from users where id='$id'";
    // $result = mysqli_query($connection, $query);

    // if (mysqli_num_rows($result) > 0) {
    //     foreach ($result as $user) {
    //         if (unlink("./img/users/" . $user['image'])) {
    //         }
    //     }
    // }

    // $query = "update users set image = '$img' where id='$id'";
    // $result = mysqli_query($connection, $query);

    // if ($result) {
    //     move_uploaded_file($_FILES['image']['tmp_name'], './img/users/' . $img);
    // }
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
