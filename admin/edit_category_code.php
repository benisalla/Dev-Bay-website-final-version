<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $name = mysqli_real_escape_string($connection ,$_POST['name']);
        $slug = mysqli_real_escape_string($connection ,$_POST['slug']);
        $cdate = mysqli_real_escape_string($connection ,$_POST['cdate']);
        $udate = mysqli_real_escape_string($connection ,$_POST['udate']);
        $id = $_POST['save_btn'];
        
        if($name === '' || $slug === ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./edit_category.php?id=".$id."'; </script>";
            exit(0);
        }

        $textQuery = "select * from category where slug = '$slug'";
        $testResult = mysqli_query($connection, $textQuery);

        if(mysqli_num_rows($testResult) > 0){
            $_SESSION['message'] = "This category already exist :)";
            echo "<script type='text/javascript'>  window.location='./edit_category.php?id=".$id."'; </script>";
            exit(0);
        }

        $Query = "update category set name = '$name', slug = '$slug', created_at = '$cdate', updated_at = '$udate' where id = '$id'";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            $_SESSION['message'] = "Updated Seccussfully :)";
            echo "<script type='text/javascript'>  window.location='./view_category.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = "Something went wrong, Please Try again :)";
            echo "<script type='text/javascript'>  window.location='./edit_category.php?id=".$id."'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>