<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    if(isset($_POST['signup'])){
        $Fname = mysqli_real_escape_string($connection ,$_POST['firstName']);
        $Lname = mysqli_real_escape_string($connection ,$_POST['lastName']);
        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['pass']);
        $ConfPass = mysqli_real_escape_string($connection ,$_POST['conformPass']);

        if($Fname === '' || $Lname === '' ||$Email === '' ||$Pass === '' ||$ConfPass === ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }

        if($Pass !== $ConfPass){
                $_SESSION['message'] = "you didn't conform password correctly :)";
                echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
                exit(0);
        }

        $isEmailExistQuery = "select '$Email' from users where email = '$Email'";
        $isEmailExistResult = mysqli_query($connection, $isEmailExistQuery);

        if(mysqli_num_rows($isEmailExistResult) > 0){
            $_SESSION['message'] = "This email already exist :)";
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }else{
            $registringQuery = "insert into users (firstname,lastname,email,password) values ('$Fname','$Lname','$Email','$Pass')";
            $registringResult = mysqli_query($connection, $registringQuery);

            if( $registringResult ){
                $_SESSION['message'] = "Registered Seccussfully :)";
                echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
                exit(0);
            }else{
                $_SESSION['message'] = "something went wrong during registration :)";
                echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
                exit(0);
            }
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
        exit(0);
    }

?>