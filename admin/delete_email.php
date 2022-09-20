<?php
    include('./authCode.php');

    if(isset($_POST['delete_btn'])){
        $id = $_POST['delete_btn'];

        unset($_SESSION['counter']);
        unset($_SESSION['sizeOfData']);

        $Query = "delete from email where id = '$id'";
        $Result = mysqli_query($connection, $Query);

        if($Result){
            $_SESSION['message'] = [
                'content' => 'Deleted Successfully :)',
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./view_email.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = [
                'content' => 'Something Went Wrong :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./view_email.php'; </script>";
            exit(0);
        }
    }else{
        $_SESSION['message'] = [
            'content' => 'Error -_-',
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='../index.php'; </script>";
        exit(0);
    }
?>