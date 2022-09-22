<?php
    session_start();
    include('../admin/config/databaseConfig.php');

    if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['body'])){

        $body = mysqli_real_escape_string($connection ,$_POST['body']);

        if($body === ''){
            echo "ERROR_FILL";
            exit(0);
        }

        $user_id = $_SESSION['user']['id'];

        $testQuery = "select * from testimonial where user_id = '$user_id'";
        $testResult = mysqli_query($connection, $testQuery);
        if(mysqli_num_rows($testResult) > 0){
            $Query =  "update testimonial set body = '$body', lang = 'en', state = '0' where user_id = '$user_id'";
            $Result = mysqli_query($connection, $Query);

            if($Result){
                echo "seccuss";
                exit(0);
            }else{
                echo "__FAILURE__";
                exit(0);
            }
        }
        else{
            $Query =  "insert into testimonial (user_id, body, lang, state) values ('$user_id','$body','en','0')";
            $Result = mysqli_query($connection, $Query);

            if($Result){
                echo "seccuss";
                exit(0);
            }else{
                echo "__FAILURE__";
                exit(0);
            }
        }

    }else{
        echo "<script type='text/javascript'>  window.location='../Errors/404.php'; </script>";
        exit(0);
    }
