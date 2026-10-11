<?php
;
$conn = mysqli_connect("localhost:3308", "root", "", "carbon_tracker");

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>