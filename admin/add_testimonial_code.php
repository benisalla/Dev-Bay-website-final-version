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
            $_SESSION['message'] = [
                'content' => 'You forgot to fill the testimonial !!',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_testimonial.php'; </script>";
            exit(0);
        }

        $Query =  "insert into testimonial (user_id, state, body, created_at, updated_at, lang) values 
                                    ('$auther_id','$state','$body','$cdate','$udate','$lang')";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            $_SESSION['message'] = [
                'content' => "Added Seccussfully :)",
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./view_testimonial.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = [
                'content' => "Something went wrong, Please Try again :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_testimonial.php'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>