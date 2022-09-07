<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    if(isset($_POST['save_btn'])){

        $body = mysqli_real_escape_string($connection ,$_POST['body']);

        if($body === ''){
            $_SESSION['message'] = 'Please, leave a comment!!';
            echo "<script type='text/javascript'>  window.location='./feedback.php'; </script>";
            exit(0);
        }

        $user_id = $_SESSION['user']['id'];

        $testQuery = "select * from comment where user_id = '$user_id'";
        $testResult = mysqli_query($connection, $testQuery);
        if(mysqli_num_rows($testResult) > 0){
            $Query =  "update comment set body = '$body', lang = 'en', state = '0' where user_id = '$user_id'";
            $Result = mysqli_query($connection, $Query);
            echo "<script> alert('after'); </script>";


            if($Result){
                $_SESSION['message'] = "UpDated Seccussfully :)";
                echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
                exit(0);
            }else{
                $_SESSION['message'] = "Something went wrong, Please Try again :)";
                echo "<script type='text/javascript'>  window.location='./feedback.php'; </script>";
                exit(0);
            }
        }
        else{
            $Query =  "insert into comment (user_id, body, lang, state) values ('$user_id','$body','en','0')";
            $Result = mysqli_query($connection, $Query);


            if($Result){
                $_SESSION['message'] = "Added Seccussfully :)";
                echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
                exit(0);
            }else{
                $_SESSION['message'] = "Something went wrong, Please Try again :)";
                echo "<script type='text/javascript'>  window.location='./feedback.php'; </script>";
                exit(0);
            }
        }

        

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>