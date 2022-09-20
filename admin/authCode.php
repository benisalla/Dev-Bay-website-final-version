<?php
session_start();

include('./config/databaseConfig.php');

if(!$_SESSION['user_auth']){
    $_SESSION['message'] = [
        'content' => 'Log In First To Access DashBoard :)',
        'type' => 'alert',
    ];
    echo "<script type='text/javascript'>  window.location='../login.php'; </script>";
    exit(0);
}else{
    if($_SESSION['user_Role'] != '1'){
        $_SESSION['message'] = [
            'content' => 'You Are Not Allowed as an Admin',
            'type' => 'alert',
        ];
        echo "<script type='text/javascript'>  window.location='../index.php'; </script>";
        exit(0);
    }
}
?>