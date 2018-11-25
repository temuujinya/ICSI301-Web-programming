<?php
global $db;
if(isset($_COOKIE["studentID"]))
{
    $studentID = $_COOKIE["studentID"];
}


function findAllProgram(){
    global $pdo;
    $query = "select * from program";
    $query = $pdo->prepare($query);
    $query->execute();

    return $query;
}

function checkPasswordsEqual($pass,$passConfirm){
    global $pdo;
    if(strcmp($pass, $passConfirm)==0){
        return true;
    }else{
        return false;
    }
}

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

function sanitizeString($var){
    global $db;
    $var = mysqli_real_escape_string($db, $var);
    $var =  filter_var($var, FILTER_SANITIZE_STRING,FILTER_SANITIZE_STRIP_HIGH);
    return $var;
}
?>