<?php 
$serverName="localhost";
$userName="root";
$pass="";
$conn=mysqli_connect($serverName,$userName,$pass);
if(!$conn){
    die('Connection error: '.mysqli_connect_error());
}

$sqlDB="CREATE DATABASE FOOTBALLAGENTSERIALEONE";
if(mysqli_query($conn,$sqlDB)){
    echo "Database created successfully";
}
else{
    echo "Error in creating the database: ".mysql_error($conn);
}
?>