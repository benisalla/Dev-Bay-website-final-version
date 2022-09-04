<?php
    include('./authCode.php');

    if(isset($_POST['save_btn'])){

        $category_id = mysqli_real_escape_string($connection ,$_POST['category']);
        $auther_id = mysqli_real_escape_string($connection ,$_POST['author']);
        $slug = mysqli_real_escape_string($connection ,$_POST['slug']);
        $title = mysqli_real_escape_string($connection ,$_POST['title']);
        $excerpt = mysqli_real_escape_string($connection ,$_POST['excerpt']);
        $body = mysqli_real_escape_string($connection ,$_POST['body']);
        $lang = mysqli_real_escape_string($connection ,$_POST['lang']);
        $state = $_POST['state'][0] == 'on' ? '1' : '0';
        $cdate = mysqli_real_escape_string($connection ,$_POST['cdate']);
        $udate = mysqli_real_escape_string($connection ,$_POST['udate']);
        $id = $_POST['save_btn'];

        $image = $_FILES['image']['name'];

        $img = str_replace(' ','',explode('.',$image)[0].rand().".".pathinfo($image, PATHINFO_EXTENSION));


        if($title === '' || $slug === '' || $body === '' || $excerpt == ''){
            $_SESSION['message'] = 'Please fill in all the fields !!';
            echo "<script type='text/javascript'>  window.location='./edit_post.php?id=".$id."'; </script>";
            exit(0);
        }

        $Query =  "update post set category_id='$category_id', user_id='$auther_id', state='$state',
                slug='$slug', title='$title', excerpt='$excerpt', body='$body', image='$img', 
                created_at='$cdate', updated_at='$udate', lang='$lang' where id='$id'";
        $Result = mysqli_query($connection, $Query);


        if($Result){
            move_uploaded_file($_FILES['image']['tmp_name'],'../img/blog/'.$img);
            $_SESSION['message'] = "Updated Seccussfully :)";
            echo "<script type='text/javascript'>  window.location='./view_post.php'; </script>";
            exit(0);
        }else{
            $_SESSION['message'] = "Something went wrong, Please Try again :)";
            echo "<script type='text/javascript'>  window.location='./edit_post.php?id=".$id."'; </script>";
            exit(0);
        }

    }else{
        echo "<script type='text/javascript'>  window.location='./index.php'; </script>";
        exit(0);
    }

?>