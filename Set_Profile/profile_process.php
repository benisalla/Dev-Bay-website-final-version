<?php
session_start();
include('../admin/config/databaseConfig.php');
$id = $_SESSION['user']['id'];


if ($_FILES['image']) {
    $image = $_FILES['image']['name'];
    $img = str_replace(' ', '', explode('.', $image)[0] . rand() . "." . pathinfo($image, PATHINFO_EXTENSION));

    $query = "select * from users where id='$id'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $user) {
            if (unlink("../img/users/" . $user['image'])) {
            }
        }
    }

    $query = "update users set image = '$img' where id='$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../img/users/' . $img);
        echo "../img/users/$img";
        exit(0);
    }
    echo "__FAILURE__";
}


// ------------------------------------------------------------------------------------------------------------


if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['profession'])) {

    $Fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $Lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $Email = mysqli_real_escape_string($connection, $_POST['email']);
    $Prof = mysqli_real_escape_string($connection, $_POST['profession']);
    $Pass = mysqli_real_escape_string($connection, $_POST['password']);
    $ConfPass = mysqli_real_escape_string($connection, $_POST['conf_password']);

    if ($Fname === '' || $Lname === '' || $Email === '' || $Prof === '') {
        echo "ERROR_FILL";
        exit(0);
    }

    if ($Pass !== $ConfPass) {
        echo "ERROR_CONF_PASS";
        exit(0);
    }

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "ERROR_EMAIL";
        exit(0);
    }


    if (!preg_match("/^[a-zA-Z-' ]*$/", $Fname)) {
        echo "ERROR_FNAME";
        exit(0);
    }


    if (!preg_match("/^[a-zA-Z-' ]*$/", $Lname)) {
        echo "ERROR_LNAME";
        exit(0);
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $Prof)) {
        echo "ERROR_PROF";
        exit(0);
    }


    if ($Pass != '' && $ConfPass != '') {
        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if (!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            echo "ERROR_WEAK_PASS";
            exit(0);
        }

        $encPass = crypt($Pass, "dev-bay");

        $Query = "update users set firstname='$Fname',lastname='$Lname',email='$Email',password='$encPass' where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if ($Result) {
            echo "seccuss";
            exit(0);
        } else {
            echo "failure";
            exit(0);
        }
    } else {
        $Query = "update users set firstname='$Fname',lastname='$Lname',email='$Email' where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if ($Result) {
            echo "seccuss";
            exit(0);
        } else {
            echo "failure";
            exit(0);
        }
    }
}
