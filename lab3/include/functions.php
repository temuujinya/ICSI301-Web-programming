<?php
global $db;
$studentID = $_COOKIE["studentID"];
function checkCourseTaken($courseIndex){
    global $db;
    global $studentID;
    $checkQR="select * from courseTakenHistory where 
        studentID ='{$studentID}' AND courseIndex='{$courseIndex}'";
    $checkQR = mysqli_query($db,$checkQR);
    if(!$checkQR){
        die("erro".mysqli_error($db));
    }
    if(mysqli_num_rows($checkQR)<=0){
        return false;      
    }
    return true;
}

function takeCourseByStudent($courses){
    global $db;
    global $studentID;
    foreach($courses as $course){
        $takeCourse = "insert into courseTakenHistory (studentID,courseIndex)
        values ('{$studentID}','{$course}')";
        mysqli_query($db,$takeCourse);
    }
    }
?>