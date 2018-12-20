<?php 

require ("./init.php");


if(isset($_GET["username"])){
    $username = $_GET["username"];
    header("Content-Type: text/xml");
    
    echo "<?xml version='1.0' encoding='UTF-8'?>";
    echo "<response>";
    if(loginCheckUsername($username)){
        echo "Тус нэр давхцаж байгаа тул өөр нэг оруулна уу";
    }else{
        // echo "false";        
        echo "Тус нэрийг ашиглах боломжтой";
    }
    echo "</response>";

}
?>