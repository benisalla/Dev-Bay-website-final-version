<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $auther_id = mysqli_real_escape_string($connection ,$_POST['author']);
        $body = mysqli_real_escape_string($connection ,$_POST['body']);
        $lang = mysqli_real_escape_string($connection ,$_POST['lang']);
        $state = $_POST['state'][0] == 'on' ? '1' : '0';
        $cdate = mysqli_real_escape_string($connection ,$_POST['cdate']);
        $udate = mysqli_real_escape_string($connection ,$_POST['udate']);


        if($body === ''){
            $_SESSION['message'] = 'Please, write something as a Comment !!';
            echo "<script type='text/javascript'>  window.location='./add_comment.php'; </script>";
            exit(0);
        }

        $Query =  "insert into comment (user_id, state, body, created_at, updated_at, lang) values 
                                    ('$auther_id','$state','$body','$cdate','$udate','$lang')";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            $_SESSION['message'] = "Added Seccussfully :)";
            echo "<script type='text/javascript'>  window.location='./view_comment.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = "Something went wrong, Please Try again :)";
            echo "<script type='text/javascript'>  window.location='./add_comment.php'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>