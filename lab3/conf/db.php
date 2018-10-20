<?php
$host = "localhost";
$user = "root";
$password ="";
$database ="lab3";
$db = new mysqli($host,$user,$password,$database);

if($db->connect_errno){
    echo "Connection failed: ".$db->connect_error;
}
?>