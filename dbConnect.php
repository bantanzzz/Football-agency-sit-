<?php 
$serverName="localhost";
$userName="root";
$pass="";
$dbName="FOOTBALLAGENTSERIALEONE";
$conn=mysqli_connect($serverName,$userName,$pass,$dbName);
if(!$conn){
    die('Connection error: '.mysqli_connect_error());
}

?>