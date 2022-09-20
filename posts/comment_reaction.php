<?php
include('../admin/config/databaseConfig.php');

if (isset($_POST['state']) && isset($_POST['author_id']) && isset($_POST['comment_id'])) {
    
    $state = $_POST['state'];
    $author_id = $_POST['author_id'];
    $comment_id = $_POST['comment_id'];

    $testQuery = "select * from comment_react where author_id = '$author_id' and comment_id = '$comment_id'";
    $testResult = mysqli_query($connection, $testQuery);
    if (mysqli_num_rows($testResult) > 0) {
        $query = "UPDATE comment_react set author_id='$author_id', comment_id='$comment_id', state='$state' where author_id='$author_id' and comment_id='$comment_id'";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "seccussed [modification]";
        } else {
            echo "failled [modification]";
        }
    }elseif(mysqli_num_rows($testResult) == 0){
        $query = "INSERT INTO comment_react (author_id, comment_id, state) VALUES ('$author_id','$comment_id','$state')";
        $result = mysqli_query($connection, $query);
        if ($result) {
            echo "seccussed [creation]";
        } else {
            echo "failled [creation]";
        }
    }
}
