<?php 
session_start();
if(isset($_POST['logout_btn'])){

    //session_destroy();
    // or 
    unset($_SESSION['user_auth']);
    unset($_SESSION['user_Role']);
    unset($_SESSION['user']);

    if(!isset($_SESSION['message'])){
        $_SESSION['message'] = [
            'content' => 'You Have Logged Out Seccussfully :)',
            'type' => 'seccuss',
        ];
    }
    echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
    exit(0);
}
else{
    $_SESSION['message'] = [
        'content' => 'You Are Not Allowed To Access:)',
        'type' => 'alert',
    ];
    echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
    exit(0);
}