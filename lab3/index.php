<?php
// include "./conf/db.php";
require_once __DIR__."/include/db.php";
require_once __DIR__."/include/config.php";
include_once __DIR__."/include/partials/header.php";
$invalidLogin="";

if(isset($_POST["loginID"])){
    $studentID = $_POST["loginID"];
    $findStudentById = "select * from student where studentID='{$studentID}'";
    $result = mysqli_query($db,$findStudentById);
    
    if(mysqli_fetch_assoc($result)!==null){
        $studentPASS = $_POST["loginPass"];
        $passCheck = "select * from student where studentID='{$studentID}' AND password='{$studentPASS}'";
        $result = mysqli_query($db, $passCheck);
        if(mysqli_fetch_assoc($result)!==null){
            echo "logged in";
            setcookie("studentID",$studentID);
            header("location: {$site_url}/");
        }else{
            echo "passwrong";
        }
    }else{
        $invalidLogin ="<div class='alert alert-danger' role='alert'>
                            Оюутны хувийн дугаар эсвэл нууц үг буруу байна.
                        </div>";
    }
}
if(!isset($_COOKIE['studentID'])){
    require_once "include/auth/auth.php";
}else{
    require_once "list.php";
}
mysqli_close($db);

include_once __DIR__."/include/partials/footer.php";
?>