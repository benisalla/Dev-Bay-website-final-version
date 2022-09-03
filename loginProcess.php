<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    if(isset($_POST['signin'])){

        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['password']);


        if($Email === '' || $Pass === ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "email is not in a proper form :)";
            echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
            exit(0);
        }


        $Query = "select * from users where email = '$Email' and password = '$Pass'";
        $Result = mysqli_query($connection, $Query);

        if(mysqli_num_rows($Result) > 0){
            $user = null;
            foreach($Result as $data){
                $user = $data;
            }
            $_SESSION['user_auth'] = true; 
            $_SESSION['user_Role'] = $user["role_as"];
            $_SESSION['user'] = [
                'name' => $user['firstname'],
                'id' => $user['id'],
                'email' => $user['email'],
            ];

            if($_SESSION['user_Role'] == '1'){
                $_SESSION['message'] = "Welcome To DashBoard :)";
                echo "<script type='text/javascript'>  window.location='./admin/index.php'; </script>";
                exit(0);
            }elseif($_SESSION['user_Role'] == '0'){
                $_SESSION['message'] = "You Are Loged in Seccussfully :)";
                echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
                exit(0);
            }else{
                $_SESSION['message'] = "this category is not available now :)";
                echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
                exit(0);
            }

        }else{
            $_SESSION['message'] = "email or password is incorrect :)";
            echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
        exit(0);
    }

?>