<?php
include('../admin/config/databaseConfig.php');

if (isset($_POST['state']) && isset($_POST['author_id']) && isset($_POST['post_id'])) {
    
    $state = $_POST['state'];
    $author_id = $_POST['author_id'];
    $post_id = $_POST['post_id'];

    $testQuery = "select * from post_react where author_id = '$author_id' and post_id = '$post_id'";
    $testResult = mysqli_query($connection, $testQuery);
    if (mysqli_num_rows($testResult) > 0) {
        $query = "UPDATE post_react set author_id='$author_id', post_id='$post_id', state='$state' where author_id='$author_id' and post_id='$post_id'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "seccussed [modification]";
        } else {
            echo "failled [modification]";
        }
    }elseif(mysqli_num_rows($testResult) == 0){
        $query = "INSERT INTO post_react (author_id, post_id, state) VALUES ('$author_id','$post_id','$state')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "seccussed [creation]";
        } else {
            echo "failled [creation]";
        }
    }
}
