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
            $_SESSION['message'] = [
                'content' => 'Please fill in all the fields !!',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = [
                'content' => 'email is not in a proper form :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Fname)) {
            $_SESSION['message'] = [
                'content' => 'first name should contain just letters and white-space :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if (!preg_match("/^[a-zA-Z-' ]*$/",$Lname)) {
            $_SESSION['message'] = [
                'content' => 'last name should contain just letters and white-space :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        $upper = preg_match('@[A-Z]@', $Pass);
        $lower = preg_match('@[a-z]@', $Pass);
        $nbr    = preg_match('@[0-9]@', $Pass);
        $specialChars = preg_match('@[^\w]@', $Pass);


        if(!$upper || !$lower || !$nbr || !$specialChars || strlen($Pass) < 8) {
            $_SESSION['message'] = [
                'content' => 'ths password is too weak :)',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }


        if($Pass !== $ConfPass){
                $_SESSION['message'] = [
                    'content' => "You didn't conform password correctly :)",
                    'type' => 'alert',
                ];
                echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
                exit(0);
        }


        $isEmailExistQuery = "select '$Email' from users where email = '$Email'";
        $isEmailExistResult = mysqli_query($connection, $isEmailExistQuery);

        if(mysqli_num_rows($isEmailExistResult) > 0){
            $_SESSION['message'] = [
                'content' => "This email already exist :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
            exit(0);
        }else{
            $encPass = crypt($Pass,"dev-bay");
            $registringQuery = "insert into users (firstname,lastname,image,email,password) values ('$Fname','$Lname','$img','$Email','$encPass')";
            $registringResult = mysqli_query($connection, $registringQuery);

            if( $registringResult ){
                move_uploaded_file($_FILES['image']['tmp_name'],'../img/users/'.$img);
                $_SESSION['message'] = [
                    'content' => "Registered Seccussfully :)",
                    'type' => 'seccuss',
                ];
                echo "<script type='text/javascript'>  window.location='./login.php'; </script>";
                exit(0);
            }else{
                $_SESSION['message'] = [
                    'content' => "something went wrong during registration :)",
                    'type' => 'alert',
                ];
                echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
                exit(0);
            }
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./register.php'; </script>";
        exit(0);
    }

?>