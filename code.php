<?php 
session_start();
if(isset($_POST['logout_btn'])){

    //session_destroy();
    // or 
    unset($_SESSION['user_auth']);
    unset($_SESSION['user_Role']);
    unset($_SESSION['user']);

    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = 'You Have Logged Out Seccussfully :)';
    }
    echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
    exit(0);
}
else{
    $_SESSION['message'] = 'You Are Not Allowed To Access:)';
    echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
    exit(0);
}