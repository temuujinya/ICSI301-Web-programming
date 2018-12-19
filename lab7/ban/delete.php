<?php 

if(isset($_COOKIE['studentID'])){
    require_once "./include/db.php";
 
    if(isset($_GET["s_id"])){
        $s_id = $_GET["s_id"];
        $deleteStud="delete from student where studentID='{$s_id}'";
        mysqli_query($db,$deleteStud);
    }else{
        exit("ID damjuulaachee");
    }
    
    header("Location: ./list.php");
    exit();
}else{
    header("location: ./index.php");
}
    
?>