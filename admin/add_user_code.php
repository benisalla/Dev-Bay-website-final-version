<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $Fname = mysqli_real_escape_string($connection ,$_POST['fname']);
        $Lname = mysqli_real_escape_string($connection ,$_POST['lname']);
        $profession = mysqli_real_escape_string($connection ,$_POST['profession']);
        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['password']);
        $role = mysqli_real_escape_string($connection ,$_POST['role']);
        $status = mysqli_real_escape_string($connection ,$_POST['status'][0]) == 'on' ? '1' : '0';

        $image = $_FILES['image']['name'];
        $img = str_replace(' ','',explode('.',$image)[0].rand().".".pathinfo($image, PATHINFO_EXTENSION));


        if($Fname === '' || $Lname === '' ||$Email === '' ||$Pass === '' || $profession === ''){
            $_SESSION['message'] = [
                'content' => 'Please fill in all the fields !!',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = [
                'content' => "email is not in a proper form :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Fname)) {
            $_SESSION['message'] = [
                'content' => "first name should contain just letters and white-space :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Lname)) {
            $_SESSION['message'] = [
                'content' => "last name should contain just letters and white-space :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$profession)) {
            $_SESSION['message'] = [
                'content' => "profession should contain just letters and white-space :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }


        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if(!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            $_SESSION['message'] = [
                'content' => "ths password is too weak :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./edit_user.php?id=".$id."'; </script>";
            exit(0);
        }

        $textQuery = "select * from users where email = '$Email'";
        $testResult = mysqli_query($connection, $textQuery);

        if(mysqli_num_rows($testResult) > 0){
            $_SESSION['message'] = [
                'content' => "This email already exist :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_user_page.php'; </script>";
            exit(0);
        }

        $encPass = crypt($Pass,"dev-bay");

        $Query = "insert into users (firstname,lastname,profession,email,password,role_as,status) values ('$Fname', '$Lname','$profession','$Email', '$encPass', '$role','$status')";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            move_uploaded_file($_FILES['image']['tmp_name'],'../img/users/'.$img);
            $_SESSION['message'] = [
                'content' => "Added Seccussfully :)",
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./registered_users.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = [
                'content' => "Something went wrong, Please Try again :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_user_page.php'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>