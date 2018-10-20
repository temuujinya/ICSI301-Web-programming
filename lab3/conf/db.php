<?php
$host = "localhost";
$user = "root";
$password ="";
$database ="lab3";
$db = new mysqli($host,$user,$password,$database);

if(!$db){
    die("Connection failed: ".mysqli_connect_error());
}
?>