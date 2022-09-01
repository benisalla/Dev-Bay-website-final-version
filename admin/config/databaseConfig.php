<?php 
error_reporting(0);

$host = "127.0.0.1:3333";
$username = "root";
$password = "";
$database = "dev_bay";
$connection = false;

try{
    $connection = mysqli_connect($host,$username,$password,$database);
}catch(mysqli_sql_exception $MSE){
    echo "<script type='text/javascript'>  window.location='../../Errors/404.php'; </script>";
    exit(0);
}

?>