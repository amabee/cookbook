<?php

$server_name = "localhost";
$server_username = "root";
$server_password = "";
$db_name = "cookbook";

$conn = mysqli_connect($server_name,$server_username,$server_password,$db_name);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

echo "<script>console.log('Connected to database')</script>";

?>