<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $Fname = mysqli_real_escape_string($connection ,$_POST['fname']);
        $Lname = mysqli_real_escape_string($connection ,$_POST['lname']);
        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['password']);
        $role = mysqli_real_escape_string($connection ,$_POST['role']);
        $status = mysqli_real_escape_string($connection ,$_POST['status'][0]) == 'on' ? '1' : '0';
        $id = $_POST['id'];
        

        if($Fname === '' || $Lname === '' ||$Email === '' ||$Pass === ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "email is not in a proper form :)";
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Fname)) {
            $_SESSION['message'] = "first name should contain just letters and white-space :)";
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Lname)) {
            $_SESSION['message'] = "last name should contain just letters and white-space :)";
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if(!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            $_SESSION['message'] = "ths password is too weak :)";
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        $Query = "update users set email = '$Email', password = '$Pass', firstname = '$Fname', lastname = '$Lname', role_as = '$role', status = '$status' where id = '$id'";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            $_SESSION['message'] = "Updated Seccussfully :)";
            echo "<script type='text/javascript'>  window.location='./registered_users.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = "Something went wrong, Please Try again :)";
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>