<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $name = mysqli_real_escape_string($connection ,$_POST['name']);
        $slug = mysqli_real_escape_string($connection ,$_POST['slug']);
        $date = mysqli_real_escape_string($connection ,$_POST['date']);


        if($name === '' || $slug === ''){
            $_SESSION['message'] = [
                'content' => 'Please fill in ( Name & Slug ) !!',
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_category.php'; </script>";
            exit(0);
        }


        $textQuery = "select * from category where slug = '$slug'";
        $testResult = mysqli_query($connection, $textQuery);

        if(mysqli_num_rows($testResult) > 0){
            $_SESSION['message'] = [
                'content' => "This category already exist :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_category.php'; </script>";
            exit(0);
        }

        $Query = "insert into category (name,slug,updated_at) values ('$name', '$slug','$date')";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            $_SESSION['message'] = [
                'content' => "Added Seccussfully :)",
                'type' => 'seccuss',
            ];
            echo "<script type='text/javascript'>  window.location='./view_category.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = [
                'content' => "Something went wrong, Please Try again :)",
                'type' => 'alert',
            ];
            echo "<script type='text/javascript'>  window.location='./add_category.php'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>