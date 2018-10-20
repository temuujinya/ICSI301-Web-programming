<?php 
    require_once "./include/db.php";
 
    if(isset($_GET["s_id"])){
        $s_id = $_GET["s_id"];
        $deleteStud="delete from student where studentID='{$s_id}'";
        $db->query($deleteStud);
    }else{
        exit("ID damjuulaachee");
    }
    
    header("Location: ./list.php");
    exit();
    
?>