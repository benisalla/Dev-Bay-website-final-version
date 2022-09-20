<?php
    include('./authCode.php');

    if(isset($_POST['delete_btn'])){
        $id = $_POST['delete_btn'];

        $Query = "delete from post where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if($Result){
            $_SESSION['message'] = [
                'content' => 'Deleted Successfully :)',
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./view_post.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = [
                'content' => 'Something Went Wrong :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./view_post.php'; </script>";
            exit(0);
        }
    }else{
        $_SESSION['message'] = [
            'content' => 'Error :)',
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }
?>