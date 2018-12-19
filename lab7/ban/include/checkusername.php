<?php
require "./init.php";
if(isset($_GET['username']))
    $username = $_GET['username'];
    
loginCheckUsername($username):