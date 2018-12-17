<?php 

require "./init.php";
if(isset($_GET["username"])){
    $username = $_GET["username"];
    header("Content-Type: text/xml");
    echo "<?xml version=\"1.0\"?>\n";
    echo "<found>";
    if(loginCheckUsername($username)){
        echo "true";
    }else{
        echo "false";
    }
    echo "</found>";

}
