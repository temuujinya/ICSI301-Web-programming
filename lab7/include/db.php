<?php
$host = "localhost";
$user = "root";
$password ="";
$database ="lab4";

$db = mysqli_connect($host,$user,$password,$database);
if(!$db){
    $logMessage = "MySQL error: ".mysqli_connect_error();
    die("Connection failed: ");
}
?>