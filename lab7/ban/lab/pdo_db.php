<?php

$con = "mysql:host=localhost;dbname=lab7;charset=utf8mb4";

try{
    $pdo = new PDO($con, "root", "");
}catch(Exception $e){
    error_log($e->getMessage());
    exit("not connecting db pdo");
}