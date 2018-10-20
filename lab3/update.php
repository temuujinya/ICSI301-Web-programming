<?php
    include "./conf/partials/header.php";
 

    if(isset($_GET["s_id"])){
        $s_id = $_GET["s_id"];
        $getStudent = "select * from student where studentID='{$s_id}'";
        $db->query($getStudent);
    }
?>