<?php 
require_once __DIR__ ."/../config.php";

?>
<!DOCTYPE html>
<html lang="mn">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Бяцхан сиси</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<? echo $site_url;?>/public/bootstrap/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<? echo $site_url;?>/public/style/main.css"/>
</head>
<body>
<?
if(isset($_COOKIE["studentID"])){
  include_once __DIR__."/navbar.php";
}?>