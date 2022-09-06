<?php
    session_start();
    include('./admin/config/databaseConfig.php');

    if(isset($_POST['signup'])){

        $Fname = mysqli_real_escape_string($connection ,$_POST['firstName']);
        $Lname = mysqli_real_escape_string($connection ,$_POST['lastName']);
        $Email = mysqli_real_escape_string($connection ,$_POST['email']);
        $Pass = mysqli_real_escape_string($connection ,$_POST['pass']);
        $ConfPass = mysqli_real_escape_string($connection ,$_POST['conformPass']);

        $image = $_FILES['image']['name'];
        $img = str_replace(' ','',explode('.',$image)[0].rand().".".pathinfo($image, PATHINFO_EXTENSION));


        if($Fname === '' || $Lname === '' ||$Email === '' ||$Pass === '' ||$ConfPass === ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "email is not in a proper form :)";
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Fname)) {
            $_SESSION['message'] = "first name should contain just letters and white-space :)";
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Lname)) {
            $_SESSION['message'] = "last name should contain just letters and white-space :)";
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if(!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            $_SESSION['message'] = "ths password is too weak :)";
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
            $registringQuery = "insert into users (firstname,lastname,image,email,password) values ('$Fname','$Lname','$img','$Email','$Pass')";
            $registringResult = mysqli_query($connection, $registringQuery);

            if( $registringResult ){
                move_uploaded_file($_FILES['image']['tmp_name'],'../img/users/'.$img);
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