<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    
    if(isset($_POST['email']) && isset($_POST['fullname']) && isset($_POST['service']) && isset($_POST['title']) && isset($_POST['body'])){

        $title = mysqli_real_escape_string($connection ,$_POST['title']);
        $body = mysqli_real_escape_string($connection ,$_POST['body']);
        $fullname = mysqli_real_escape_string($connection ,$_POST['fullname']);
        $service = mysqli_real_escape_string($connection ,$_POST['service']);
        $email = mysqli_real_escape_string($connection ,$_POST['email']);

        if($title === '' || $body === '' || $fullname === ''|| $email == ''){
            echo "failure";
            exit(0);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "failure";
            exit(0);
        }

        if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
            echo "failure";
            exit(0);
        }

        $Query =  "insert into email (service,title,body,email,fullname) values ('$service','$title','$body','$email','$fullname')";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            echo "seccuss";
            exit(0);
        }else{
            echo "failure";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./Errors/404.php'; </script>";
        exit(0);
    }
