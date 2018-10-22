<?php
global $db;
function checkCourseTaken($courseIndex,$studentIDs){
    global $db;
    $checkQR="select * from courseTakenHistory where studentID ='{$studentIDs}' AND courseIndex='{$courseIndex}'";
    $checkQR = mysqli_query($db,$checkQR);
    if(!$checkQR){
        die("erro".mysqli_error($db));
    }
    if(mysqli_num_rows($checkQR)<=0){
        return false;      
    }
    return true;
}
?>