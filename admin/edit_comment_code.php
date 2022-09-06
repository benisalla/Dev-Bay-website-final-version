<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $auther_id = mysqli_real_escape_string($connection ,$_POST['author']);
        $body = mysqli_real_escape_string($connection ,$_POST['body']);
        $lang = mysqli_real_escape_string($connection ,$_POST['lang']);
        $state = $_POST['state'][0] == 'on' ? '1' : '0';
        $cdate = mysqli_real_escape_string($connection ,$_POST['cdate']);
        $udate = mysqli_real_escape_string($connection ,$_POST['udate']);
        $id = $_POST['save_btn'];


        if($body === ''){
            $_SESSION['message'] = 'Please, fill in the comment !!';
            echo "<script type='text/javascript'>  window.location='./edit_comment.php?id=".$id."'; </script>";
            exit(0);
        }

        $Query =  "update comment set user_id='$auther_id', state='$state', body='$body',
                created_at='$cdate', updated_at='$udate', lang='$lang' where id='$id'";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            move_uploaded_file($_FILES['image']['tmp_name'],'../img/blog/'.$img);
            $_SESSION['message'] = "Updated Seccussfully :)";
            echo "<script type='text/javascript'>  window.location='./view_comment.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = "Something went wrong, Please Try again :)";
            echo "<script type='text/javascript'>  window.location='./edit_comment.php?id=".$id."'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>