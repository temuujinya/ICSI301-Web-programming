<?php 

require_once __DIR__."/db.php";
require_once __DIR__."/pdo_db.php";
require_once __DIR__."/config.php";
require_once __DIR__."/functions.php";

session_start();
if(isset($_SESSION['studentID']))
$id =  $_SESSION['studentID'];
?>